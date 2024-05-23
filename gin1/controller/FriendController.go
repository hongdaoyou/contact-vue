package controller


import (
	"github.com/gin-gonic/gin"
	"net/http"
	// "fmt"

	"gin1/model"

)

type FriendController struct{
}


func (uc *FriendController) Get_friend_list(c *gin.Context) {

	var jsonData map[string]interface{}

	if err := c.ShouldBindJSON(&jsonData); err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}
 
	start := int(jsonData["start"].(float64))
	num := int(jsonData["num"].(float64))

	// 调用模型
	friendModel := &model.FriendModel{}
	ret := friendModel.Get_friend_list(start, num)

	c.JSON(http.StatusOK, ret)
}


func (uc *FriendController) Add_friend(c *gin.Context) {

	var jsonData map[string]interface{}

	if err := c.ShouldBindJSON(&jsonData); err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}
 
	data := jsonData["data"]

	// 调用模型
	friendModel := &model.FriendModel{}
	ret := friendModel.Add_friend(data)

	c.JSON(http.StatusOK, ret)
}


func (uc *FriendController) Update_friend(c *gin.Context) {

	var jsonData map[string]interface{}

	if err := c.ShouldBindJSON(&jsonData); err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}
 
	data := jsonData["data"]

	// 调用模型
	friendModel := &model.FriendModel{}
	ret := friendModel.Update_friend(data)

	c.JSON(http.StatusOK, ret)
}

func (uc *FriendController) Delete_friend(c *gin.Context) {

	var jsonData map[string]interface{}

	if err := c.ShouldBindJSON(&jsonData); err != nil {
		c.JSON(400, gin.H{"error": err.Error()})
		return
	}
 
	data := jsonData["data"]

	// 调用模型
	friendModel := &model.FriendModel{}
	ret := friendModel.Delete_friend(data)

	c.JSON(http.StatusOK, ret)
}