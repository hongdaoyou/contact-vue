
package com.example.contactspring.Controller;

import com.example.contactspring.Model.*;
import org.json.JSONObject;
import org.springframework.web.bind.annotation.*;

import com.example.contactspring.config.Common;

@RestController
public class FriendControl {
    public final static String control_name = "/friend";

    // 添加用户
    @RequestMapping(value = Common.Contact_Mod + FriendControl.control_name + "/add_friend")
    @ResponseBody
    public String add_friend(@RequestBody String jsonStr) {
        try {
            JSONObject obj = new JSONObject(jsonStr);

            int uid = obj.getInt("uid");

            JSONObject reqData = obj.getJSONObject("data");

            FriendModel friendModel = new FriendModel();

            JSONObject ret = friendModel.add_friend(reqData);

            return ret.toString();

        } catch (Exception e) {

        }
        return null;
    }

    // 获取,用户的列表
    @RequestMapping(value = Common.Contact_Mod + FriendControl.control_name + "/get_friend_list")
    @ResponseBody
    public String get_friend_list(@RequestBody String jsonStr) {
        try {
            JSONObject reqData = new JSONObject(jsonStr);

            FriendModel friendModel = new FriendModel();

            JSONObject ret = friendModel.get_friend_list(reqData);

            return ret.toString();

        } catch (Exception e) {

        }
        return null;
    }

    // 更新用户
    @RequestMapping(value = Common.Contact_Mod + FriendControl.control_name + "/update_friend")
    @ResponseBody
    public String update_friend(@RequestBody String jsonStr) {
        try {
            JSONObject reqData = new JSONObject(jsonStr);

            // 获取uid
            int uid = reqData.getInt("uid");

            // if (true) {
            // return "abc";
            // }

            FriendModel friendModel = new FriendModel();

            JSONObject ret = friendModel.update_friend(reqData.getJSONObject("data"));

            return ret.toString();

        } catch (Exception e) {

        }
        return null;
    }

    // 删除用户
    @RequestMapping(value = Common.Contact_Mod + FriendControl.control_name + "/delete_friend")
    @ResponseBody
    public String delete_friend(@RequestBody String jsonStr) {
        try {
            JSONObject reqData = new JSONObject(jsonStr);

            int uid = reqData.getInt("uid");
            int friendUID = reqData.getJSONObject("data").getInt("uid");

            FriendModel friendModel = new FriendModel();
            JSONObject ret = friendModel.delete_friend(friendUID);
            return ret.toString();

        } catch (Exception e) {

        }
        return null;
    }
}