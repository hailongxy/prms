package internal

import (
	"prms/internal/routers"
)

type App struct {
}

func NewApp() *App {
	return &App{}
}

func (app *App) Run() error {
	router := routers.InitRouter()
	return router.Run(":8081")
}
