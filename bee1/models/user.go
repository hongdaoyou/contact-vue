package models

import (
	"github.com/beego/beego/v2/client/orm"

	"bee1/constant"

	"crypto/md5"
	"encoding/hex"

	_ "github.com/go-sql-driver/mysql"

)

type MyInfo struct {
	Id       int    `orm:"column(uid);auto"  json:"uid" `
	UserName string `orm:"column(userName);null"   json:"userName"`
	Phone    string `orm:"column(phone);null"   json:"phone" `
	Addr     string `orm:"column(addr);size(30)"   json:"addr"`
	Comment  string `orm:"column(comment);size(30)"  `
	Passwd   string `orm:"column(passwd);null"  json:"passwd" `
}

func (t *MyInfo) TableName() string {
	return "my_info"
}

func init() {
	orm.RegisterDriver("mysql", orm.DRMySQL) // 注册数据库驱动

	println(constant.DSN)
	orm.RegisterDataBase("default", "mysql", constant.DSN)
	
	orm.RegisterModel(new(MyInfo))
}

func CheckLogin(userName string, passwd string) interface{} {

	hash := md5.Sum([]byte(passwd))
	passwdHash := hex.EncodeToString(hash[:])

	// 过滤条件
	filters := map[string]interface{} {
		"userName": userName,
		"passwd": passwdHash,
	}

	var user MyInfo
	var result string

	q := orm.NewOrm().QueryTable(&MyInfo{})
	for field, value := range filters {
		q = q.Filter(field, value)
	}

	// err := q.One(&user)
	err := q.One(&user, "userName", "phone", "uid")
	if err == nil {
		result = constant.SUCCESS
	} else {
		result = constant.FAILED
	}

	ret := map[string]interface{} {"result":result, "data":user}

	return ret
}


func Get_userInfo(uid int) interface{} {
	// 过滤条件
	filters := map[string]interface{} {
		"uid": uid,
	}

	var user MyInfo
	var result string

	q := orm.NewOrm().QueryTable(&MyInfo{})
	for field, value := range filters {
		q = q.Filter(field, value)
	}

	err := q.One(&user, "userName", "phone", "uid")
	if err == nil {
		result = constant.SUCCESS
	} else {
		result = constant.FAILED
	}

	ret := map[string]interface{} {"result":result, "data":user}

	return ret
}

