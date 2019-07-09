<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Common extends Controller
{

    public function common(){
        // $lm=Db::table('classify')->order('fl_id', 'asc')->select();
        // $this->assign('lm',$lm);

        $lm=Db::table('classify')->select();
        $this->assign('lm',$lm);
        return $this->fetch('common/common'); //试图层
    }
}