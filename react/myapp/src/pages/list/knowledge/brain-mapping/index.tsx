import React, { useEffect, useRef, useState, useCallback } from 'react';
import MindElixir from "mind-elixir";
import NodeMenu from "@mind-elixir/node-menu";
import "@mind-elixir/node-menu/dist/style.css";
import { Button, Card, message } from 'antd';
import { history, request, useParams } from '@umijs/max';

interface KnowledgeDetail {
  id: number;
  title: string;
  knowledge_type: string;
  content?: string;
  // 你可以根据实际接口返回字段补充更多字段
}

const Knowledge = () => {
  const { id } = useParams<{ id: string }>();
  const [loading, setLoading] = useState<boolean>(true);
  const [detail, setDetail] = useState<KnowledgeDetail | null>(null);

  const me = useRef<any>(null);

  const handleSave = useCallback(async () => {
    if (!detail) return;
    try {
      const res = await request(`http://127.0.0.1:8081/api/v1/knowledge/${detail.id}`, {
        method: 'PUT',
        data: {
          ...detail,
          content: JSON.stringify(me.current?.getData?.() || {}),
        },
      });
      if (res.code === 200) {
        message.success('保存成功');
      } else {
        message.error(res.msg || '保存失败');
      }
    } catch (err) {
      message.error('请求失败');
    }
  }, [detail]);

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
          setTimeout(() => {
            const defaultData = {
              nodeData: {
                id: 'root',
                topic: '新主题',
                root: true,
                children: [],
              },
              linkData: {},
            };
            const data = res.data.content ? JSON.parse(res.data.content) : defaultData;
            const instance = new MindElixir({
              el: "#map",
              direction: MindElixir.LEFT,
              draggable: true, // default true
              contextMenu: true, // default true
              toolBar: true, // default true
              nodeMenu: true, // default true
              keypress: true // default true
            });
            instance.install(NodeMenu);
            instance.init(data);
            me.current = instance;
          }, 0);
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
      title={detail?.title || '思维导图'}
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
        <div id="map" style={{ height: '500px', width: '100%' }} />
      </div>
      <Button type="primary" style={{ marginTop: 16 }} onClick={handleSave}>
        保存
      </Button>
    </Card>
  );
};

export default Knowledge;
