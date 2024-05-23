package router

import (
	"gin1/controller"
	"github.com/gin-gonic/gin"
)


func SetupRouter(r *gin.Engine)  {
	// 控制器目录路径
	// 控制器目录路径

	firstName := "/contact/index/index"
	
	// user
	userCtrl := &controller.UserController{}

	user := r.Group(firstName + "/user") 
	user.Any("/checkLogin", userCtrl.CheckLogin )
	user.Any("/get_userInfo", userCtrl.Get_userInfo )

	// // friend
	friendCtrl := &controller.FriendController{}

	friend := r.Group(firstName + "/friend") 
	friend.Any("/add_friend", friendCtrl.Add_friend )
	friend.Any("/get_friend_list", friendCtrl.Get_friend_list )
	friend.Any("/update_friend", friendCtrl.Update_friend )
	friend.Any("/delete_friend", friendCtrl.Delete_friend )


}


