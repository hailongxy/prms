package api

import (
	"github.com/gin-gonic/gin"
	"net/http"
)

type XY struct {
	X string `json:"x"`
	Y int    `json:"y"`
}

type SearchData struct {
	Index   int    `json:"index"`
	Keyword string `json:"keyword"`
	Count   int    `json:"count"`
	Range   int    `json:"range"`
	Status  int    `json:"status"`
}

type OfflineData struct {
	Name string  `json:"name"`
	Cvr  float64 `json:"cvr"`
}

type OfflineChartData struct {
	Date  string `json:"date"`
	Type  string `json:"type"`
	Value int    `json:"value"`
}

type ResponseData struct {
	VisitData        []XY               `json:"visitData"`
	VisitData2       []XY               `json:"visitData2"`
	SalesData        []XY               `json:"salesData"`
	SearchData       []SearchData       `json:"searchData"`
	OfflineData      []OfflineData      `json:"offlineData"`
	OfflineChartData []OfflineChartData `json:"offlineChartData"`
}

type DataResponse struct {
	Data ResponseData `json:"data"`
}

func GetFakeAnalysisChartData(c *gin.Context) {
	data := DataResponse{
		Data: ResponseData{
			VisitData: []XY{
				{X: "2025-07-02", Y: 7},
				{X: "2025-07-03", Y: 5},
				// ... 可继续添加
			},
			VisitData2: []XY{
				{X: "2025-07-02", Y: 1},
				{X: "2025-07-03", Y: 6},
				// ...
			},
			SalesData: []XY{
				{X: "1月", Y: 299},
				{X: "2月", Y: 878},
				// ...
			},
			SearchData: []SearchData{
				{Index: 1, Keyword: "搜索关键词-0", Count: 71, Range: 31, Status: 1},
				{Index: 2, Keyword: "搜索关键词-1", Count: 635, Range: 64, Status: 1},
				// ...
			},
			OfflineData: []OfflineData{
				{Name: "Stores 0", Cvr: 0.8},
				{Name: "Stores 1", Cvr: 0.3},
				// ...
			},
			OfflineChartData: []OfflineChartData{
				{Date: "07:12", Type: "客流量", Value: 104},
				{Date: "07:12", Type: "支付笔数", Value: 77},
				// ...
			},
		},
	}

	c.JSON(http.StatusOK, data)
}
