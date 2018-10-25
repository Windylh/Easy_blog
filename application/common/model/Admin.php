<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    //软删除
    use SoftDelete;

    //登陆验证
    public function login($data)
    {
        $validate = new \app\common\validate\Admin();
        if(!$validate->scene('login')->check($data))
        {
            return $validate->getError();
        }
        $result = $this->where($data)->find();

        if($result)
        {
            //判断是否禁用
            if($result['status'] != 1)
                return '账户已被禁用';
            $Session = [
                'id' => $result['id'],
                'username' => $result['username'],
                'super' => $result['super']
            ];

            session('admin',$Session);
            return 1;
        }
        else
            return '用户名或密码错误';
    }


    public function edit($data)
    {
        $validate = new \app\common\validate\Admin();
        if(!$validate -> scene('edit')->check($data))
        {
            return $validate->getError();
        }
        $adminInfo = $this ->find($data['id']);
        $adminInfo -> username = $data['username'];
        $adminInfo -> password = $data['password'];
        $adminInfo -> email = $data['email'];
        $result = $adminInfo ->save();
        if($result)
        {
            return 1;
        }
        else
        {
            return "修改失败";
        }
    }

    public function add($data)
    {
        $validate = new \app\common\validate\Admin();
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
}
