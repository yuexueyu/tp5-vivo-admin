<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Banner extends Controller{
   
     public function banner(){
        $this->assign('b_data',Db::name('banner')->select());
        $data=[
            'is_show'=>1
        ];

        $file = request()->file('image');
        
        if($file){
            // 移动到框架应用根目录/uploads/ 目录下
            $info=$file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'image');
            if($info){
                $data['img']=$info->getFilename();
                
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        if($file){
            Db::name('banner')->insert($data);
            echo "<script>;window.location.href='/banner/';;</script>";
        }else{
           
        }

       
        return $this->fetch('banner/banner'); //试图层
    }
}