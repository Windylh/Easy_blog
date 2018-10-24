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
        'username' => 'require',
        'password' => 'require'
    ];

    //登陆
    public function sceneLogin()
    {
        return $this->only(['username','password']);
    }
}