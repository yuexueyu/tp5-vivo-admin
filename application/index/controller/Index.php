<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Index extends Controller
{

    public function admin(){
        $lm=Db::table('classify')->order('fl_id', 'asc')->select();
        $this->assign('lm',$lm);
        return $this->fetch('home/admin'); //试图层
    }
    public function home(){
        $this->assign([
            'user_length'=>Db::name('user')->count(),
            'user_order'=>Db::name('user_order')->count(),
            'user_pinglun'=>Db::name('user_pl')->count(),
            'shop_length'=>Db::name('shop')->count()
        ]);
        return $this->fetch('index/home'); //试图层
    }
}