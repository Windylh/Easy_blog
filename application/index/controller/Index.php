<?php
namespace app\index\controller;

use think\facade\Request;

class Index extends Base
{
    public function index()
    {
        $cate = [];
        $catename = 'Easy_Blog';
        if(input('?id'))
        {
            $cate=[
                'cateid'=>input('id')
            ];
            $catename=model('cate')->where('id',input('id'))->value('catename');
        }
        $articles = model('article')->where($cate)->order('create_time','desc')->paginate(5);
        $viewData=[
            'articles'=>$articles,
            'title'=>$catename
        ];
        $this->assign($viewData);
        return view();
    }

    public function register()
    {
        if(request()->isAjax())
        {
            $data = Request::only(['username', 'password', 'conpass', 'email']);
            #$data = Request::only(['username', 'password', 'conpass', 'email','verify']);
            $result = model('user')->register($data);
            if($result == 1)
            {
                $this->success('注册成功','index/index/login');
            }
            else
            {
                $this->error($result);
            }

        }
        return view();
    }

    public function login()
    {
        if(request()->isAjax())
        {
            $data = Request::only(['username','password']);
            #$data = Request::only(['username','password','verify']);
            $result = model('user')->login($data);
            if($result == 1)
            {
                $this->success('登陆成功','index/index/index');
            }
            else
            {
                $this->error($result);
            }
        }

        return view();
    }

    public function logout()
    {
        session(null);
        if(session('?index.id'))
        {
            $this->error('退出失败');
        }
        else
        {
            $this->success('退出成功','index/index/index');
        }
    }
}
