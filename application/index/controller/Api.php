<?php
 namespace app\index\controller;
use think\Controller; 
use think\Db;

class Api extends Controller
{
    //登陆
    public function login(){ 
        header('Access-Control-Allow-Origin:*');
        $name=input('name');
        $password=md5(input('password')); 
        $result=Db::name('user')
        ->where('name',$name)
        ->where('password', $password)
        ->find();
       
     
     
       if($result){
            return json([
                'code'=> '1',
                'msg' => '登陆成功!',
                'data'=>$result
            ]);
        }else{
            return json([
                'code' => '0',
                'msg' => '用户名或者密码错误！'
            ]);
        }
    }
    
    //注册
    public function register(){
        header('Access-Control-Allow-Origin:*');
        header('content-type:application:json;charset=utf8');
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:POST');
        header('Access-Control-Allow-Headers:x-requested-with,content-type');
        $name=Db::name('user')
        ->where('name',input('name'))
        ->find();

        $data=[
            'name'=>input('name'),
            'password'=>md5(input('password')),
            'token'=>md5(uniqid(md5(microtime(true)), true)),
            'moneny'=>2000
        ];
        
        if($name){
            return json([
                'code' => '0',
                'msg' => '用户名已经存在!'
            ]);
        }else{
            Db::name('user')->insert($data);
            return json([
                'code' => '1',
                'msg' => '注册成功!',
                'data'=>$data
            ]);
           
        }
    }
    //添加地址
    public function address(){
        header('Access-Control-Allow-Origin:*');
        $address=Db::name('user_address')
        ->where('token',input('token'))
        ->find();

        $data=[
            'token'=>input('token'),
            'name'=>input('name'),
            'phone'=>input('phone'),
            'address'=>input('address'),
            'xx_address'=>input('xx_address')
        ];
        
        if(input('name')=='' || input('phone')=='' || input('address')=='' ||input('xx_address')==''){
            return json([
                'code' => '0',
                'msg' => '收货资料不能为空'
            ]);
        }else {
            Db::name('user_address')->insert($data);
            return json([
                'code' => '1',
                'msg' => '添加成功!',
                'data'=>$data
            ]);
        }
    }
    //查看地址
    public function user_address(){
        header('Access-Control-Allow-Origin:*');
        $address=Db::name('user_address')
        ->where('token',input('token'))
        ->select();
        
        if($address){
            return json([
                'code' => '1',
                'msg' => '读取成功',
                'data'=>$address
            ]);
        }else {
            return json([
                'code' => '0',
                'msg' => '读取失败',
            ]);
        }
    }

    //修改地址
    public function up_address(){
        header('Access-Control-Allow-Origin:*');
        $address=Db::name('user_address')
        ->where('id',input('id'))
        ->where('token',input('token'))
        ->update([
            'name'=>input('name'),
            'phone'=>input('phone'),
            'address'=>input('address'),
            'xx_address'=>input('xx_address')
        ]);
        return json([
            'code' => '1',
            'msg' => '修改成功'
        ]);
    }
    //删除地址
    public function del_address(){
        header('Access-Control-Allow-Origin:*');
        $address=Db::name('user_address')
        ->where('id',input('id'))
        ->where('token',input('token'))
        ->delete();
       if($address){
        return json([
            'code' => '1',
            'msg' => '删除成功'
        ]);
       }else{
        return json([
            'code' => '0',
            'msg' => '删除失败'
        ]);
       }
    }

    //上传头像
    public function upload()
    {
        header('Access-Control-Allow-Origin:*');
        
        $config = [
            'size' => 2097152,
            'ext'  => 'jpg,gif,png,bmp,txt'
        ];
       
       
        // if($update_user_img){
        //     return json([
        //         'error' => 1,
        //         'dara'   => $update_user_img
        //     ]);
        // }
        
       

        $file = request()->file('sp_image');
        $url=ROOT_PATH . 'public' . DS . 'static' . DS . 'image';

        if($file){
            // 移动到框架应用根目录/public/uploads/image 目录下
            $info=$file->rule('uniqid')->move($url);
            if($info){
                // Db::name('news')->insert(['img' =>  $info->getSaveName()]);
                return json([
                    'error' => 1,
                    'url'   => $info
                ]);
            }else{
                return json([
                    'error' => 0,
                    'url'   => '上传失败'
                ]);
            }
        }

    }

    //加入购物车
    public function add_cart(){
        header('Access-Control-Allow-Origin:*');
        $add_cart=Db::name('user_cart')
        ->where('token',input('token'))
        ->find();

        $data=[
            'id'=>input('id'),
            'token'=>input('token'),
            'title'=>input('title'),
            'price'=>input('price'),
            'shop_img'=>input('shop_img'),
            'sum'=>input('sum')
        ];

        $user_id_data=Db::name('user_cart')
        ->where('token',input('token'))
        ->where('id',input('id'))
        ->select();

        $add_cart_value=Db::name('user_cart')
        ->where('id',input('id'))
        ->where('token',input('token'))
        ->setInc('sum',1);

        // dump($add_cart_value);

       if($user_id_data){
            return json([
                'code' => '1',
                'msg' => '添加成功',
                'data'=>$add_cart_value
            ]);
       }else if($data){
            Db::name('user_cart')->insert($data);
            return json([
                'code' => '1',
                'msg' => '添加成功',
                'data'=>$data
            ]);
       }else{
            return json([
                'code' => '0',
                'msg' => '添加失败'
            ]);
       }
    }

    //购物车信息
    public function user_cart(){
        header('Access-Control-Allow-Origin:*');
        $add_cart=Db::name('user_cart')
        ->where('token',input('token'))
        ->select();


        if($add_cart){
            return json([
                'code' => '1',
                'msg' => '读取成功',
                'data'=>$add_cart
            ]);
        }else{
            return json([
                'code' => '0',
                'msg' => '读取失败',
                'data'=>$add_cart
            ]);
        }
    }

    //提交订单
    public function add_order(){
        header('Access-Control-Allow-Origin:*');

        $user_moneny=Db::name('user')->where('token',input('token'))->value('moneny');
        $price=Db::name('shop')->where('id',input('id'))->value('price');
       

        //取随机数
        // $arr = array_merge(range(0,9));
        // $str = '';
        // $arr_len = count($arr);
        // for($i = 0;$i < 5;$i++){
        //     $rand = mt_rand(0,$arr_len-1);
        //     $str.=$arr[$rand];
        // }
       
        $data=[
            'token'=>input('token'), //token
            'shop_id'=>input('id'), //模拟商品id
            'shop_name'=>input('shop_name'), //商品名字
            'shop_price'=>input('shop_price'), //商品价格
            'address_name'=>input('address_name'), //收货人
            'address_phone'=>input('address_phone'), //收货手机号码
            'address'=>input('address'), //总地址
            'content'=>input('content'), //留言
            'invoice'=>input('invoice'), //发票抬头
            'integral'=>input('integral'), //积分
            'shop_img'=>input('shop_img'),
            'number'=>date('Ymd') . str_pad(mt_rand(1, 99999), 6, '1', STR_PAD_LEFT)
        ];

        if(input('invoice')==''){
            return json([
                'code' => '1',
                'msg' => '请输入发票抬头',
            ]);
        }
      
        if($price>$user_moneny){
            return json([
                'code' => '1',
                'msg' => '对不起，您的余额不足',
            ]);
        }else{
            Db::name('user')->where('token',input('token'))->update([
                'moneny'=>$user_moneny-$price
            ]);
            Db::name('user_order')->insert($data);
            return json([
                'code' => '1',
                'msg' => '购买成功!',
                'data'=>$data
            ]);
        }
    }
    //个人订单
    public function user_order(){
        header('Access-Control-Allow-Origin:*');
        $user_id=Db::name('user_order')->where('token',input('token'))->select();
        if($user_id){
            return json([
                'code'=>'1',
                'msg'=>'读取成功',
                'order'=>$user_id
            ]);
        }else{
            return json([
                'code'=>'0',
                'msg'=>'没有订单',
            ]);
        }
    }

    public function lm_data(){
        header('Access-Control-Allow-Origin:*');
        return json([
            'code'=>'1',
            'msg'=>'读取成功',
            'data'=>[
                'lm'=>Db::name('phone_lm')->select(),
                'list'=>Db::name('shop')->select()
            ]
        ]);
    }

    public function news_data(){
        header('Access-Control-Allow-Origin:*');
        $data=Db::name('news')->select();
        $user_pl=Db::name('user_pl')
        ->where('id',input('id'))
        ->select();
        if($data){
            return json([
                'code'=>'1',
                'msg'=>'读取成功',
                'data'=>$data,
                'user_pl'=>$user_pl,
            ]);
        }else{
            return json([
                'code'=>'0',
                'msg'=>'读取失败',
                'data'=>[]
            ]);
        }
    }

    public function sc_news(){
     
        header('Access-Control-Allow-Origin:*');

        $result=Db::name('sc_news')
        ->alias("a")->join('news c','c.id=a.sc_id','INNER')
        ->where('sc_id',input('id'))
        ->where('token',input('token'))
        ->select();

        if($result){
            Db::name('sc_news')
            ->where('sc_id',input('id'))
            ->where('token',input('token'))
            ->delete();

            return json([
                'code'=>'0',
                'msg'=>'取消收藏成功',
               
            ]);
           
        }else{  
            $data=Db::name('sc_news')->insert([
                'sc_id'=>input('id'),
                'token'=>input('token'),
            ]);

            return json([
                'code'=>'1',
                'msg'=>'收藏成功'
            ]);
           
           
        }
       

    }

    public function sc_biao(){
        header('Access-Control-Allow-Origin:*');
        header('content-type:application:json;charset=utf8');
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:POST');
        header('Access-Control-Allow-Headers:x-requested-with,content-type');

      
        $result=Db::name('sc_news')
        ->alias("a")->join('news c','c.id=a.sc_id','INNER')
        ->where('token',input('token'))
        ->select();

        if($result){
            return json([
                'code'=>1,
                'msg'=>'读取成功',
                'data'=>$result
            ]);
        }else{
            return json([
                'code'=>0,
                'msg'=>'读取失败',
                'data'=>$result
            ]);
        }
    }

    public function del_sc_biao(){
        header('Access-Control-Allow-Origin:*');
        $result=Db::name('sc_news')
        ->alias("a")->join('news c','c.id=a.sc_id','INNER')
        ->where('sc_id',input('id'))
        ->where('token',input('token'))
        ->select();
        
        if($result){
            Db::name('sc_news')
            ->where('sc_id',input('id'))
            ->where('token',input('token'))
            ->delete();

            return json([
                'code'=>'1',
                'msg'=>'取消成功',
                'data'=>$result
            ]);
        }

        return $result;
    
    }
    
    public function user_pl(){
        header('Access-Control-Allow-Origin:*');
        $data=[
            'name'=>input('name'),
            'token'=>input('token'),
            'text'=>input('text'),
            'id'=>input('id')
        ];

        if(input('text')==''){
            return json([
                'code'=> '0',
                'msg' => '评论内容不能为空!',
                'data'=>[]
            ]);
        }else{
            return json([
                'code'=> '0',
                'msg' => '评论成功!',
                'data'=>Db::name('user_pl')
                ->insert($data)
            ]);
        }
    }
    
    public function user_pl_nr(){
        header('Access-Control-Allow-Origin:*');
        header('content-type:application:json;charset=utf8');
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Methods:POST');
        header('Access-Control-Allow-Headers:x-requested-with,content-type');

      
        $pl_data=Db::name('user_pl')
        ->where('token',input('token'))
        ->select();

        if($pl_data){
            return json([
                'code'=>1,
                'msg'=>'读取成功',
                'data'=>$pl_data
            ]);
        }else{
            return json([
                'code'=>0,
                'msg'=>'读取失败',
                'data'=>$pl_data
            ]);
        }
    }

    

    
    public function shop_data(){
        header('Access-Control-Allow-Origin:*');
        $data=Db::name('shop')->select();
        if($data){
            return json([
                'code'=>'1',
                'msg'=>'读取成功',
                'data'=>$data
            ]);
        }else{
            return json([
                'code'=>'0',
                'msg'=>'读取失败',
                'data'=>[]
            ]);
        }
    }

    //首页banner
    public function home_banner(){
        header('Access-Control-Allow-Origin:*');
        $data=Db::name('banner')->select();
        if($data){
            return json([
                'code'=>'1',
                'msg'=>'读取成功',
                'data'=>$data
            ]);
        }else{
            return json([
                'code'=>'0',
                'msg'=>'读取失败',
                'data'=>[]
            ]);
        }
    }
 

    public function del(){
        $del=Db::name('news')->where('id',input('id'))->delete();
        if($del){
            return json([
                'code'=>1,
                'msg'=>'删除成功'
            ]);
        }else{
            return json([
                'code'=>0,
                'msg'=>'删除失败'
            ]);
        }
    }

    public function del_banner(){
        $del=Db::name('banner')->where('id',input('id'))->delete();
        if($del){
            return json([
                'code'=>1,
                'msg'=>'删除成功'
            ]);
        }else{
            return json([
                'code'=>0,
                'msg'=>'删除失败'
            ]);
        }
    }

    public function is_zt_banner(){
        $data=Db::name('banner')
        ->where('id',input('id'))
        ->value('is_show');

        if($data==1){
            Db::name('banner')->where('id', input('id'))->update([
                'is_show' => 0
            ]);
        }else{
            Db::name('banner')->where('id', input('id'))->update([
                'is_show' => 1
            ]);
        }
    }
    
    public function data(){
        return json([
            'code'=>'1',
            'msg'=>'读取成功',
            'data'=>[
                'news'=>Db::table('news')->select(),
                'liuyan'=>Db::table('zl')->select(),
                'feilei'=>Db::table('classify')->select(),
            ]
        ]);
    }

    public function uplm(){
        $uplm=Db::name('classify')->where('fl_id',input('id')) ->update([
            'fl_id'=>input('id'),
            'fl_title'=>input('fl_title')
        ]);
        if($uplm){
            return json([
                'code'=>'1',
                'msg'=>'修改成功',
                'data'=>$uplm
            ]);
        }else{
            return json([
                'code'=>'0',
                'msg'=>'修改失败',
                'data'=>null
            ]);
        }
       
    }

    //推荐
    public function tuijian(){
        $data=Db::name('news')->where('id',input('id'))->value('is_detail');
            if($data==1){
                Db::name('news')->where('id', input('id'))->update([
                    'is_detail' => 0
                ]);
            }else{
                Db::name('news')->where('id', input('id'))->update([
                    'is_detail' => 1
                ]);
            }
       
    }


    //显示
    public function xianshi(){
        $data=Db::name('news')->where('id',input('id'))->value('is_show');
            if($data==1){
                Db::name('news')->where('id', input('id'))->update([
                    'is_show' => 0
                ]);
            }else{
                Db::name('news')->where('id', input('id'))->update([
                    'is_show' => 1
                ]);
            }
       
    }

    public function shop_xianshi(){
        $data=Db::name('shop')->where('id',input('id'))->value('is_show');
            if($data==1){
                Db::name('shop')->where('id', input('id'))->update([
                    'is_show' => 0
                ]);
            }else{
                Db::name('shop')->where('id', input('id'))->update([
                    'is_show' => 1
                ]);
            }
       
    }

      //是否上架
    public function shop_shangjia(){
        $data=Db::name('shop')->where('id',input('id'))->value('is_sj');
        if($data==1){
            Db::name('shop')->where('id', input('id'))->update([
                'is_sj' => 0
            ]);
        }else{
            Db::name('shop')->where('id', input('id'))->update([
                'is_sj' => 1
            ]);
        }
    }

     //后台订单删除
     public function order_del(){
        $order_data=Db::name('user_order')->where('number',input('number'))->delete();
        if($order_data){
            return json([
                'code'=>'1',
                'msg'=>'删除成功'
            ]);
        }else{
            return json([
                'code'=>'0',
                'msg'=>'删除失败',
            ]);
        }

    }

    

   
}