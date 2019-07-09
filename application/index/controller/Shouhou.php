<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Shouhou extends Controller
{
    public function shouhou(){
        $lm=Db::table('classify')->order('fl_id', 'asc')->select();
        $this->assign('lm',$lm);

        $fwk_list=Db::name("service")->select();
        $this->assign('list',$fwk_list);
        $id=Db::name('service')->where('id',1)->select();
        if($id){
                if(input('article_de')==''){
    
                }else{
                    Db::name('service')->where('id',1) ->update([
                        'content'=>input("article_de")
                    ]);
                    echo"<script>alert('信息提交成1功！'); history.go(-1)</script>";
                }
            }else{
                if(input('article_de')==''){
    
                }else{
                    Db::name('service')->insert([
                        'content'=>input("article_de")
                    ]);
                    echo"<script>alert('信息修改成功！'); history.go(-1)</script>";
                }
              
            }
      
        return $this->fetch('shouhou/shouhou'); //试图层
    }
}