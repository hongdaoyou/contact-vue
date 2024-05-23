package com.example.contactspring.Model;

import java.sql.*;

import org.json.JSONArray;
import org.json.JSONObject;

import com.example.contactspring.config.*;

public class FriendModel extends ContactDb {

    public FriendModel() {
        this.Db_URL = Common.DB_URL;
        this.DB_USERNAME = Common.DB_USERNAME;
        this.DB_PASSWORD = Common.DB_PASSWORD;

        this.init_connect();
    }

    // 添加
    public JSONObject add_friend(JSONObject reqData) {
        try {
            String userName = reqData.getString("userName");
            String phone = reqData.getString("phone");
            String addr = reqData.getString("addr");

            String sql = "insert into friend(userName, phone , addr) values(?, ?, ?)";

            PreparedStatement statement = this.connect.prepareStatement(sql);
            statement.setString(1, userName);
            statement.setString(2, phone);
            statement.setString(3, addr);

            String result = Common.SUCCESS;
            String msg = null;

            // 执行
            int insertFlag = statement.executeUpdate();
            if (insertFlag == 1) {
                msg = "插入成功";
            } else {
                msg = "插入失败";
            }

            // 返回值
            JSONObject obj = new JSONObject();

            obj.put("result", result);
            obj.put("msg", msg);

            return obj;
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            this.release_connect();
        }

        return null;
    }

    // 获取,用户列表
    public JSONObject get_friend_list(JSONObject reqData) {
        try {
            int start = reqData.getInt("start");
            int num = reqData.getInt("num");

            JSONObject ret = new JSONObject();
            int totalNum = 0; // 总的条数

            // 获取,总的条数
            String countSql = "select count(*) as countNum from friend  ";
            Statement countStatement = this.connect.createStatement();

            ResultSet countResult = countStatement.executeQuery(countSql);
            if (countResult.next()) {
                totalNum = countResult.getInt("countNum");
            }

            String sql = "select * from friend limit ?,? ";

            PreparedStatement statement = this.connect.prepareStatement(sql);

            statement.setInt(1, start);
            statement.setInt(2, num);

            // 执行
            ResultSet sqlResult = statement.executeQuery();

            JSONArray retData = new JSONArray();

            while (sqlResult.next()) {
                JSONObject oneItem = new JSONObject();
                oneItem.put("uid", sqlResult.getInt("uid"));
                oneItem.put("userName", sqlResult.getString("userName"));
                oneItem.put("phone", sqlResult.getString("phone"));
                oneItem.put("addr", sqlResult.getString("addr"));

                retData.put(oneItem);
            }

            ret.put("result", Common.SUCCESS);
            ret.put("data", retData);
            ret.put("totalNum", totalNum);

            return ret;
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            this.release_connect();
        }

        return null;
    }

    // 更新,用户
    public JSONObject update_friend(JSONObject reqData) {
        try {
            int uid = reqData.getInt("uid");

            String userName = reqData.getString("userName");
            String phone = reqData.getString("phone");
            String addr = reqData.getString("addr");

            // 返回的变量
            JSONObject ret = new JSONObject();
            String result = Common.SUCCESS;
            String msg = null;

            String sql = "update friend set userName=?, phone=?, addr=? where uid=?";

            PreparedStatement statement = this.connect.prepareStatement(sql);

            statement.setString(1, userName);
            statement.setString(2, phone);
            statement.setString(3, addr);
            statement.setInt(4, uid);

            // 更新
            int updateFlag = statement.executeUpdate();

            if (updateFlag == 1) {
                msg = "更新成功";
            } else {
                msg = "更新失败";
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

    // 添加
    public JSONObject delete_friend(int friendUID) {
        try {
            JSONObject ret = new JSONObject();
            String result = Common.SUCCESS;
            String msg = null;

            // sql
            String sql = "delete from friend where uid=?";

            PreparedStatement statement = this.connect.prepareStatement(sql);

            statement.setInt(1, friendUID);

            // 执行
            int deleteFlag = statement.executeUpdate();

            if (deleteFlag == 1) {
                msg = "删除成功";
            } else {
                msg = "删除失败";
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

}
