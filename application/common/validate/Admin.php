<?php
/**
 * Created by PhpStorm.
 * User: windylh
 * Date: 2018/10/24
 * Time: 10:57 AM
 */

namespace app\common\validate;


use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username|用户名' => 'require',
        'password|密码' => 'require',
        'conpass|确认密码' => 'require|confirm:password',
        'email|邮箱' => 'require|email|unique:admin'
    ];

    //登陆
    public function sceneLogin()
    {
        return $this->only(['username','password']);
    }

    public function sceneAdd()
    {
        return $this->only(['username','password','conpass','email']);
    }
    public function sceneEdit()
    {
        return $this->only(['username','password','conpass','email']);
    }
}