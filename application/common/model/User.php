<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
{
    use SoftDelete;

    //关联评论
    public function comment()
    {
        return $this->hasMany('comment','userid','id');
    }
    public function add($data)
    {
        $validate = new \app\common\validate\User();
        if(!$validate->scene('add')->check($data))
        {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if($result)
        {
            return 1;
        }
        else
        {
            return '用户添加失败';
        }
    }
    public function edit($data)
    {
        $validate = new \app\common\validate\User();
        if(!$validate->scene('edit')->check($data))
        {
            return $validate->getError();
        }
        $userInfo = $this ->find($data['id']);
        $userInfo -> username = $data['username'];
        $userInfo -> password = $data['password'];
        $userInfo -> email = $data['email'];
        $result = $userInfo ->save();
        if($result)
        {
            return 1;
        }
        else
        {
            return '用户编辑失败';
        }
    }
    public function register($data)
    {
        $validate = new \app\common\validate\User();
        if(!$validate->scene('register')->check($data))
        {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if($result)
        {
            return 1;
        }
        else
        {
            return '用户添加失败';
        }
    }
    public function login($data)
    {
        $validate = new \app\common\validate\User();
        if(!$validate->scene('login')->check($data))
        {
            return $validate->getError();
        }
        #unset($data['verify']);
        $result = $this->where($data)->find();
        if($result)
        {
            //判断是否禁用
            if($result['status'] != 1)
                return '账户已被禁用';
            $Session=[
                'id'=>$result['id'],
                'username'=>$result['username']
            ];
            session('index',$Session);
            return 1;
        }
        else
        {
            return "用户名或密码错误";
        }

    }
}
