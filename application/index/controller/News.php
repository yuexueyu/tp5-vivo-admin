<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class News extends Controller
{

    public function manage(){
        
        $news_data=Db::name('news')->select();
        $this->assign('list',$news_data);
       
        return $this->fetch('xingwen/manage'); //试图层
    }

    // 添加数据
    public function add(){
       
        $data=[
            'title'=>input('title'),
            'abstract'=>input('abstract'),
            'time'=>input('time'),
            'content'=>input('article_de'),
            'img'=>input('img'),
            'is_show'=>1
        ];


       
        $file = request()->file('image');
        // dump($file);
        // if($file){
        //     // 移动到框架应用根目录/public/uploads/image 目录下
        //     // $info=$file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'image');
        //     $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'image');
        //     // dump($info);
        //     if($info){
        //         $data['img']='public' . DS . 'static' . DS . 'image' . DS . $info->getSaveName();
        //     }else{
        //         // 上传失败获取错误信息
        //         echo $file->getError();
        //     }
        // }

        if(input('title')==''||input('article_de')==''||input('time')==''){
        }else{
            Db::name('news')->insert($data);
            echo "<script>window.location.href='/manage/';;</script>";
        }

        return $this->fetch('xingwen/add'); //试图层
    }


    //修改数据
    public function update(){

        $fwk_data=Db::name('news')->where('id',input('id'))->select();
        if(!is_null($fwk_data)){
            $this->assign('list',$fwk_data);
        }

        // $file = request()->file('img');
        // if($file){
        //     // 移动到框架应用根目录/public/uploads/image 目录下
        //     $info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'image');
        //     if($info){
        //         $data['img']='public' . DS . 'static' . DS . 'image' . DS . $info->getSaveName();
        //     }else{
        //         // 上传失败获取错误信息
        //         echo $file->getError();
        //     }
        // }
        if(input('title')==''){
        }else{
            Db::name('news')->where('id',input('id')) ->update([
                'title'=>input('title'),
                'abstract'=>input('abstract'),
                'time'=>input('time'),
                'content'=>input('nr'),
                'img'=>input('img'), //图片 
                
            ]);
            echo "<script>window.location.href='/manage/';</script>";
            
        }
      
        return $this->fetch('xingwen/update'); //试图层
    }
}