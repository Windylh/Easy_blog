<?php

namespace app\admin\controller;

class Home extends Base
{
    //后台首页
    public function index()
    {
        return view();
    }

    public function logout()
    {
        session(null);
        $this->success("退出成功", "admin/index/login");
    }
}
