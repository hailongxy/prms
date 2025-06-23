package routers

import (
	"github.com/gin-contrib/cors"
	"github.com/gin-gonic/gin"
	"prms/internal/api"
	"time"
)

func InitRouter() *gin.Engine {
	router := gin.New()

	// 添加跨域配置
	router.Use(cors.New(cors.Config{
		AllowOrigins:     []string{"http://localhost:8000", "http://prms.hailongxy.cn"},
		AllowMethods:     []string{"GET", "POST", "PUT", "DELETE", "OPTIONS"},
		AllowHeaders:     []string{"Origin", "Content-Type", "Authorization"},
		ExposeHeaders:    []string{"Content-Length"},
		AllowCredentials: true,
		MaxAge:           12 * time.Hour,
	}))

	v1 := router.Group("/api/v1")
	{
		v1.GET("/knowledge-categories", api.GetKnowledgeCategories)
		v1.POST("/knowledge-categories", api.CreateKnowledgeCategory)
		v1.PUT("/knowledge-categories/:id", api.UpdateKnowledgeCategory)
		v1.DELETE("/knowledge-categories", api.DeleteKnowledgeCategories)
		v1.GET("/knowledge-tree", api.GetKnowledgeTree)
		v1.POST("/knowledge", api.CreateKnowledge)
		v1.PUT("/knowledge/:id", api.UpdateKnowledge)
		v1.DELETE("/knowledge/:id", api.DeleteKnowledge)
		v1.GET("/knowledge/:id", api.GetKnowledge)
		v1.POST("/knowledge/sort", api.SortKnowledge)
	}

	return router
}
