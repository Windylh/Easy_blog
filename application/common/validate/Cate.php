<?php
/**
 * Created by PhpStorm.
 * User: windylh
 * Date: 2018/10/25
 * Time: 8:34 AM

 **/
namespace app\common\validate;

use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename|栏目名称' => 'require|unique:cate'
    ];

    public function sceneAdd()
    {
        return $this->only(['catename']);
    }

    public function sceneEdit()
    {
        return $this->only(['catename']);
    }
}