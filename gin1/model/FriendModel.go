package model

import (
	"gorm.io/gorm"
    "gorm.io/gorm/logger"
    "gorm.io/driver/mysql"
	
	"gin1/config"

	// "fmt"
)

type FriendModel struct {
    UID   int `json:"uid" gorm:"primary_key"`
    UserName string `json:"userName" gorm:"column:userName"`
	Phone string `json:"phone"`
	Addr string `json:"addr"`
}

func (m *FriendModel ) TableName() string {
	return "friend"
}



func (m *FriendModel)Get_friend_list(start int, num int ) interface{} {

	db, err := gorm.Open(mysql.Open(config.DSN), &gorm.Config{
        Logger: logger.Default.LogMode(logger.Silent),
    })
    if err != nil {
        panic(err)
    }

	db.AutoMigrate(&FriendModel{})

	// 创建用户
	users := []FriendModel{}
	
	result := db.Offset(start).Limit(num).Select("uid","userName", "phone", "addr").Order("uid desc").Find(&users);
	// fmt.Printf("%+v\n", user)
	if result.Error != nil {
		panic(result.Error)
	}

	var totalNum int64 
	result = db.Model(&FriendModel{}).Count(&totalNum);
	// fmt.Printf("%+v\n", user)
	if result.Error != nil {
		panic(result.Error)
	}

	ret := map[string]interface{} {"result":config.SUCCESS, "data":users, "totalNum":totalNum}

	return ret
}



func (m *FriendModel)Add_friend(data interface{} ) interface{} {

	db, err := gorm.Open(mysql.Open(config.DSN), &gorm.Config{
        Logger: logger.Default.LogMode(logger.Silent),
    })
    if err != nil {
        panic(err)
    }

	db.AutoMigrate(&FriendModel{})

	data1 := data.(map[string]interface{} )
	userName := data1["userName"].(string)
	phone := data1["phone"].(string)
	addr := data1["addr"].(string)

	// 创建用户
	user := FriendModel{
		UserName: userName,
		Phone: phone,
		Addr: addr,
	}

	result := db.Create(&user)
	// fmt.Printf("%+v\n", user)

	if result.Error != nil {
		panic(result.Error)
	}

	ret := map[string]interface{} {"result":config.SUCCESS, "msg":"插入成功"}

	return ret
}


func (m *FriendModel)Update_friend(data interface{} ) interface{} {

	db, err := gorm.Open(mysql.Open(config.DSN), &gorm.Config{
        Logger: logger.Default.LogMode(logger.Silent),
    })
    if err != nil {
        panic(err)
    }

	db.AutoMigrate(&FriendModel{})

	data1 := data.(map[string]interface{} )
	userName := data1["userName"].(string)
	phone := data1["phone"].(string)
	addr := data1["addr"].(string)
	uid := int(data1["uid"].(float64))


	result := db.Model(&FriendModel{}).Where(map[string]interface{}{"uid":uid}).Updates(map[string]interface{} {"UserName": userName, "Phone": phone, "Addr": addr } )

	if result.Error != nil {
		panic(result.Error)
	}

	ret := map[string]interface{} {"result":config.SUCCESS, "msg":"更新成功"}
	return ret
}


func (m *FriendModel)Delete_friend(data interface{} ) interface{} {

	db, err := gorm.Open(mysql.Open(config.DSN), &gorm.Config{
        Logger: logger.Default.LogMode(logger.Silent),
    })
    if err != nil {
        panic(err)
    }

	db.AutoMigrate(&FriendModel{})

	data1 := data.(map[string]interface{} )
	uid := int(data1["uid"].(float64))

	result := db.Where(map[string]interface{}{"uid":uid}).Delete(&FriendModel{})
	if result.Error != nil {
		panic(result.Error)
	}

	ret := map[string]interface{} {"result":config.SUCCESS, "msg":"删除成功"}
	return ret
}

