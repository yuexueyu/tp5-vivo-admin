<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class User extends Controller
{

    public function user(){
        $news_data=Db::name('user')->paginate(9);
        $this->assign('list',$news_data);
        return $this->fetch('user/user'); //试图层
    }


    public function order(){
        $news_data=Db::name('user_order')->select();
        $this->assign('list',$news_data);
        return $this->fetch('user/order'); //试图层
    }

    public function pinglun(){
        $news_data=Db::name('user_pl')->paginate(9);
        $this->assign('list',$news_data);
      
       
        return $this->fetch('user/pinglun'); //试图层
    }

    public function dizhi(){
        $news_data=Db::name('user_pl')->paginate(9);
        $this->assign('list',$news_data);
        return $this->fetch('user/dizhi'); //试图层
    }
    public function addUser(){
        return $this->fetch('user/addUser'); //试图层
    }
}