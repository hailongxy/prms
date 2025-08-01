package api

import (
	"github.com/gin-gonic/gin"
	"net/http"
)

type Tag struct {
	Key   string `json:"key"`
	Label string `json:"label"`
}

type GeographicLocation struct {
	Label string `json:"label"`
	Key   string `json:"key"`
}

type Geographic struct {
	Province GeographicLocation `json:"province"`
	City     GeographicLocation `json:"city"`
}

type UserProfile struct {
	Name        string     `json:"name"`
	Avatar      string     `json:"avatar"`
	UserID      string     `json:"userid"`
	Email       string     `json:"email"`
	Signature   string     `json:"signature"`
	Title       string     `json:"title"`
	Group       string     `json:"group"`
	Tags        []Tag      `json:"tags"`
	NotifyCount int        `json:"notifyCount"`
	UnreadCount int        `json:"unreadCount"`
	Country     string     `json:"country"`
	Geographic  Geographic `json:"geographic"`
	Address     string     `json:"address"`
	Phone       string     `json:"phone"`
}

type Response struct {
	Data UserProfile `json:"data"`
}

func GetCurrentUser(c *gin.Context) {
	response := Response{
		Data: UserProfile{
			Name:      "Serati Ma",
			Avatar:    "https://gw.alipayobjects.com/zos/rmsportal/BiazfanxmamNRoxxVxka.png",
			UserID:    "00000001",
			Email:     "antdesign@alipay.com",
			Signature: "海纳百川，有容乃大",
			Title:     "交互专家",
			Group:     "蚂蚁金服－某某某事业群－某某平台部－某某技术部－UED",
			Tags: []Tag{
				{Key: "0", Label: "很有想法的"},
				{Key: "1", Label: "专注设计"},
				{Key: "2", Label: "辣~"},
				{Key: "3", Label: "大长腿"},
				{Key: "4", Label: "川妹子"},
				{Key: "5", Label: "海纳百川"},
			},
			NotifyCount: 12,
			UnreadCount: 11,
			Country:     "China",
			Geographic: Geographic{
				Province: GeographicLocation{
					Label: "浙江省",
					Key:   "330000",
				},
				City: GeographicLocation{
					Label: "杭州市",
					Key:   "330100",
				},
			},
			Address: "西湖区工专路 77 号",
			Phone:   "0752-268888888",
		},
	}

	c.JSON(http.StatusOK, response)
}
