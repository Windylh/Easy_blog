<?php
/**
 * Created by PhpStorm.
 * User: windylh
 * Date: 2018/10/26
 * Time: 1:22 AM
 */

namespace app\common\validate;

use think\Validate;


class Comment extends Validate
{
    protected $rule = [
      'userid' => 'require',
      'articleid' => 'require',
      'content|评论内容' => 'require'
    ];

    public function sceneComment()
    {
        return $this->only(['userid','articleid','content']);
    }
}