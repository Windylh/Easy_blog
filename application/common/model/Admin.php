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
            return 1;
        }
        else
            return '用户名或密码错误';
    }
}
