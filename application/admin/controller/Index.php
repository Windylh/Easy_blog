<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    //登陆后直接跳转
    public function initialize()
    {
        if(session('?admin.id'))
        {
            $this ->redirect('admin/home/index');
        }
    }
    //后台登录
    public function login()
    {
        if(request()->isAjax())
        {
            $data=[
                'username' =>input('post.username'),
                'password' =>input('post.password')
            ];
            $result = model('Admin')->login($data);
            if($result == 1)
            {
                $this->success('登陆成功','admin/home/index');
            }
            else
            {
                $this->error($result);
            }
        }
        return view();
    }
    public function register()
    {
        if(request()->isAjax())
        {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'conpass' => input('post.conpass'),
                'email' => input('post.email')
            ];
            $result = model('Admin')->register($data);
            if($result == 1)
            {
                $this->success('注册成功', 'admin/index/login');
            }
            else
            {
                $this->error($result);
            }
        }
        return view();
    }
}
