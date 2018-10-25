<?php

namespace app\admin\controller;

class Comment extends Base
{
    //list
    public function list()
    {
        $comments = model('Comment')->with('article,user') ->order('create_time','desc')->paginate(10);
        $this->assign('comments',$comments);
        return view();
    }


    public function del()
    {
        $commentInfo = model('Comment')->find(input('post.id'));
        $result = $commentInfo->delete();
        if($result)
        {
            $this->success('评论删除成功', 'admin/comment/list');
        }
        else
        {
            $this->error('评论删除失败');
        }
    }
}
