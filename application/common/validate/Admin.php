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
        'username|用户名' => 'require|unique:user|unique:admin|length:6,16',
        'password|密码' => 'require|length:6,16',
        'conpass|确认密码' => 'require|confirm:password|length:6,16',
        'email|邮箱' => 'require|email|unique:admin|length:6,32'
    ];

    //登陆
    public function sceneLogin()
    {
        return $this->only(['username','password'])->remove('username','unique');
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