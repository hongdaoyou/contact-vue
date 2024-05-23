from flask import current_app as app

from unittest import result
from flask import Blueprint
from flask import request

from flask import  session
from flask.views import MethodView

from dbExts import db

from Model.UserModel import UserModel


# 定义蓝图
bp = Blueprint('blueprint', __name__)

class UserController(MethodView):
    def checkLogin():
        data = request.get_json()

        userName = data.get('userName')
        passwd = data.get('passwd')

        if not userName or not passwd:
            return { 'result': app.config['FAILED'], 'msg': "信息不全" }
            
        # userName = "hdy"
        # passwd = "12345"
        ret = UserModel.checkLogin(userName, passwd)

        return ret 

    def get_userInfo():
        data = request.get_json()
        uid = data.get('uid')

        ret = UserModel.get_userInfo(uid)

        return ret 
