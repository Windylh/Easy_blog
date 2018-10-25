<?php

namespace app\admin\controller;

use think\facade\Request;

class User extends Base
{
    public function list()
    {
        $users = model('user')-> paginate(10);
        $this->assign('users',$users);
        return view();
    }

    //添加用户
    public function add()
    {
        if(request()->isAjax())
        {
            $data = Request::only(['username','password','conpass','email']);
            $result = model('user')->add($data);
            if($result == 1)
            {
                $this->success("用户添加成功","admin/user/list");
            }
            else
            {
                $this->error($result);
            }
        }
        return view();
    }

    //编辑用户
    public function edit()
    {
        if(request()->isAjax())
        {
            $data = Request::only(['id','username','password','conpass','email']);
            $result = model('user')->edit($data);
            if($result == 1)
            {
                $this->success("用户修改成功","admin/user/list");
            }
            else
            {
                $this->error($result);
            }
        }
        $userInfo = model('user')->find(input('id'));
        $this->assign('userInfo', $userInfo);
        return view();
    }

    //删除用户
    public function del()
    {
        $userInfo = model('user')->find(input("post.id"));
        $result = $userInfo ->delete();
        if($result)
        {
            $this->success('用户删除成功','admin/user/list');
        }
        else
        {
            $this->error('用户删除失败');
        }
    }

    //用户状态
    public function Status()
    {
        $memberInfo = model('user')->find(input('post.id'));
        $memberInfo->status = input('post.status') ? 0 : 1;
        $result = $memberInfo->save();
        if ($result) {
            $this->success('操作成功！', 'admin/user/list');
        }else {
            $this->error('操作失败！');
        }
    }
}
