<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Contact extends Controller{
     // 联系我们
     public function contact(){
        $id=Db::name('contact')->where('id',8)->select();
        if($id){
            if(input('article_de')==''){

            }else{
                Db::name('contact')->where('id',8) ->update([
                    'content'=>input('article_de'),
                ]);
            }
            
        }else{
            if(input('content')==''){

            }else{
                Db::name('article_de')->insert([
                    'content'=>input('article_de')
                ]);
            }
        }
        return $this->fetch('contact/contact'); //试图层
    }

}