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
}
