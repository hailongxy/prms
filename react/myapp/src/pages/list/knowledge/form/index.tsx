import React, { useRef, useEffect, useState } from 'react';
import { createUniver, defaultTheme, LocaleType, merge } from '@univerjs/presets';
import { UniverSheetsCorePreset } from '@univerjs/presets/preset-sheets-core';
import UniverPresetSheetsCoreEnUS from '@univerjs/presets/preset-sheets-core/locales/en-US';

import '@univerjs/presets/lib/styles/preset-sheets-core.css';
import { Button, Card, message } from 'antd';
import { history, request, useParams } from '@umijs/max';

interface KnowledgeDetail {
  id: number;
  title: string;
  knowledge_type: string;
  content?: string;
  // 你可以根据实际接口返回字段补充更多字段
}

export default function UniverSheet() {

  const { id } = useParams<{ id: string }>();
  const [loading, setLoading] = useState<boolean>(true);
  const [detail, setDetail] = useState<KnowledgeDetail | null>(null);

  const containerRef = useRef<HTMLDivElement | null>(null);
  const workbookRef = useRef<any>(null);

  useEffect(() => {
    if (!id) {
      message.error('无效的知识ID');
      history.goBack();
      return;
    }

    setLoading(true);
    request(`http://127.0.0.1:8081/api/v1/knowledge/${id}`, {
      method: 'GET',
    })
      .then((res) => {
        if (res.code === 200) {
          setDetail(res.data);
        } else {
          message.error(res.msg || '获取详情失败');
        }
      })
      .catch(() => {
        message.error('请求失败');
      })
      .finally(() => {
        setLoading(false);
      });
  }, [id]);

  useEffect(() => {
    if (!containerRef.current) return;

    const { univer, univerAPI } = createUniver({
      locale: LocaleType.EN_US,
      locales: {
        [LocaleType.EN_US]: merge({}, UniverPresetSheetsCoreEnUS),
      },
      theme: defaultTheme,
      presets: [
        UniverSheetsCorePreset({
          container: containerRef.current,
        }),
      ],
    });

    if (detail?.content) {
      try {
        const content = JSON.parse(detail.content);
        workbookRef.current = univerAPI.createWorkbook(content);
      } catch (e) {
        console.error('Invalid content JSON:', e);
        workbookRef.current = univerAPI.createWorkbook({ name: 'Invalid Sheet Content' });
      }
    } else {
      workbookRef.current = univerAPI.createWorkbook({ name: 'Empty Sheet' });
    }
  }, [detail]);

  const me = useRef<any>(null);

  const handleSave = async () => {
    if (!detail) return;
    try {
      const res = await request(`http://127.0.0.1:8081/api/v1/knowledge/${detail.id}`, {
        method: 'PUT',
        data: {
          ...detail,
          content: JSON.stringify(workbookRef.current?.save()),
        },
      });
      if (res.code === 200) {
        message.success('保存成功');
      } else {
        message.error(res.msg || '保存失败');
      }
    } catch (err) {
      message.error('请求失败1');
      console.log(err);
    }
  };

  useEffect(() => {
    const handleKeyDown = (event: KeyboardEvent) => {
      const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
      if ((isMac && event.metaKey && event.key === 's') || (!isMac && event.ctrlKey && event.key === 's')) {
        event.preventDefault();
        handleSave();
      }
    };

    window.addEventListener('keydown', handleKeyDown);
    return () => {
      window.removeEventListener('keydown', handleKeyDown);
    };
  }, [handleSave]);

  return (
    <Card
      title={detail?.title || '表格'}
      extra={
        <Button
          onClick={() => history.back()}
        >
          返回
        </Button>
      }
      style={{ width: '100%', margin: '20px auto' }}
    >
      <div>
        <div ref={containerRef} style={{ height: 600 }} />
      </div>
      <Button type="primary" style={{ marginTop: 16 }} onClick={handleSave}>
        保存
      </Button>
    </Card>
  );
}
