// @ts-ignore
/* eslint-disable */
import { request } from '@umijs/max';
import { TableListItem } from './data';

/** 获取规则列表 GET /api/rule */
export async function rule(
  params: {
    // query
    /** 当前的页码 */
    current?: number;
    /** 页面的容量 */
    pageSize?: number;
  },
  options?: { [key: string]: any },
) {
  return request<{
    data: TableListItem[];
    /** 列表的内容总数 */
    total?: number;
    success?: boolean;
  }>('http://127.0.0.1:8081/api/v1/knowledge-categories', {
    method: 'GET',
    params: {
      ...params,
    },
    ...(options || {}),
  });
}

/** 新建规则 PUT /api/rule */
export async function updateKnowledge(data: { [key: string]: any }, options?: { [key: string]: any }) {
  return request<TableListItem>(`http://127.0.0.1:8081/api/v1/knowledge/${data.id}`, {
    data,
    method: 'PUT',
    ...(options || {}),
  });
}

export async function addKnowledge(data: { [key: string]: any }, options?: { [key: string]: any }) {
  return request<TableListItem>('http://127.0.0.1:8081/api/v1/knowledge', {
    data,
    method: 'POST',
    ...(options || {}),
  });
}

/** 删除规则 DELETE /api/rule */
export async function removeKnowledge(id: number, options?: { [key: string]: any }) {
  return request<Record<string, any>>(`http://127.0.0.1:8081/api/v1/knowledge/${id}`, {
    method: 'DELETE',
    ...(options || {}),
  });
}
