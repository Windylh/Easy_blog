<?php
/**
 * Created by PhpStorm.
 * User: windylh
 * Date: 2018/10/25
 * Time: 10:20 AM
 */

namespace app\common\validate;

use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'id'=>'require',
        'title|文章标题' => 'require|unique:article',
        'author' => 'require',
        'tags|标签' => 'require',
        'cateid|所属栏目' => 'require',
        'desc|文章概要' => 'require',
        'content|文章内容' => 'require'
    ];

    //add
    public function sceneAdd()
    {
        return $this->only(['title', 'author', 'tags', 'cateid', 'desc', 'content']);
    }

    //edit
    public function sceneEdit()
    {
        return $this->only(['id','title', 'author', 'tags', 'cateid', 'desc', 'content']);
    }
}