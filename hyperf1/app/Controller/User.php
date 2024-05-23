<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;


use Hyperf\Di\Annotation\Inject;
use App\Model\UserModel;

class User
{
    /**
     * @Inject
     * @var RequestInterface
     */
    private $request;

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }

    public function checkLogin() {

        $userName = $this->request->input('userName');
        $passwd = $this->request->input('passwd');

        $obj = new UserModel();

        $ret = $obj->checkLogin($userName, $passwd);
        return $ret;
    }

    public function get_userInfo() {

        $uid = $this->request->input('uid');

        $obj = new UserModel();

        $ret = $obj->get_userInfo($uid);
        return $ret;
    }

    
}




