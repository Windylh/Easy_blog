<?php
/**
 * Created by PhpStorm.
 * User: windylh
 * Date: 2018/10/25
 * Time: 4:14 PM
 */

namespace app\common\validate;

use think\validate;

class User extends Validate
{
    protected $rule = [
        'username|用户名' => 'require|unique:user|unique:admin',
        'password|密码' => 'require',
        'conpass|确认密码' => 'require|confirm:password',
        'email|邮箱' => 'require|email|unique:user',
        'verify|验证码' => 'require|captcha'
    ];

    public function sceneAdd()
    {
        return $this->only(['username','password','conpass','email']);
    }
    public function sceneEdit()
    {
        return $this->only(['username','password','conpass','email']);
    }
    public function sceneRegister()
    {
        return $this->only(['username','password','conpass','email']);
        #return $this->only(['verify','username','password','conpass','email']);
    }
    public function sceneLogin()
    {
        #return $this->only(['verify','username','password']);
        return $this->only(['username','password'])->remove('username','unique');
    }
}