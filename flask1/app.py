import os
import glob
import importlib
from flask import Flask, Blueprint
from flask.views import MethodView

from flask_cors import CORS


app = Flask(__name__)
CORS(app)  # 允许所有来源的跨域请求

import pymysql

from dbExts import db

# app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://localhost/Contact'
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://root:123456@localhost/Contact'

pymysql.install_as_MySQLdb()

db.init_app(app) # init_app()可以用来解决循环引用的问题

# 定义常量
app.config['SUCCESS'] = 'success'
app.config['FAILED'] = 'failed'


blueprint_files = glob.glob('Controller/*.py')

# 路由的前缀
router_path = "/contact/index/index/"

# 首字母小写, 并且去掉 Controller
def normalize_controller_name(controller_name):
    if controller_name.endswith('Controller'):
        controller_name = controller_name[:-10]
    return controller_name[0].lower() + controller_name[1:]

# 注册路由
def register_class_routes(bp, cls):
    view = cls.as_view(cls.__name__)

    for name in dir(cls):
        if not name.startswith('__'):
            attr = getattr(cls, name)
            if callable(attr) and not isinstance(attr, MethodView):
                # route_name = name.replace('_', '-')
                method_func = getattr(cls, name)
                bp.add_url_rule(f'/{name}', view_func=method_func, methods=['GET', 'POST'])
                print("--->", name)


# 注册,路由的蓝图
for file in blueprint_files:
    # 模块名
    module_name = 'Controller.' + os.path.basename(file)[:-3]
    module = importlib.import_module(module_name)

    # 获取文件名（不包含扩展名）
    blueprint_name = os.path.splitext(os.path.basename(file))[0]

    # 获取,模块中的变量
    blueprint = getattr(module, 'bp')

    # 控制器的类名
    cls = getattr(module, blueprint_name)

    # 为所有控制器的方法,注册路由
    register_class_routes(blueprint, cls)

    # 注册蓝图
    app.register_blueprint(blueprint, name=blueprint_name, url_prefix=router_path + normalize_controller_name(blueprint_name) )

    print(router_path + normalize_controller_name(blueprint_name) )

if __name__ == '__main__':
    app.debug = True
    app.run(port=8000);


