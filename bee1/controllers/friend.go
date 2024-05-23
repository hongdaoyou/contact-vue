package controllers

import (
	beego "github.com/beego/beego/v2/server/web"

	"encoding/json"
	
	"errors"

	"bee1/models"
)

// FriendController operations for Friend
type FriendController struct {
	beego.Controller
}


func (c *FriendController) Get_friend_list() {

	var data map[string]interface{}
	err := json.Unmarshal(c.Ctx.Input.RequestBody, &data)
	if err != nil {
		panic(errors.New("数据错误 "))
	}
	// println(data)

	start := int(data["start"].(float64))
	num := int(data["num"].(float64))

	ret := models.Get_friend_list(start, num)

	c.Data["json"] = ret
	c.ServeJSON()
}


func (c *FriendController) Add_friend() {

	var data map[string]interface{}
	err := json.Unmarshal(c.Ctx.Input.RequestBody, &data)
	if err != nil {
		panic(errors.New("数据错误 "))
	}
	// println(data)

	data1 := data["data"].(map[string]interface{})

	ret := models.Add_friend(data1)

	c.Data["json"] = ret
	c.ServeJSON()
}

func (c *FriendController) Update_friend() {

	var data map[string]interface{}
	err := json.Unmarshal(c.Ctx.Input.RequestBody, &data)
	if err != nil {
		panic(errors.New("数据错误 "))
	}
	// println(data)

	data1 := data["data"].(map[string]interface{})

	ret := models.Update_friend(data1)

	c.Data["json"] = ret
	c.ServeJSON()
}


func (c *FriendController) Delete_friend() {

	var data map[string]interface{}
	err := json.Unmarshal(c.Ctx.Input.RequestBody, &data)
	if err != nil {
		panic(errors.New("数据错误 "))
	}
	// println(data)

	data1 := data["data"].(map[string]interface{})

	ret := models.Delete_friend(data1)

	c.Data["json"] = ret
	c.ServeJSON()
}