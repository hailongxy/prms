package main

import (
	"fmt"
	"prms/internal"
	"prms/internal/database"
)

func main() {
	err := database.InitDatabase()
	if err != nil {
		fmt.Println(err)
		return
	}

	app := internal.NewApp()
	err = app.Run()

}
