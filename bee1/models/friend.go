package models

import (
	"github.com/beego/beego/v2/client/orm"

	"bee1/constant"

	_ "github.com/go-sql-driver/mysql"

)

type Friend struct {
	Id       int    `orm:"column(uid);auto" json:"uid" `
	UserName string `orm:"column(userName);null" json:"userName"`
	Phone    string `orm:"column(phone);null" json:"phone"`
	Addr     string `orm:"column(addr);null" json:"addr" `
	Comment  string `orm:"column(comment);size(30)" json:"comment"`
	Age      int    `orm:"column(age)" json:"age"`
}

func (t *Friend) TableName() string {
	return "friend"
}

func init() {
	orm.RegisterDriver("mysql", orm.DRMySQL) // 注册数据库驱动

	// println(constant.DSN)
	// orm.RegisterDataBase("default", "mysql", constant.DSN)
	
	orm.RegisterModel(new(Friend))
}


func Get_friend_list(start int, num int) interface{} {
	// 过滤条件
	// filters := map[string]interface{} {
	// 	"uid": uid,
	// }

	var users []Friend
	var result string

	q := orm.NewOrm().QueryTable(&Friend{}).OrderBy("-uid").Limit(num, start)
	// println(start, num)

	_, err := q.All(&users, "userName", "phone", "uid", "addr")
	if err == nil {
		result = constant.SUCCESS
	} else {
		result = constant.FAILED
	}

	totalNum,_ := orm.NewOrm().QueryTable(&Friend{}).Count()

	ret := map[string]interface{} {"result":result, "data":users, "totalNum":totalNum}

	return ret
}



func Add_friend(data map[string]interface{}) interface{} {

	var result string
	var msg string

	userName := data["userName"].(string)
	phone := data["phone"].(string)
	addr := data["addr"].(string)

	user := Friend {
		UserName:userName,
		Phone:phone,
		Addr:addr,
	}
	_,err := orm.NewOrm().Insert(&user)
	if err != nil {
		result = constant.FAILED
		msg = "插入失败"
	} else {
		result = constant.SUCCESS
		msg = "插入成功"
	}

	ret := map[string]interface{} {"result":result, "msg":msg}

	return ret
}


func Update_friend(data map[string]interface{}) interface{} {

	var result string
	var msg string

	uid := int(data["uid"].(float64))
	userName := data["userName"].(string)
	phone := data["phone"].(string)
	addr := data["addr"].(string)

	_,err := orm.NewOrm().QueryTable(&Friend{}).Filter("uid", uid ).Update(orm.Params{
		"userName":userName, "phone":phone, "addr":addr,
	} )

	if err != nil {
		result = constant.FAILED
		msg = "更新失败"
	} else {
		result = constant.SUCCESS
		msg = "更新成功"
	}

	ret := map[string]interface{} {"result":result, "msg":msg}

	return ret
}

func Delete_friend(data map[string]interface{}) interface{} {

	var result string
	var msg string

	uid := int(data["uid"].(float64))

	_,err := orm.NewOrm().QueryTable(&Friend{}).Filter("uid", uid ).Delete()
	if err != nil {
		result = constant.FAILED
		msg = "删除失败"
	} else {
		result = constant.SUCCESS
		msg = "删除成功"
	}

	ret := map[string]interface{} {"result":result, "msg":msg}

	return ret
}

