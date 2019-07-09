<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Shop extends Controller
{

    public function phone(){
        $data=Db::name('shop')->alias("a")
        ->join('phone_lm c','c.lm_id=a.lm_id','INNER')->select();
        $this->assign('data',$data);

        return $this->fetch('shop/phone');
    }

    public function addPhone(){
        $data=Db::name('shop')->alias("a")
        ->join('phone_lm c','c.lm_id=a.lm_id','INNER')->select();
        $this->assign('data',$data);

        $data=[
            'name'=>input('name'),
            'jieshao'=>input('jieshao'),
            'price'=>input('price'),
            'time'=>input('time'),
            'content'=>input('article_de'),
            'sy_zs'=>input('syzs'),
            'is_show'=>1,
            'is_sy'=>0,
            'lm_id'=>0
        ];


       
        $file = request()->file('image');
        // dump($file);
        if($file){
            // 移动到框架应用根目录/public/uploads/image 目录下
            $info=$file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'image');
          
            if($info){
                $data['fm_img']=$info->getFilename();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        if(input('name')==''||input('jieshao')==''||input('time')==''){
        }else{
            Db::name('shop')->insert($data);
            echo "<script>window.location.href='/phone/';</script>";
        }
        return $this->fetch('shop/addPhone'); //试图层
    }
    public function upPhone(){

        $fwk_data=Db::name('shop')->alias("a")
        ->join('phone_lm c','c.lm_id=a.lm_id','INNER')->where('id',input('id'))->select();
        $this->assign('fwk_data',$fwk_data);


        // $fwk_data=Db::name('shop')->select();
        // if(!is_null($fwk_data)){
        //     $this->assign('fwk_data',$fwk_data);
        // }

        $data=[
            'name'=>input('name'),
            'jieshao'=>input('jieshao'),
            'price'=>input('price'),
            'time'=>input('time'),
            'content'=>input('article_de'),
            'sy_zs'=>input('syzs')
        ];
        $file = request()->file('image');
        if($file){
            // 移动到框架应用根目录/public/uploads/image 目录下
            $info=$file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'image');
            if($info){
                $data['fm_img']=$info->getFilename();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        if(input('name')==''||input('jieshao')==''||input('price')==''){
        }else{
            Db::name('shop')->where('id',input('id')) ->update($data);
            echo "<script>window.location.href='/phone/';</script>";
            
        }
      
        return $this->fetch('shop/upPhone'); //试图层
    }
    public function phoneLm(){
        $data=Db::name('phone_lm')->select();
        $this->assign('data',$data);

        return $this->fetch('shop/phoneLm');
    }

    public function addPhoneFl(){
        $data=[
            'lm_name'=>input('name'),
            'time'=>input('time')
        ];
        if(input('name')==''||input('time')==''){
            
        }else{
            Db::name('phone_lm')->insert($data);
            echo "<script>window.location.href='/phoneLm/';</script>";
        }
        
        return $this->fetch('shop/addPhoneFl');
    }
}