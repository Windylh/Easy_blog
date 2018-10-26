<?php

namespace app\index\controller;

use think\facade\Request;

class article extends Base
{
    //文章详情
    public function info()
    {
        $articleInfo = model('Article')->with('comment,comment.user')->find(input('id' ));

        $this->assign('articleInfo',$articleInfo);
        return view();
    }

    public function comment()
    {
        if(session('index.id'))
        {
            $this->error('请先登录','index/index/login');
        }
        if(request()->isAjax())
        {
            $data = Request::only(['userid','articleid','content']);
            $result = model('comment')->comment($data);
            if($result == 1)
            {
                $this->success('评论成功');
            }
            else
            {
                $this->error($result);
            }
        }
    }

    public function submit()
    {
        if(session('index.id')== NULL)
        {
            $this->error('请先登录','index/index/login');
        }
        if(request()->isAJax())
        {
            $data=Request::only(['title', 'author', 'tags','cateid','desc','content']);

            $result = model('article')->add($data);
            if($result == 1)
            {
                $this->success('文章添加成功', 'index/index/index');
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

    public function edit()
    {
        if(session('index.id')== NULL)
        {
            $this->error('请先登录','index/index/login');
        }
        if(request()->isAjax())
        {
            $data=Request::only(['id','title', 'author', 'tags','cateid','desc','content']);
            $result = model('article') ->edit($data);
            if($result == 1)
            {
                $this->success('文章修改成功', 'index/index/index');
            }
            else
            {
                $this->error($result);
            }
        }
        $articleInfo = model('article')->find(input('id'));
        if($articleInfo['author'] != session('index.username'))
        {
            $this->error('您没有权限修改此文章');
        }
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
        if(session('index.id')== NULL)
        {
            $this->error('请先登录','index/index/login');
        }
        $articleInfo = model('Article')->with('comment')->find(input("post.id"));
        if($articleInfo['author'] != session('index.username'))
        {
            $this->error('您没有权限删除此文章');
        }
        $result = $articleInfo->together('comment') ->delete();
        if($result)
        {
            $this->success('文章删除成功','index/index/index');
        }
        else
        {
            $this->error('文章删除失败');
        }
    }
}
