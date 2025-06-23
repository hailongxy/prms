import React, { useEffect, useState, useCallback } from 'react';
import { useParams, history } from '@umijs/max';
import { Card, Spin, Button, message } from 'antd';
import { request } from '@umijs/max';

interface KnowledgeDetail {
  id: number;
  title: string;
  knowledge_type: string;
  content?: string;
  // 你可以根据实际接口返回字段补充更多字段
}

const Knowledge: React.FC = () => {
  const { id } = useParams<{ id: string }>();
  const [loading, setLoading] = useState<boolean>(true);
  const [detail, setDetail] = useState<KnowledgeDetail | null>(null);
  const [content, setContent] = useState<string>('');
  const [isSaving, setIsSaving] = useState<boolean>(false);

  const handleSave = useCallback(() => {
    if (!detail) return;
    const iframe = document.getElementById('drawioFrame') as HTMLIFrameElement | null;
    if (!iframe || !iframe.contentWindow) {
      message.error('编辑器未加载');
      return;
    }
    setIsSaving(true);
    iframe.contentWindow.postMessage(
      JSON.stringify({ action: 'export', format: 'xml', spin: '保存中...' }),
      '*',
    );
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
          setContent(res.data.content || '');
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
    const handleMessage = (event: MessageEvent) => {
      // 只处理来自 draw.io 的消息
      if (!event.origin.includes('localhost') && !event.origin.includes('prms.hailongxy.cn')) return;

      const msg = typeof event.data === 'string' ? JSON.parse(event.data) : event.data;
      if (msg.event === 'init') {
        console.log('收到 draw.io 初始化完成事件');
        const iframe = document.getElementById('drawioFrame') as HTMLIFrameElement;
        iframe?.contentWindow?.postMessage(
          JSON.stringify({
            action: 'load',
            xml: content || '<mxGraphModel><root></root></mxGraphModel>',
          }),
          '*'
        );
      }
    };
    window.addEventListener('message', handleMessage);
    return () => window.removeEventListener('message', handleMessage);
  }, [content]);

  useEffect(() => {
    const handleMessage = (event: MessageEvent) => {
      console.log("get message")
      if (event.origin !== window.origin) {
        return;
      }

      let messageData: any;
      if (typeof event.data === 'string') {
        try {
          messageData = JSON.parse(event.data);
        } catch {
          return;
        }
      } else {
        messageData = event.data;
      }

      if (typeof messageData !== 'object' || messageData === null) {
        return;
      }

      if (messageData.event === 'export') {
        console.log('Draw.io 导出内容:', messageData.data);
        if (messageData.data) {
          setContent(messageData.data);
          if (detail) {
            request(`http://127.0.0.1:8081/api/v1/knowledge/${detail.id}`, {
              method: 'PUT',
              data: {
                ...detail,
                content: messageData.xml,
              },
            })
              .then((res) => {
                if (res.code === 200) {
                  message.success('保存成功');
                } else {
                  message.error(res.msg || '保存失败');
                }
              })
              .catch(() => {
                message.error('请求失败');
              })
              .finally(() => {
                setIsSaving(false);
              });
          }
        }
      }

      if (messageData.event === 'save') {
        handleSave();
      }
    };
    window.addEventListener('message', handleMessage);
    return () => {
      window.removeEventListener('message', handleMessage);
    };
  }, [isSaving, detail, handleSave]);

  useEffect(() => {
    const handleKeyDown = (event: KeyboardEvent) => {
      const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
      if ((isMac && event.metaKey && event.key === 's') || (!isMac && event.ctrlKey && event.key === 's')) {
        event.preventDefault();
        handleSave();
      }
    };

    window.addEventListener('keydown', handleKeyDown);
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, [detail, isSaving, handleSave]);

  if (loading) {
    return <Spin tip="加载中..." style={{ marginTop: 100 }} />;
  }

  if (!detail) {
    return <div>未找到相关知识详情</div>;
  }

  return (
    <Card
      title={detail.title}
      extra={
        <Button
          onClick={() => history.back()}
        >
          返回
        </Button>
      }
      style={{ width: '100%', margin: '20px auto' }}
    >
      <div style={{ height: 600 }}>
        <iframe
          id="drawioFrame"
          title="Draw.io Editor"
          width="100%"
          height="100%"
          src="/react/drawio/embed.html?embed=1&proto=json&ui=dark"
          frameBorder="0"
          allow="fullscreen"
        />
      </div>
      <Button type="primary" style={{ marginTop: 16 }} onClick={handleSave} disabled={isSaving}>
        {isSaving ? '保存中...' : '保存'}
      </Button>
    </Card>
  );
};

export default Knowledge;
