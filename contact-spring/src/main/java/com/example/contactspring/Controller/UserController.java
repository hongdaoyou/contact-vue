package com.example.contactspring.Controller;

import jakarta.servlet.http.*;

import com.example.contactspring.Controller.config.SessionManager;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.context.request.*;

import com.example.contactspring.config.*;
import com.example.contactspring.Model.*;

import java.util.Arrays;

import org.json.JSONObject;

// import jakarta.servlet.SessionCookieConfig;

@RestController
public class UserController {
    final static String control_name = "/user";

    @RequestMapping("/user")
    public String home() {
        ServletRequestAttributes attr = (ServletRequestAttributes) RequestContextHolder.currentRequestAttributes();
        Cookie[] cookies = attr.getRequest().getCookies();

        if (cookies != null) {
            for (Cookie cookie : cookies) {
                System.out.println(cookie.getName());

                System.out.println(cookie.getValue());

                // 判断 Cookie 的名称，找到你需要的 Cookie
                if ("myCookieName".equals(cookie.getName())) {
                    // 获取 Cookie 的值
                    String cookieValue = cookie.getValue();
                    // 处理 Cookie 的值
                    // ...
                    return cookieValue;
                }
            }
        }

        // 如果没有找到对应的 Cookie，返回默认值或进行其他处理
        return "default Value";

        // return "user!";
    }

    // 用户的登录
    @RequestMapping(value = Common.Contact_Mod + UserController.control_name + "/checkLogin")
    @ResponseBody
    public String checkLogin(@RequestBody String jsonStr) {

        ServletRequestAttributes attr = (ServletRequestAttributes) RequestContextHolder.currentRequestAttributes();
        HttpServletRequest request = attr.getRequest();
        HttpSession mySession = request.getSession();

        // ServletRequestAttributes attr = (ServletRequestAttributes)
        // RequestContextHolder.currentRequestAttributes();
        // Cookie[] cookies = attr.getRequest().getCookies();

        // if (cookies != null) {
        // for (Cookie cookie : cookies) {
        // System.out.println(cookie.getName());

        // System.out.println(cookie.getValue());

        // // 判断 Cookie 的名称，找到你需要的 Cookie
        // if ("myCookieName".equals(cookie.getName())) {
        // // 获取 Cookie 的值
        // String cookieValue = cookie.getValue();
        // // 处理 Cookie 的值
        // // ...
        // return cookieValue;
        // }
        // }
        // System.out.println("A" + cookies.length);

        // } else {
        // System.out.println("empty...");
        // }

        try {
            JSONObject recvData = new JSONObject(jsonStr);

            String userName = recvData.getString("userName");
            String passwd = recvData.getString("passwd");

            JSONObject data = new JSONObject();
            data.put("userName", userName);
            data.put("passwd", passwd);

            UserModel userModel = new UserModel();

            JSONObject ret = userModel.checkLogin(data);
            if (ret.getString("result") == Common.SUCCESS) {

                // 设置,缓存
                SessionManager sessionObj = new SessionManager();
                sessionObj.setAttribute("uid", ret.getJSONObject("data").getInt("uid"));
                sessionObj.setAttribute("userName", userName);

            }
            // System.out.println(ret.toString());
            return ret.toString();
        } catch (Exception e) {
            e.printStackTrace();
        }
        return null;
    }

    // 获取,用户的信息
    @RequestMapping(value = Common.Contact_Mod + UserController.control_name + "/get_userInfo")
    @ResponseBody
    public String get_userInfo(@RequestBody String jsonStr) {
        try {

            // SessionManager sessionObj = new SessionManager();
            // int id = (int) sessionObj.getAttribute("uid");
            // System.out.println(id);

            JSONObject obj = new JSONObject(jsonStr);

            int uid = obj.getInt("uid");

            UserModel userModel = new UserModel();

            // 获取,用户的信息
            JSONObject ret = userModel.get_userInfo(uid);

            return ret.toString();
        } catch (Exception e) {
            e.printStackTrace();
        }

        return null;
    }

    // 更新,用户的信息
    @RequestMapping(value = Common.Contact_Mod + UserController.control_name + "/update_my_info")
    @ResponseBody
    public String update_my_info(@RequestBody String jsonStr) {
        try {
            JSONObject obj = new JSONObject(jsonStr);

            int uid = obj.getInt("uid");

            JSONObject reqData = obj.getJSONObject("data");

            reqData.put("uid", uid);
            // String userName = reqData.getString("userName");
            // String phone = reqData.getString("phone");

            UserModel userModel = new UserModel();

            JSONObject ret = userModel.update_my_info(reqData);

            return ret.toString();

        } catch (Exception e) {
            e.printStackTrace();
        }

        return null;
    }
}
