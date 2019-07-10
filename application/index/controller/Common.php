<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Common extends Controller
{

    public function common(){
        $lm=Db::name('classify')->select();
        $this->assign('lm',$lm);
        return $this->fetch('common/common'); //试图层
    }
}