<?php

namespace app\admin\controller;

use think\facade\Request;

class Article extends Base
{
    //列表
    public function list()
    {
        $articles = model('article')->with('cate')->order(['create_time'=>'desc']) -> paginate(10);
        $this->assign('articles', $articles);
        return view();
    }
    //添加
    public function add()
    {
        if(request()->isAJax())
        {
            $data=Request::only(['title', 'author', 'tags','cateid','desc','content']);

            $result = model('article')->add($data);
            if($result == 1)
            {
                $this->success('文章添加成功', 'admin/article/list');
            }
            else
            {
                $this->error($result);
            }
        }
        $cates = model('Cate') ->select();
        $this->assign('cates', $cates);
        return view();
    }
    //编辑
    public function edit()
    {
        if(request()->isAjax())
        {
            $data=Request::only(['id','title', 'author', 'tags','cateid','desc','content']);
            $result = model('article') ->edit($data);
            if($result == 1)
            {
                $this->success('文章修改成功', 'admin/article/list');
            }
            else
            {
                $this->error($result);
            }
        }
        $articleInfo = model('article')->find(input('id'));
        $cates = model('cate')->select();
        $viewData = [
          'articleInfo' => $articleInfo,
          'cates' => $cates
        ];
        $this->assign($viewData);
        return view();
    }
    //删除
    public function del()
    {
        $articleInfo = model('Article')->find(input("post.id"));
        $result = $articleInfo ->delete();
        if($result)
        {
            $this->success('文章删除成功','admin/article/list');
        }
        else
        {
            $this->error('文章删除失败');
        }
    }
}
