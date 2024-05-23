package controllers

import (
	beego "github.com/beego/beego/v2/server/web"
	"encoding/json"
	
	"errors"

	"bee1/models"
)

// UserController operations for User
type UserController struct {
	beego.Controller
}

func (c *UserController) CheckLogin() {

	var data map[string]interface{}
	err := json.Unmarshal(c.Ctx.Input.RequestBody, &data)
	if err != nil {
		panic(errors.New("数据错误 "))
	}
	// println(data)

	userName := data["userName"].(string)
	passwd := data["passwd"].(string)
	ret := models.CheckLogin(userName, passwd)

	c.Data["json"] = ret
	c.ServeJSON()
}


func (c *UserController) Get_userInfo() {

	var data map[string]interface{}
	err := json.Unmarshal(c.Ctx.Input.RequestBody, &data)
	if err != nil {
		panic(errors.New("数据错误 "))
	}
	// println(data)

	uid := int(data["uid"].(float64))
	ret := models.Get_userInfo(uid)

	c.Data["json"] = ret
	c.ServeJSON()
}

