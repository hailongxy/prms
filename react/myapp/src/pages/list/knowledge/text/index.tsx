import React, { useEffect, useState, useRef } from 'react';
import { useParams, history } from '@umijs/max';
import { Card, Spin, Button, message } from 'antd';
import { request } from '@umijs/max';
import { Editor } from '@tinymce/tinymce-react';

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
  const editorRef = useRef<any>(null);

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

  const handleSave = async (data?: string) => {
    if (!detail) return;
    try {
      const res = await request(`http://127.0.0.1:8081/api/v1/knowledge/${detail.id}`, {
        method: 'PUT',
        data: {
          ...detail,
          content: data || content,
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
      <div>
        <Editor
          tinymceScriptSrc="/react/tinymce/tinymce.min.js"
          value={content}
          onEditorChange={(val) => setContent(val)}
          onInit={(evt, editor) => { editorRef.current = editor; }}
          init={{
            base_url: '/react/tinymce',
            height: 500,
            menubar: true,
            paste_data_images: true,
            skin: 'oxide-dark',
            content_css: 'dark',
            plugins:
              'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help image insertdatetime link lists media nonbreaking pagebreak preview print quickbars save searchreplace table template visualblocks visualchars wordcount',
            toolbar:
              'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough forecolor backcolor | ' +
              'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | ' +
              'link image media table | codesample code | pagebreak charmap emoticons | ' +
              'visualblocks visualchars | ltr rtl | fullscreen preview print | removeformat save template help',
            setup: (editor) => {
              editor.on('keydown', (e) => {
                const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
                if ((isMac && e.metaKey && e.key === 's') || (!isMac && e.ctrlKey && e.key === 's')) {
                  e.preventDefault();
                  const latestContent = editor.getContent();
                  setContent(latestContent);
                  handleSave(latestContent);
                }
              });
            },
          }}
        />
      </div>
      <Button type="primary" style={{ marginTop: 16 }} onClick={() => handleSave()}>
        保存
      </Button>
    </Card>
  );
};

export default Knowledge;
