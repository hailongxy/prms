package database

import (
	"github.com/spf13/viper"
	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)

var DB *gorm.DB

func InitDatabase() error {
	v := viper.New()
	v.SetConfigFile("configs/cfg.toml")
	err := v.ReadInConfig()
	if err != nil {
		return err
	}
	host := v.GetString("mysql.host")
	port := v.GetString("mysql.port")
	user := v.GetString("mysql.user")
	password := v.GetString("mysql.password")
	dbname := v.GetString("mysql.dbname")

	dsn := user + ":" + password + "@tcp(" + host + ":" + port + ")/" + dbname + "?charset=utf8&parseTime=True&loc=Local"
	DB, err = gorm.Open(mysql.Open(dsn), &gorm.Config{})
	return err
}
