<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Article extends Model
{
    use SoftDelete;
    //关联comment
    public function comment()
    {
        return $this->hasMany('comment','articleid','id');
    }
    //关联cate
    public function cate()
    {
        return $this->belongsTo('cate','cateid','id');
    }

    //add
    public function add($data)
    {
        $validate = new \app\common\validate\Article();
        if(!$validate->scene('add')->check($data))
        {
            return $validate->getError();
        }
        $result=$this->allowField(true)->save($data);
        if($result)
        {
            return 1;
        }
        else
        {
            return '文章添加失败';
        }
    }

    //edit
    public function edit($data)
    {
        $validate = new \app\common\validate\Article();
        if(!$validate ->scene('edit') ->check($data))
        {
            return $validate->getError();
        }
        $articleInfo =$this ->find($data['id']);
        $articleInfo ->title = $data['title'];
        $articleInfo ->tags = $data['tags'];
        $articleInfo ->cateid = $data['cateid'];
        $articleInfo ->desc = $data['desc'];
        $articleInfo ->content = $data['content'];
        $result = $articleInfo -> save();
        if($result)
        {
            return 1;
        }
        else
        {
            return "文章修改失败";
        }
    }
}
