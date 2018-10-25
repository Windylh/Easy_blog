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
        'username|用户名' => 'require',
        'password|密码' => 'require',
        'conpass|确认密码' => 'require|confirm:password',
        'email|邮箱' => 'require|email|unique:admin'
    ];

    public function sceneAdd()
    {
        return $this->only(['username','password','conpass','email']);
    }
    public function sceneEdit()
    {
        return $this->only(['username','password','conpass','email']);
    }
}