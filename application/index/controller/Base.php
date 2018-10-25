<?php

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    //共享视图
    public function initialize()
    {
        $cates = model('cate')->select();
        $viewData=[
          'cates'=>$cates
        ];
        $this->view->share($viewData);
    }
}
