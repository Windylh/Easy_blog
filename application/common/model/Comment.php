<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Comment extends Model
{
    use SoftDelete;
    //关联
    public function article()
    {
        return $this->belongsTo('article','articleid','id');
    }
    public function user()
    {
        return $this->belongsTo('user','userid','id');
    }
}
