<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
{
    use SoftDelete;

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
}
