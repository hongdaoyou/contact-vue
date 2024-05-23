package model

import (
	"gorm.io/gorm"
    "gorm.io/gorm/logger"
    "gorm.io/driver/mysql"
	
	"gin1/config"

	"crypto/md5"
	"encoding/hex"

	"fmt"
)

type UserModel struct {
    UID   int `json:"uid" gorm:"primary_key"`
    UserName string `json:"userName" gorm:"column:userName"`
	Phone string `json:"phone"`
	Passwd string `json:"passwd"`
}


// type UserModel struct {
// 	gorm.Model
//     UID   int
//     userName string
// 	phone string
// 	addr string
// }

func (m *UserModel ) TableName() string {
	return "my_info"
}

func (m *UserModel)CheckLogin(userName string, passwd string) interface{} {

	db, err := gorm.Open(mysql.Open(config.DSN), &gorm.Config{
        Logger: logger.Default.LogMode(logger.Silent),
    })
    if err != nil {
        panic(err)
    }
	db.AutoMigrate(&UserModel{})

	hash := md5.Sum([]byte(passwd))
	passwdHash := hex.EncodeToString(hash[:])

	// 创建用户
	user := UserModel{}
	
	result := db.Where(map[string]interface{}{"userName":userName, "passwd":passwdHash} ).First(&user);
	if result.Error != nil {
		panic(result.Error)
	}

	ret := map[string]interface{} {"result":config.SUCCESS, "data":user}

	return ret
}


func (m *UserModel)Get_userInfo(uid int ) interface{} {

	db, err := gorm.Open(mysql.Open(config.DSN), &gorm.Config{
        Logger: logger.Default.LogMode(logger.Silent),
    })
    if err != nil {
        panic(err)
    }

	db.AutoMigrate(&UserModel{})

	// 创建用户
	user := UserModel{}
	
	result := db.Where(map[string]interface{}{"uid":uid } ).Select("uid","userName", "phone").First(&user);
	
	fmt.Printf("%+v\n", user)

	if result.Error != nil {
		panic(result.Error)
	}

	ret := map[string]interface{} {"result":config.SUCCESS, "data":user}

	return ret
}


