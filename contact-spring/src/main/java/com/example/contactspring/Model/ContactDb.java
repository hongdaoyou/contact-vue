package com.example.contactspring.Model;

import java.sql.*;

public class ContactDb {
    public Connection connect = null;

    public String Db_URL = null;
    public String DB_USERNAME = null;
    public String DB_PASSWORD = null;

    // 初始化,连接
    public void init_connect() {
        try {
            this.connect = DriverManager.getConnection(this.Db_URL, this.DB_USERNAME, this.DB_PASSWORD);

        } catch (SQLException e) {
            e.printStackTrace();
        }

    }

    // 释放,连接
    public void release_connect() {
        if (this.connect != null) {
            try {
                this.connect.close();
            } catch (SQLException e) {
                // TODO Auto-generated catch block
                e.printStackTrace();
            }
        }
    }

}