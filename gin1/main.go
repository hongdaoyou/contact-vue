package main

import (
	"github.com/gin-gonic/gin"
	"github.com/gin-contrib/cors"

	// "net/http"
	"gin1/router"

)

func main() {
    r := gin.Default()

	r.Use(cors.Default())

	router.SetupRouter(r)
	
    r.Run(":8000") //默认,在本地8080端口启动服务

}