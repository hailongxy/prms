package service

import (
	"prms/internal/model"
	"prms/internal/repository"
)

type KnowledgeService struct {
}

func NewKnowledgeService() *KnowledgeService {
	return &KnowledgeService{}
}

func (k *KnowledgeService) GetKnowledgeCategories(page, pageSize int) ([]model.KnowledgeCategory, int64, error) {
	knowledgeCategoryRepository := repository.NewKnowledgeCategoryRepository()
	knowledgeCategories, total, err := knowledgeCategoryRepository.GetKnowledgeCategoriesPaginated(page, pageSize)
	if err != nil {
		return nil, 0, err
	}

	return knowledgeCategories, total, nil
}

func (k *KnowledgeService) CreateKnowledgeCategory(knowledgeCategory *model.KnowledgeCategory) error {
	knowledgeCategoryRepository := repository.NewKnowledgeCategoryRepository()
	return knowledgeCategoryRepository.Create(knowledgeCategory)
}

func (k *KnowledgeService) UpdateKnowledgeCategory(knowledgeCategory *model.KnowledgeCategory) error {
	knowledgeCategoryRepository := repository.NewKnowledgeCategoryRepository()
	return knowledgeCategoryRepository.Update(knowledgeCategory)
}

func (k *KnowledgeService) DeleteKnowledgeCategories(ids []int64) error {
	knowledgeCategoryRepository := repository.NewKnowledgeCategoryRepository()
	return knowledgeCategoryRepository.DeleteByIDs(ids)
}

type Knowledge struct {
	ID            int64        `json:"id"`
	Title         string       `json:"title"`
	KnowledgeType string       `json:"knowledge_type"`
	ParentID      *int64       `json:"parent_id"`
	Children      []*Knowledge `json:"children" gorm:"-"`
}

func (k *KnowledgeService) GetKnowledgeTree(categoryID int64) ([]*Knowledge, error) {
	knowledgeRepository := repository.NewKnowledgeRepository()
	knowledgeList, err := knowledgeRepository.ListByCategoryId(categoryID)
	knowledgeTree := k.buildTree(knowledgeList)
	if err != nil {
		return nil, err
	}

	return knowledgeTree, nil
}

func (k *KnowledgeService) buildTree(knowledgeList []model.Knowledge) []*Knowledge {
	var all []Knowledge
	for _, knowledge := range knowledgeList {
		all = append(all, Knowledge{
			ID:            knowledge.ID,
			Title:         knowledge.Title,
			KnowledgeType: knowledge.KnowledgeType,
			ParentID:      &knowledge.ParentID,
		})
	}

	idMap := make(map[int64]*Knowledge)

	roots := []*Knowledge{}

	for i := range all {
		idMap[all[i].ID] = &all[i]
	}

	for i := range all {
		node := &all[i]
		if *node.ParentID != 0 {
			parent := idMap[*node.ParentID]
			parent.Children = append(parent.Children, idMap[node.ID])
		} else {
			roots = append(roots, idMap[node.ID])
		}
	}

	return roots
}

func (k *KnowledgeService) CreateKnowledge(knowledge *model.Knowledge) error {
	knowledgeRepository := repository.NewKnowledgeRepository()
	maxSortOrder, err := knowledgeRepository.GetMaxSortOrder(knowledge.ParentID)
	if err != nil {
		return err
	}
	knowledge.SortOrder = maxSortOrder + 1
	return knowledgeRepository.Create(knowledge)
}

func (k *KnowledgeService) UpdateKnowledge(knowledge *model.Knowledge) error {
	knowledgeRepository := repository.NewKnowledgeRepository()
	return knowledgeRepository.Update(knowledge)
}

func (k *KnowledgeService) DeleteKnowledge(id int64) error {
	knowledgeRepository := repository.NewKnowledgeRepository()
	return knowledgeRepository.DeleteByID(id)
}

func (k *KnowledgeService) GetKnowledge(categoryID int64) (*model.Knowledge, error) {
	knowledgeRepository := repository.NewKnowledgeRepository()
	knowledge, err := knowledgeRepository.GetByID(categoryID)
	if err != nil {
		return nil, err
	}

	return knowledge, nil
}

func (k *KnowledgeService) Sort(movedID, targetID int64, position string) error {
	knowledgeRepository := repository.NewKnowledgeRepository()
	// 获取两个节点
	moved, err := knowledgeRepository.GetByID(movedID)
	if err != nil {
		return err
	}
	target, err := knowledgeRepository.GetByID(targetID)
	if err != nil {
		return err
	}

	if position == "inside" {
		// 设置 parent_id = target.id，重新插入到 target 子节点最后
		moved.ParentID = target.ID
		maxSortOrder, err := knowledgeRepository.GetMaxSortOrder(target.ID)
		if err != nil {
			return err
		}
		moved.SortOrder = maxSortOrder + 1
		// 直接更新 moved 节点
		return knowledgeRepository.UpdateParentIDAndSortOrder(moved)
	} else {
		// 保持原父级为 target 的父级
		parentID := target.ParentID
		moved.ParentID = parentID

		// 获取所有同级节点（除了 moved 自身）
		siblings, err := knowledgeRepository.ListByParentID(parentID)
		if err != nil {
			return err
		}

		// 排除 moved 自身
		var filteredSiblings []model.Knowledge
		for _, s := range siblings {
			if s.ID != moved.ID {
				filteredSiblings = append(filteredSiblings, s)
			}
		}

		// 将 moved 插入到正确位置
		insertIndex := -1
		for i, s := range filteredSiblings {
			if s.ID == target.ID {
				insertIndex = i
				break
			}
		}
		if insertIndex == -1 {
			// 如果没找到 target，放到最后
			insertIndex = len(filteredSiblings)
		} else {
			if position == "after" {
				insertIndex++
			}
		}

		// 构造新排序列表
		newOrder := make([]model.Knowledge, 0, len(filteredSiblings)+1)
		newOrder = append(newOrder, filteredSiblings[:insertIndex]...)
		newOrder = append(newOrder, *moved)
		newOrder = append(newOrder, filteredSiblings[insertIndex:]...)

		// 重新赋值 sort_order，倒序赋值，顺序从 len 到 1
		for i := range newOrder {
			newOrder[i].SortOrder = int64(len(newOrder) - i)
		}

		// 批量更新所有 affected 节点
		err = knowledgeRepository.UpdateSortOrders(newOrder)
		if err != nil {
			return err
		}

		return nil
	}
}
