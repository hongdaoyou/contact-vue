package com.example.contactspring.Model;

import java.math.BigInteger;
import java.security.MessageDigest;
import java.sql.*;

import org.json.JSONObject;

import com.example.contactspring.config.*;

public class UserModel extends ContactDb {

    public UserModel() {
        this.Db_URL = Common.DB_URL;
        this.DB_USERNAME = Common.DB_USERNAME;
        this.DB_PASSWORD = Common.DB_PASSWORD;

        this.init_connect();
    }

    // 检查,登录
    public JSONObject checkLogin(JSONObject data) {

        try {
            String userName = data.getString("userName");
            String passwd = data.getString("passwd");

            // 获取,字符串的md5值
            MessageDigest mdObj = MessageDigest.getInstance("md5");
            mdObj.update(passwd.getBytes());

            String passwdMd5 = new BigInteger(1, mdObj.digest()).toString(16);

            // sql 语句
            String sql = "select uid, phone from my_info where userName=? and passwd=?";

            PreparedStatement statement = this.connect.prepareStatement(sql);

            // 设置值
            statement.setString(1, userName);
            statement.setString(2, passwdMd5);

            // 查询
            ResultSet sqlResult = statement.executeQuery();

            // 结果
            String result = Common.SUCCESS;
            JSONObject ret = new JSONObject();

            String msg = null;
            if (sqlResult.next()) { // 查找到
                String phone = sqlResult.getString("phone");
                int uid = sqlResult.getInt("uid");

                JSONObject resultData = new JSONObject();

                resultData.put("userName", userName);
                resultData.put("phone", phone);
                resultData.put("uid", uid);

                ret.put("data", resultData);
                msg = "登录成功";
            } else {
                result = Common.FAILED;

                msg = "登录失败";
            }

            ret.put("result", result);
            ret.put("msg", msg);

            return ret;
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            this.release_connect();
        }
        return null;
    }

    public JSONObject get_userInfo(int uid) {

        try {
            JSONObject ret = new JSONObject(); // 返回值
            String result = Common.SUCCESS;
            String msg = null;

            String sql = "select userName, phone, uid from my_info where uid=? ";

            PreparedStatement statement = this.connect.prepareStatement(sql);

            statement.setInt(1, uid);
            ResultSet sqlResult = statement.executeQuery();

            if (sqlResult.next()) {
                String userName = sqlResult.getString("userName");
                String phone = sqlResult.getString("phone");

                JSONObject data = new JSONObject();
                data.put("userName", userName);
                data.put("phone", phone);
                data.put("uid", uid);

                ret.put("result", result);
                ret.put("data", data);

                msg = "获取成功";
            } else {
                result = Common.FAILED;
                msg = "获取失败";
            }

            ret.put("result", result);
            ret.put("msg", msg);

            return ret;
        } catch (Exception e) {
            e.printStackTrace();
        }

        return null;
    }

    public JSONObject update_my_info(JSONObject reqData) {

        try {
            String userName = reqData.getString("userName");
            String phone = reqData.getString("phone");

            int uid = reqData.getInt("uid");

            String sql = "update my_info set userName=?, phone=? where uid=?";

            PreparedStatement statement = this.connect.prepareStatement(sql);

            // 设置值
            statement.setString(1, userName);
            statement.setString(2, phone);
            statement.setInt(3, uid);

            // 执行
            int updateFlag = statement.executeUpdate();

            String result = null;
            String msg = null;
            if (updateFlag == 1) {
                result = Common.SUCCESS;
                msg = "更新成功";
            } else {
                result = Common.FAILED;
                msg = "更新失败";
            }
            // 返回值
            JSONObject ret = new JSONObject();
            ret.put("result", result);
            ret.put("msg", msg);

            return ret;

        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            try {
                this.connect.close();
                this.connect = null;
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }

        return null;
    }

}
