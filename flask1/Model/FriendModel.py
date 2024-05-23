from audioop import add
from unittest import result
from dbExts import db

import hashlib

from flask import current_app as app

class FriendModel(db.Model):
    __tablename__ = "friend"

    uid = db.Column(db.Integer, primary_key=True)
    userName = db.Column(db.String(80))
    phone = db.Column(db.String(120))
    addr = db.Column(db.String(120))

    # 获取,用户信息
    def get_friend_list(start, num):

        # 查询
        users = FriendModel.query.with_entities(FriendModel.userName, FriendModel.uid, FriendModel.phone, FriendModel.addr ).order_by(FriendModel.uid.desc() ).offset(start).limit(num).all()

        users_dict = [user._asdict() for user in users]

        # 求总个数
        totalNum = FriendModel.query.count()

        ret = {}
        ret['result'] = app.config['SUCCESS']
        ret['data'] = users_dict
        ret['totalNum'] = totalNum

        return ret;
    
    def add_friend(data):
        # print(data)
        userName = data['userName']
        phone = data['phone'] 
        addr = data['addr'] 

        # 查询
        user =  FriendModel(userName=userName, phone=phone, addr=addr )

        db.session.add(user)
        db.session.commit()

        if user.uid:
            result = app.config['SUCCESS']
            msg = '插入成功'
        else:
            result = app.config['FAILED']
            msg = '插入失败'

        ret = {}
        ret['result'] = result
        ret['msg'] = msg

        return ret;
    
    def update_friend(data):
        # print(data)
        userName = data['userName']
        phone = data['phone'] 
        addr = data['addr'] 
        friendUid = data['uid'] 

        ret = FriendModel.query.filter_by(uid=friendUid).update({
            FriendModel.userName:userName,
            FriendModel.phone:phone,
            FriendModel.addr:addr
        })

        if ret:
            result = app.config['SUCCESS']
            msg = '更新成功'
        else:
            result = app.config['FAILED']
            msg = '更新失败'

        ret = {}
        ret['result'] = result
        ret['msg'] = msg

        return ret;

    def delete_friend(data):
        # print(data)
        friendUid = data['uid'] 

        ret = FriendModel.query.filter_by(uid=friendUid).delete()

        if ret:
            result = app.config['SUCCESS']
            msg = '删除成功'
        else:
            result = app.config['FAILED']
            msg = '删除失败'

        ret = {}
        ret['result'] = result
        ret['msg'] = msg

        return ret;

