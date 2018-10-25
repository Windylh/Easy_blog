<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Cate extends Model
{
    use SoftDelete;
    //关联文章
    public function article()
    {
        return $this->hasMany('article','cateid','id');
    }
    //新增
    public function add($data)
    {
        $validate = new \app\common\validate\Cate();
        if(!$validate -> scene('add') -> check($data))
        {
            return $validate->getError();
        }
        $result = $this ->allowField(true)->save($data);
        if($result)
        {
            return 1;
        }
        else
        {
            return "栏目添加失败";
        }
    }
    //编辑
    public function edit($data)
    {
        $validate = new \app\common\validate\Cate();
        if(!$validate -> scene('edit') ->check($data))
        {
            return $validate ->getError();
        }
        $cateInfo = $this ->find($data['id']);
        $cateInfo ->catename = $data['catename'];
        $result = $cateInfo->save();
        if($result)
        {
            return 1;
        }
        else
        {
            return "栏目编辑失败";
        }
    }
}
