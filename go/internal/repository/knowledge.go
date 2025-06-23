package repository

import (
	"gorm.io/gorm"
	"prms/internal/database"
	"prms/internal/model"
)

type KnowledgeRepository struct {
	db *gorm.DB
}

func NewKnowledgeRepository() *KnowledgeRepository {
	return &KnowledgeRepository{db: database.DB}
}

func (k *KnowledgeRepository) ListByCategoryId(categoryID int64) ([]model.Knowledge, error) {
	var knowledgeList []model.Knowledge
	err := k.db.Where("category_id = ?", categoryID).Order("sort_order DESC").Find(&knowledgeList).Error
	return knowledgeList, err
}

func (k *KnowledgeRepository) ListByParentID(parentID int64) ([]model.Knowledge, error) {
	var knowledgeList []model.Knowledge
	err := k.db.Where("parent_id = ?", parentID).Order("sort_order DESC").Find(&knowledgeList).Error
	return knowledgeList, err
}

func (k *KnowledgeRepository) Create(knowledge *model.Knowledge) error {
	return k.db.Create(knowledge).Error
}

func (k *KnowledgeRepository) Update(knowledge *model.Knowledge) error {
	return k.db.Model(&model.Knowledge{}).Where("id = ?", knowledge.ID).Updates(knowledge).Error
}

func (k *KnowledgeRepository) UpdateParentIDAndSortOrder(knowledge *model.Knowledge) error {
	return k.db.Model(&model.Knowledge{}).Where("id = ?", knowledge.ID).Select("parent_id", "sort_order").Updates(knowledge).Error
}

func (k *KnowledgeRepository) DeleteByID(id int64) error {
	return k.db.Where("id = ?", id).Delete(&model.Knowledge{}).Error
}

func (k *KnowledgeRepository) GetByID(id int64) (*model.Knowledge, error) {
	var knowledge model.Knowledge
	if err := k.db.First(&knowledge, id).Error; err != nil {
		return nil, err
	}
	return &knowledge, nil
}

func (k *KnowledgeRepository) GetMaxSortOrder(parentID int64) (int64, error) {
	var max int64
	err := k.db.Model(&model.Knowledge{}).
		Where("parent_id = ?", parentID).
		Select("COALESCE(MAX(sort_order), 0)").
		Scan(&max).Error
	if err != nil {
		return 0, err
	}
	return max, nil
}

func (k *KnowledgeRepository) UpdateSortOrders(knowledges []model.Knowledge) error {
	return k.db.Transaction(func(tx *gorm.DB) error {
		for _, knowledge := range knowledges {
			err := tx.Model(&model.Knowledge{}).
				Where("id = ?", knowledge.ID).
				Updates(map[string]interface{}{
					"parent_id":  knowledge.ParentID,
					"sort_order": knowledge.SortOrder,
				}).Error
			if err != nil {
				return err
			}
		}
		return nil
	})
}
