<?php

namespace app\index\controller;

class article extends Base
{
    //文章详情
    public function info()
    {
        $articleInfo = model('Article')->with('comment,comment.user')->find(input('id' ));

        $this->assign('articleInfo',$articleInfo);
        return view();
    }
}
