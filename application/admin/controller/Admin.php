<?php

namespace app\admin\controller;

use think\facade\Request;

class Admin extends Base
{
    //登陆后直接跳转
    public function initialize()
    {
        if(session('admin.super')!=1)
        {
            $this ->redirect('admin/home/index');
        }
    }
    public function list()
    {
        $admins = model('admin')-> paginate(10);
        $this->assign('admins',$admins);
        return view();
    }

    //添加管理员
    public function add()
    {
        if(request()->isAjax())
        {
            $data = Request::only(['username','password','conpass','email']);
            $result = model('admin')->add($data);
            if($result == 1)
            {
                $this->success("管理员添加成功","admin/admin/list");
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
            $result = model('admin')->edit($data);
            if($result == 1)
            {
                $this->success("用户修改成功","admin/admin/list");
            }
            else
            {
                $this->error($result);
            }
        }
        $adminInfo = model('admin')->find(input('id'));
        $this->assign('adminInfo', $adminInfo);
        return view();
    }

    //删除管理员
    public function del()
    {
        $userInfo = model('admin')->find(input("post.id"));
        $result = $userInfo ->delete();
        if($result)
        {
            $this->success('管理员删除成功','admin/admin/list');
        }
        else
        {
            $this->error('管理员删除失败');
        }
    }

    //管理员状态
    public function Status()
    {
        $memberInfo = model('admin')->find(input('post.id'));
        $memberInfo->status = input('post.status') ? 0 : 1;
        $result = $memberInfo->save();
        if ($result) {
            $this->success('操作成功！', 'admin/admin/list');
        }else {
            $this->error('操作失败！');
        }
    }
}
