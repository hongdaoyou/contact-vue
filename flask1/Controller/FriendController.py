from flask import current_app as app

from unittest import result
from flask import Blueprint
from flask import request

from flask import  session
from flask.views import MethodView

from dbExts import db

from Model.FriendModel import FriendModel


# 定义蓝图
bp = Blueprint('blueprint', __name__)

class FriendController(MethodView):
    def get_friend_list():
        data = request.get_json()
        start = data.get('start')
        num = data.get('num')
            
        # start = "0"
        # num = "3"

        if  not num:
            return { 'result': app.config['FAILED'], 'msg': "信息不全" }

        ret = FriendModel.get_friend_list(start, num)

        return ret 

    def add_friend():
        data = request.get_json()
        uid = data.get('uid')
        data1 = data.get('data')
        
        # start = "0"
        # num = "3"

        if  not uid:
            return { 'result': app.config['FAILED'], 'msg': "信息不全" }

        ret = FriendModel.add_friend(data1)

        return ret 

    def update_friend():
        data = request.get_json()
        uid = data.get('uid')
        data1 = data.get('data')
        
        # start = "0"
        # num = "3"

        if  not uid:
            return { 'result': app.config['FAILED'], 'msg': "信息不全" }

        ret = FriendModel.update_friend(data1)

        return ret 

    def delete_friend():
        data = request.get_json()
        uid = data.get('uid')
        data1 = data.get('data')
   
        if  not uid:
            return { 'result': app.config['FAILED'], 'msg': "信息不全" }

        ret = FriendModel.delete_friend(data1)

        return ret 
