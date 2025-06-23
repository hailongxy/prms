package model

import (
	"gorm.io/gorm"
	"time"
)

type Knowledge struct {
	ID            int64          `gorm:"primaryKey" json:"id"`
	ParentID      int64          `gorm:"type=int" json:"parent_id"`
	CategoryID    int64          `gorm:"type=int" json:"category_id"`
	KnowledgeType string         `gorm:"type:enum('text', 'form', 'brain_mapping', 'flow_chart', 'table_of_contents');default:'text'" json:"knowledge_type"`
	Title         string         `gorm:"size:255" json:"title"`
	Content       string         `gorm:"type:mediumtext" json:"content"`
	SortOrder     int64          `gorm:"type=int" json:"sort_order"`
	CreatedAt     *time.Time     `gorm:"type:datetime" json:"created_at"`
	UpdatedAt     *time.Time     `gorm:"type:datetime" json:"updated_at"`
	DeletedAt     gorm.DeletedAt `gorm:"index" json:"deleted_at"`
}

func (Knowledge) TableName() string {
	return "knowledge" // 自定义表名
}
