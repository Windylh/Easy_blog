<?php

namespace app\admin\controller;

class Cate extends Base
{
    //列表
    public function list()
    {
        $cates = model('Cate')->order('create_time','desc') -> paginate(10);
        $this->assign('cates',$cates);
        return view();
    }
    //新增
    public function add()
    {
        if(request()->isAjax()) {
            $data = [
                'catename' => input('post.catename')
            ];
            $result = model('Cate')->add($data);
            if ($result == 1)
            {
                $this->success('栏目添加成功', 'admin/cate/list');
            }
            else
            {
                $this->error($result);
            }
        }
        return view();
    }
    //修改
    public function edit()
    {
        $cateInfo = model('Cate')->find(input('id'));
        $this->assign('cateInfo', $cateInfo);
        if(request()->isAjax())
        {
            $data =[
                'id' => input('post.id'),
                'catename' => input('post.catename')
            ];
            $result = model('Cate') -> edit($data);
            if($result == 1)
            {
                $this -> success('栏目编辑成功','admin/cate/list');
            }
            else
            {
                $this -> error($result);
            }

        }
        return view();
    }
    //删除
    public function del()
    {
        $cateInfo = model('cate')->with('article')->find(input('post.id'));
        foreach($cateInfo['article'] as $k =>$v)
        {
            $v->together('comment')->delete();
        }
        $result = $cateInfo->together('article')->delete();
        if($result)
        {
            $this->success('栏目删除成功', 'admin/cate/list');
        }
        else
        {
            $this->error('栏目删除失败');
        }
    }
}
