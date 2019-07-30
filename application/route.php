<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


use think\Route;



Route::rule("/", "index/home");
Route::rule("banner", "banner/banner");
Route::rule("user", "user/user");
Route::rule("order", "user/order");
Route::rule("pinglun", "user/pinglun");
Route::rule("dizhi", "user/dizhi");
Route::rule("addUser", "user/addUser");


Route::rule("xinwen", "xinwen/xinwen");
Route::rule("manage", "news/manage");
Route::rule("add", "news/add");
Route::rule("update", "news/update"); //修改

Route::rule("common", "common/common");
Route::rule("xglm", "lanmu/xglm");

Route::rule("phone", "shop/phone");
Route::rule("addPhone", "shop/addPhone");
Route::rule("upPhone", "shop/upPhone");
Route::rule("phoneLm", "shop/phoneLm");
Route::rule("addPhoneFl", "shop/addPhoneFl");





// api
Route::rule("news_data", "index/Api/news_data"); 
Route::rule("sc_news", "index/Api/sc_news");
Route::rule("sc_biao", "index/Api/sc_biao"); 
Route::rule("del_sc_biao", "index/Api/del_sc_biao"); 
Route::rule("user_pl", "index/Api/user_pl"); 
Route::rule("user_pl_nr", "index/Api/user_pl_nr");

Route::rule("address", "index/Api/address"); //地址
Route::rule("user_address", "index/Api/user_address");
Route::rule("up_address", "index/Api/up_address");
Route::rule("del_address", "index/Api/del_address");


Route::rule("add_order", "index/Api/add_order");
Route::rule("user_order", "index/Api/user_order");

Route::rule("add_cart", "index/Api/add_cart");
Route::rule("user_cart", "index/Api/    _cart");


Route::rule("add_news", "index/Api/add_news"); 
Route::rule("shop_data", "index/Api/shop_data"); 
Route::rule("home_banner", "index/Api/home_banner"); 
Route::rule("lm_data", "index/Api/lm_data"); 
Route::rule("del_banner", "index/Api/del_banner"); 
Route::rule("is_zt_banner", "index/Api/is_zt_banner"); 
Route::rule("upload", "index/Api/upload"); 


Route::rule("xianshi", "index/Api/xianshi"); 
Route::rule("shop_xianshi", "index/Api/shop_xianshi"); 
Route::rule("shop_shangjia", "index/Api/shop_shangjia"); 

Route::rule("register", "index/Api/register");
Route::rule("login", "index/Api/login");

Route::rule("order_del", "index/Api/order_del");