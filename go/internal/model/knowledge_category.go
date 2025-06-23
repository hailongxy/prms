package model

import (
	"gorm.io/gorm"
	"time"
)

type KnowledgeCategory struct {
	ID        int64          `gorm:"primaryKey" json:"id"`
	Title     string         `gorm:"size:255" json:"title"`
	CreatedAt *time.Time     `gorm:"type:datetime" json:"created_at"`
	UpdatedAt *time.Time     `gorm:"type:datetime" json:"updated_at"`
	DeletedAt gorm.DeletedAt `gorm:"index" json:"deleted_at"` // 启用软删除
}

func (KnowledgeCategory) TableName() string {
	return "knowledge_categories" // 自定义表名
}
