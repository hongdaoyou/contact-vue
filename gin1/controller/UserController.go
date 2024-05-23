package controller


import (
	"github.com/gin-gonic/gin"
	"net/http"
	"fmt"

	"gin1/model"

)

type UserController struct{
}

func (uc *UserController) F1() {
	fmt.Println("aaa")
}

  
func (uc *UserController) CheckLogin(c *gin.Context) {

	var jsonData map[string]interface{}

	if err := c.ShouldBindJSON(&jsonData); err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}
 
	userName := jsonData["userName"].(string)
	passwd := jsonData["passwd"].(string)
	
	// fmt.Println("AA:", userName);

	// 调用模型
	userModel := &model.UserModel{}
	ret := userModel.CheckLogin(userName, passwd)

	c.JSON(http.StatusOK, ret)
}

func (uc *UserController) Get_userInfo(c *gin.Context) {

	var jsonData map[string]interface{}

	if err := c.ShouldBindJSON(&jsonData); err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}
 
	uid := int(jsonData["uid"].(float64))

	// 调用模型
	userModel := &model.UserModel{}
	ret := userModel.Get_userInfo(uid)

	c.JSON(http.StatusOK, ret)
}

