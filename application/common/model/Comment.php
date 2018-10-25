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
    public function comment($data)
    {
        $validate = new \app\common\validate\Comment();
        if(!$validate->scene('comment')->check($data))
        {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if($result)
        {
            return 1;
        }
        else
        {
            return "评论失败";
        }
    }
}

