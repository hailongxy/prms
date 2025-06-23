package api

import (
	"github.com/gin-gonic/gin"
	"net/http"
	"prms/internal/model"
	"prms/internal/service"
	"strconv"
)

func GetKnowledgeCategories(c *gin.Context) {
	pageStr := c.Query("current")
	page, err := strconv.Atoi(pageStr)
	if err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "invalid page"})
		return
	}
	pageSizeStr := c.Query("pageSize")
	pageSize, err := strconv.Atoi(pageSizeStr)
	if err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "invalid page size"})
		return
	}
	knowledgeService := service.NewKnowledgeService()
	knowledgeCategories, total, err := knowledgeService.GetKnowledgeCategories(page, pageSize)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "get knowledge categories failed"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"msg":   "success",
		"code":  200,
		"data":  knowledgeCategories,
		"total": total,
	})
}

func CreateKnowledgeCategory(c *gin.Context) {
	var knowledgeCategory model.KnowledgeCategory
	if err := c.ShouldBindJSON(&knowledgeCategory); err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}
	knowledgeService := service.NewKnowledgeService()
	err := knowledgeService.CreateKnowledgeCategory(&knowledgeCategory)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "create knowledge category failed"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"msg":  "success",
		"code": 200,
	})
}

func UpdateKnowledgeCategory(c *gin.Context) {
	var knowledgeCategory model.KnowledgeCategory
	if err := c.ShouldBindJSON(&knowledgeCategory); err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}

	idStr := c.Param("id")

	var err error
	knowledgeCategory.ID, err = strconv.ParseInt(idStr, 10, 64)
	if err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}
	knowledgeService := service.NewKnowledgeService()
	err = knowledgeService.UpdateKnowledgeCategory(&knowledgeCategory)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "create knowledge category failed"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"msg":  "success",
		"code": 200,
	})
}

func DeleteKnowledgeCategories(c *gin.Context) {

	type Request struct {
		IDs []int64 `json:"ids"`
	}

	var req Request
	if err := c.ShouldBindJSON(&req); err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}

	knowledgeService := service.NewKnowledgeService()
	var err error
	err = knowledgeService.DeleteKnowledgeCategories(req.IDs)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "delete knowledge category failed"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"msg":  "success",
		"code": 200,
	})
}

func GetKnowledgeTree(c *gin.Context) {
	categoryIDStr := c.Query("categoryID")
	categoryID, err := strconv.ParseInt(categoryIDStr, 10, 64)
	if err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"error": "invalid categoryID"})
		return
	}
	knowledgeService := service.NewKnowledgeService()
	knowledgeTree, err := knowledgeService.GetKnowledgeTree(categoryID)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "get knowledge tree failed"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"msg":  "success",
		"code": 200,
		"data": knowledgeTree,
	})
}

func CreateKnowledge(c *gin.Context) {
	var knowledge model.Knowledge
	if err := c.ShouldBindJSON(&knowledge); err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}
	knowledgeService := service.NewKnowledgeService()
	err := knowledgeService.CreateKnowledge(&knowledge)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "create knowledge failed"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"msg":  "success",
		"code": 200,
	})
}

func UpdateKnowledge(c *gin.Context) {
	var knowledge model.Knowledge
	if err := c.ShouldBindJSON(&knowledge); err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}

	idStr := c.Param("id")

	var err error
	knowledge.ID, err = strconv.ParseInt(idStr, 10, 64)
	if err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}
	knowledgeService := service.NewKnowledgeService()
	err = knowledgeService.UpdateKnowledge(&knowledge)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "update knowledge failed"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"msg":  "success",
		"code": 200,
	})
}

func DeleteKnowledge(c *gin.Context) {

	idStr := c.Param("id")

	knowledgeID, err := strconv.ParseInt(idStr, 10, 64)
	if err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}

	knowledgeService := service.NewKnowledgeService()
	err = knowledgeService.DeleteKnowledge(knowledgeID)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "delete knowledge failed"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"msg":  "success",
		"code": 200,
	})
}

func GetKnowledge(c *gin.Context) {
	idStr := c.Param("id")

	knowledgeID, err := strconv.ParseInt(idStr, 10, 64)
	if err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}
	knowledgeService := service.NewKnowledgeService()
	knowledge, err := knowledgeService.GetKnowledge(knowledgeID)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"error": "get knowledge failed"})
		return
	}

	c.JSON(http.StatusOK, gin.H{
		"msg":  "success",
		"code": 200,
		"data": knowledge,
	})
}

type SortRequest struct {
	MovedID  int64  `json:"moved_id" binding:"required"`
	TargetID int64  `json:"target_id" binding:"required"`
	Position string `json:"position" binding:"required"` // before / after / inside
}

func SortKnowledge(c *gin.Context) {
	var req SortRequest
	if err := c.ShouldBindJSON(&req); err != nil {
		c.JSON(http.StatusBadRequest, gin.H{"code": 400, "msg": "参数错误"})
		return
	}

	// 伪代码逻辑（请根据你实际的 DB 表结构改写）
	// 例如：你的表结构中有 parent_id, sort_order 字段
	knowledgeService := service.NewKnowledgeService()
	err := knowledgeService.Sort(req.MovedID, req.TargetID, req.Position)
	if err != nil {
		c.JSON(http.StatusInternalServerError, gin.H{"code": 500, "msg": "排序失败"})
		return
	}

	c.JSON(http.StatusOK, gin.H{"code": 200, "msg": "排序成功"})
}
