import {
  ProForm,
  ProFormDateTimePicker,
  ProFormRadio,
  ProFormSelect,
  ProFormText,
  ProFormTextArea,
  StepsForm,
} from '@ant-design/pro-components';
import { Modal } from 'antd';
import React from 'react';
import type { TableListItem } from '../data';

export type FormValueType = {
  target?: string;
  template?: string;
  type?: string;
  time?: string;
  frequency?: string;
} & Partial<TableListItem>;

export type UpdateFormProps = {
  onCancel: (flag?: boolean, formVals?: FormValueType) => void;
  onSubmit: (values: FormValueType) => Promise<void>;
  updateModalVisible: boolean;
  values: Partial<TableListItem>;
};

const UpdateForm: React.FC<UpdateFormProps> = (props) => {
  return (
    <Modal
      width={640}
      bodyStyle={{
        padding: '32px 40px 48px',
      }}
      destroyOnClose
      title="修改知识分类"
      open={props.updateModalVisible}
      onCancel={() => props.onCancel()}
      footer={null} // 使用 ProForm 自带的 submitter
    >
      {/* eslint-disable-next-line react/jsx-no-undef */}
      <ProForm
        initialValues={{
          title: props.values.title,
        }}
        onFinish={props.onSubmit}
        submitter={{
          searchConfig: {
            submitText: '提交',
            resetText: '重置',
          },
          render: (_, dom) => dom,
        }}
      >
        <ProFormText
          name="title"
          label="名称"
          width="md"
          rules={[
            {
              required: true,
              message: '请输入名称！',
            },
          ]}
        />
      </ProForm>
    </Modal>
  );
};

export default UpdateForm;
