import React, { useEffect, useRef, useState } from 'react';
import { Tree, Spin, message, Flex, Button, Form, Modal } from 'antd';
import {
  EditOutlined,
  PlusOutlined,
  DeleteOutlined,
  FileTextOutlined,
  TableOutlined,
  ApartmentOutlined,
  FolderOutlined,
} from '@ant-design/icons';
import type { TreeDataNode, TreeProps } from 'antd';
import {
  type ActionType,
  ModalForm,
  PageContainer,
  ProFormText,
  ProFormRadio,
} from '@ant-design/pro-components';
import { request, useLocation } from '@umijs/max';
import { useNavigate } from 'react-router-dom';
import type { TableListItem } from '@/pages/list/knowledge-list/data';
import { addKnowledge, removeKnowledge } from '@/pages/list/knowledge-list/service';
import UpdateForm, { type FormValueType } from '@/pages/list/knowledge-list/components/UpdateForm';
import { updateKnowledge } from '@/pages/list/knowledge-list/service';
import { FcMindMap } from "react-icons/fc";

const handleAdd = async (fields: TableListItem) => {
  const hide = message.loading('正在添加');

  try {
    await addKnowledge({ ...fields });
    hide();
    message.success('添加成功');
    return true;
  } catch (error) {
    hide();
    message.error('添加失败请重试！');
    return false;
  }
};

const handleUpdate = async (fields: FormValueType, currentRow?: TableListItem) => {
  const hide = message.loading('正在配置');

  try {
    await updateKnowledge({
      ...currentRow,
      ...fields,
    });
    hide();
    message.success('配置成功');
    return true;
  } catch (error) {
    hide();
    message.error('配置失败请重试！');
    return false;
  }
};

const Knowledge: React.FC = () => {
  const location = useLocation();
  const navigate = useNavigate();
  const queryParams = new URLSearchParams(location.search);
  const categoryID = queryParams.get('categoryID');
  const categoryTitle = queryParams.get('categoryTitle');

  const [createModalVisible, handleModalVisible] = useState<boolean>(false);
  const [parentId, setParentId] = useState<number>(0);

  const [gData, setGData] = useState<TreeDataNode[]>([]);
  const [loading, setLoading] = useState(true);
  const [expandedKeys, setExpandedKeys] = useState<React.Key[]>([]);
  const actionRef = useRef<ActionType>();
  const [form] = Form.useForm();

  const [updateModalVisible, handleUpdateModalVisible] = useState<boolean>(false);
  const [currentRow, setCurrentRow] = useState<TableListItem>();

  const handleDelete = async (id: number) => {
    const hide = message.loading('正在删除...');
    try {
      await removeKnowledge(id);
      hide();
      message.success('删除成功');
      fetchTreeData();
    } catch (error) {
      hide();
      message.error('删除失败，请重试');
    }
  };

  const normalizeTreeData = (nodes: any[]): TreeDataNode[] => {
    return nodes.map((node) => {
      // @ts-ignore
      // @ts-ignore
      // @ts-ignore
      const newNode: TreeDataNode = {
        title: (
          <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
            <a
              onClick={() => {
                if (node.knowledge_type === 'table_of_contents') return;
                let path = `/react/knowledge/text/${node.id}`; // 默认
                if (node.knowledge_type === 'form') path = `/react/knowledge/form/${node.id}`;
                else if (node.knowledge_type === 'brain_mapping') path = `/react/knowledge/brain-mapping/${node.id}`;
                else if (node.knowledge_type === 'flow_chart') path = `/react/knowledge/flow-chart/${node.id}`;
                window.open(path, '_self');
              }}
              style={{ color: '#1677ff', cursor: 'pointer' }}
            >
              <>
                {/* eslint-disable-next-line react/jsx-no-undef */}
                {node.knowledge_type === 'form' && <i><TableOutlined style={{ marginRight: 4 }} /></i>}
                {/* eslint-disable-next-line react/jsx-no-undef */}
                {node.knowledge_type === 'brain_mapping' && <i><FcMindMap style={{ marginRight: 4 }} /></i>}
                {/* eslint-disable-next-line react/jsx-no-undef */}
                {node.knowledge_type === 'flow_chart' && <i><ApartmentOutlined style={{ marginRight: 4 }} /></i>}
                {/* eslint-disable-next-line react/jsx-no-undef */}
                {node.knowledge_type === 'table_of_contents' && <i><FolderOutlined style={{ marginRight: 4 }} /></i>}
                {node.knowledge_type === 'text' && <i><FileTextOutlined style={{ marginRight: 4 }} /></i>}
                {node.title}
              </>
            </a>
            <span>
            <EditOutlined style={{ marginRight: 8 }} onClick={() => {
              handleUpdateModalVisible(true);
              setCurrentRow(node);
            }} />
            <PlusOutlined style={{ marginRight: 8 }} onClick={() => {
              form.resetFields();
              form.setFieldsValue({ parent_id: node.id });
              handleModalVisible(true);
            }} />
            <DeleteOutlined
              onClick={() => {
                Modal.confirm({
                  title: '确认删除此节点吗？',
                  content: '删除后该节点及其子节点将无法恢复。',
                  okText: '确认',
                  cancelText: '取消',
                  onOk: () => handleDelete(node.id),
                });
              }}
            />
          </span>
          </div>
        ),
        key: node.id,
      };

      if (Array.isArray(node.children) && node.children.length > 0) {
        newNode.children = normalizeTreeData(node.children);
      }

      return newNode;
    });
  };

  const getAllKeys = (data: TreeDataNode[]): React.Key[] => {
    let keys: React.Key[] = [];
    data.forEach((item) => {
      keys.push(item.key);
      if (item.children) {
        keys = keys.concat(getAllKeys(item.children));
      }
    });
    return keys;
  };

  const fetchTreeData = () => {
    setLoading(true);
    request('http://127.0.0.1:8081/api/v1/knowledge-tree', {
      method: 'GET',
      params: {
        categoryID,
      },
    })
      .then((res) => {
        if (res.code === 200) {
          const cleanData = normalizeTreeData(res.data);
          setGData(cleanData);
          setExpandedKeys(getAllKeys(cleanData));
        } else {
          message.error(res.msg || '加载失败');
        }
      })
      .catch(() => {
        message.error('加载树数据失败');
      })
      .finally(() => setLoading(false));
  };

  useEffect(() => {
    fetchTreeData();
  }, []);

  const onDragEnter: TreeProps['onDragEnter'] = (info) => {
    console.log(info);
  };

  const onDrop: TreeProps['onDrop'] = async (info) => {
    console.log(123);
    console.log(info);
    const dropKey = info.node.key;
    const dragKey = info.dragNode.key;
    const dropPos = info.node.pos.split('-');
    const dropToGap = info.dropToGap;

    // Determine position relative to target node
    let position: 'before' | 'after' | 'inside' = 'inside';
    if (dropToGap) {
      position = info.dropPosition < 0 ? 'before' : 'after';
    } else {
      position = 'inside';
    }

    try {
      await request('http://127.0.0.1:8081/api/v1/knowledge/sort', {
        method: 'POST',
        data: {
          moved_id: dragKey,
          target_id: dropKey,
          position: position,
        },
      });
      message.success('排序成功');
      fetchTreeData();
    } catch (error) {
      message.error('排序失败，请重试');
    }
  };

  return (
    <PageContainer header={{ title: categoryTitle || '知识' }}>
      <Flex gap="small" wrap style={{ marginBottom: 16, justifyContent: 'space-between', width: '100%' }}>
        <div>
          <Button type="primary" onClick={() => {
            form.resetFields();
            form.setFieldsValue({ parent_id: 0 });
            handleModalVisible(true);
          }}>
            新增章节
          </Button>
        </div>
        <div>
          <Button onClick={() => navigate(-1)} style={{ marginRight: 8 }}>
            返回
          </Button>
        </div>
      </Flex>
      <ModalForm
        title="新建知识"
        width="400px"
        open={createModalVisible}
        onVisibleChange={handleModalVisible}
        initialValues={{ parent_id: parentId }}
        onFinish={async (value) => {
          const success = await handleAdd({ ...value, category_id: parseInt(value.category_id, 10) } as TableListItem);
          if (success) {
            handleModalVisible(false);
            fetchTreeData();
          }
        }}
        form={form}
      >
        <ProFormText
          rules={[
            {
              required: true,
              message: '名称为必填项',
            },
          ]}
          width="md"
          name="title"
        />
        <ProFormRadio.Group
          name="knowledge_type"
          label="知识类型"
          radioType="button"
          options={[
            { label: '文本', value: 'text' },
            { label: '表格', value: 'form' },
            { label: '脑图', value: 'brain_mapping' },
            { label: '流程图', value: 'flow_chart' },
            { label: '目录', value: 'table_of_contents' },
          ]}
          rules={[{ required: true, message: '请选择知识类型' }]}
        />
        <ProFormText name="category_id" hidden initialValue={categoryID} />
        <ProFormText name="parent_id" hidden />
      </ModalForm>
      <UpdateForm
        onSubmit={async (value) => {
          const success = await handleUpdate(value, currentRow);

          if (success) {
            handleUpdateModalVisible(false);
            setCurrentRow(undefined);
            fetchTreeData();

            if (actionRef.current) {
              actionRef.current.reload();
            }
          }
        }}
        onCancel={() => {
          handleUpdateModalVisible(false);
          setCurrentRow(undefined);
        }}
        updateModalVisible={updateModalVisible}
        values={currentRow || {}}
      />
      {loading ? (
        <Spin />
      ) : (
        <Tree
          className="draggable-tree"
          expandedKeys={expandedKeys}
          onExpand={(keys) => setExpandedKeys(keys)}
          draggable
          blockNode
          onDragEnter={onDragEnter}
          onDrop={onDrop}
          treeData={gData}
        />
      )}
    </PageContainer>
  );
};

export default Knowledge;
