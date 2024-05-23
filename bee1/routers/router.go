// @APIVersion 1.0.0
// @Title beego Test API
// @Description beego has a very cool tools to autogenerate documents for your API
// @Contact astaxie@gmail.com
// @TermsOfServiceUrl http://beego.me/
// @License Apache 2.0
// @LicenseUrl http://www.apache.org/licenses/LICENSE-2.0.html
package routers

import (
	"bee1/controllers"

	beego "github.com/beego/beego/v2/server/web"
)

func init() {
	// 路由前缀
	routerPre := "/contact/index/index/"
	// routerPre := "/a1"

	ns := beego.NewNamespace(routerPre,
		// beego.NSAutoRouter(&controllers.UserController{}),
		beego.NSRouter("/user/checkLogin", &controllers.UserController{}, "*:CheckLogin"),
	
		beego.NSRouter("/user/get_userInfo", &controllers.UserController{},"*:Get_userInfo" ),

		//-------
		
		beego.NSRouter("/friend/add_friend", &controllers.FriendController{},"*:Add_friend" ),

		beego.NSRouter("/friend/get_friend_list", &controllers.FriendController{},"*:Get_friend_list" ),
		beego.NSRouter("/friend/update_friend", &controllers.FriendController{},"*:Update_friend" ),
		
		beego.NSRouter("/friend/delete_friend", &controllers.FriendController{},"*:Delete_friend" ),

	)
	
	beego.AddNamespace(ns)


	// ns := beego.NewNamespace("/v1",
	// 	beego.NSNamespace( "/user",
	// 		beego.NSInclude(
	// 			&controllers.UserController{},
	// 		),
	// 	),
	// 	beego.NSNamespace("/object",
	// 		beego.NSInclude(
	// 			&controllers.ObjectController{},
	// 		),
	// 	),
	// )
	// beego.AddNamespace(ns)

}
