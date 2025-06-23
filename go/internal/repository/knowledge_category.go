package repository

import (
	"gorm.io/gorm"
	"prms/internal/database"
	"prms/internal/model"
)

type KnowledgeCategoryRepository struct {
	db *gorm.DB
}

func NewKnowledgeCategoryRepository() *KnowledgeCategoryRepository {
	return &KnowledgeCategoryRepository{db: database.DB}
}

func (k *KnowledgeCategoryRepository) GetKnowledgeCategoriesPaginated(page int, pageSize int) ([]model.KnowledgeCategory, int64, error) {
	var knowledgeCategories []model.KnowledgeCategory
	var total int64

	// 统计总条数
	if err := k.db.Model(&model.KnowledgeCategory{}).Count(&total).Error; err != nil {
		return nil, 0, err
	}

	// 查询分页数据
	offset := (page - 1) * pageSize
	if err := database.DB.
		Limit(pageSize).
		Offset(offset).
		Order("id DESC").
		Find(&knowledgeCategories).Error; err != nil {
		return nil, 0, err
	}

	return knowledgeCategories, total, nil
}

func (k *KnowledgeCategoryRepository) Create(knowledgeCategory *model.KnowledgeCategory) error {
	return k.db.Create(knowledgeCategory).Error
}

func (k *KnowledgeCategoryRepository) Update(knowledgeCategory *model.KnowledgeCategory) error {
	return k.db.Model(&model.KnowledgeCategory{}).Where("id = ?", knowledgeCategory.ID).Updates(knowledgeCategory).Error
}

func (k *KnowledgeCategoryRepository) DeleteByIDs(ids []int64) error {
	return k.db.Where("id IN ?", ids).Delete(&model.KnowledgeCategory{}).Error
}
