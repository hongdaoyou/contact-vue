from dbExts import db

import hashlib

from flask import current_app as app


class UserModel(db.Model):
    __tablename__ = "my_info"

    uid = db.Column(db.Integer, primary_key=True)
    userName = db.Column(db.String(80))
    phone = db.Column(db.String(120))
    # addr = db.Column(db.addr)
    passwd = db.Column(db.Integer)


    # 登录
    def checkLogin(userName, passwd):
        
        md5_hash = hashlib.md5()
        md5_hash.update(passwd.encode('utf-8'))

        passwd_md5 = md5_hash.hexdigest()
        # 查询
        user = UserModel.query.filter_by(userName=userName, passwd=passwd_md5 ).with_entities(UserModel.userName, UserModel.uid, UserModel.phone ).first()

        # print(type(user))

        ret = {}
        if user:
            ret['result'] = app.config['SUCCESS']
            ret['data'] = user._asdict()
        else:
            ret['result'] = app.config['FAILED']
            ret['msg'] = '不存在'
        return ret;
    
    # 获取,用户信息
    def get_userInfo(uid):

        # 查询
        user = UserModel.query.filter_by(uid=uid ).with_entities(UserModel.userName, UserModel.uid, UserModel.phone ).first()

        # print(type(user))

        ret = {}
        if user:
            ret['result'] = app.config['SUCCESS']
            ret['data'] = user._asdict()
        else:
            ret['result'] = app.config['FAILED']
            ret['msg'] = '不存在'
        return ret;
    
