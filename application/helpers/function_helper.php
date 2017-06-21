<?php

define('__URL__','/xinwendianping/');
define('__ROOT__',dirname(dirname(dirname(__FILE__))));


function showmsg($url,$string='',$type=1,$time=3000){
    include('/assec/public/show/tips.html');
    exit();
}

function ImageUpload($image,$url,$name=''){

    if($name){
        $imagename = $name;
    }else{
        $imagename = date('ymdhis').rand(0,999);
    }

    $type = strtolower(substr($image['name'],strrpos($image['name'],'.')+1));
    $allow_type = array('jpg','jpeg','gif','png');
    if(!in_array($type, $allow_type)){
        showmsg($_SERVER['HTTP_REFERER'],'图片格式错误！');
    }

    if($image['size']/1000>2000){
        showmsg($_SERVER['HTTP_REFERER'],'图片过大！');
    }

    $imageurl = __ROOT__.'/upload/'.$url.'/'.$imagename.'.'.$type;

    mkdirs( __ROOT__.'/upload/'.$url);
    if(move_uploaded_file($image['tmp_name'],$imageurl)){
        return '/upload/'.$url.'/'.$imagename.'.'.$type;
    }else{
        showmsg($_SERVER['HTTP_REFERER'],'上传失败！');
    }

}

function Uploadbase($data,$url,$name=''){


    if($name){
        $imagename = $name;
    }else{
        $imagename = date('ymdhis').rand(0,999);
    }

    $imageurl = __ROOT__.'/upload/'.$url.'/'.$imagename.'.jpg';

    mkdirs( __ROOT__.'/upload/'.$url);

    $img = explode(',',$data);
    $a = file_put_contents($imageurl, base64_decode($img[1]));//返回的是字节数

    if($a){
        return '/upload/'.$url.'/'.$imagename.'.jpg';
    }else{
        return $a;
    }

}


//创建文件夹
function mkdirs($dir, $mode = 0777)
{
    if (is_dir($dir)) return TRUE;
    @mkdir($dir, $mode);
    if (!mkdirs(dirname($dir), $mode)) return FALSE;
    return @mkdir($dir, $mode);
}

/*************************** 判断函数 ***********************************/

//判断是否为空
function em($data){
    if(is_array($data)){
        if(count($data)>0){
            return $data;
        }else{
            return false;
        }
    }else{
        if(!$data){
            return false;
        }else{
            return $data;
        }
    }
}

//换行符替换
function th($data){
    $data = str_replace("\n\r", "", $data);
    $data = str_replace("\r", "", $data);
    $data = str_replace("\n", "", $data);

    return $data;
}

//根据逗号判断数组
function check_strarr($arr){

    $arr1 = str_replace('，',',',$arr);

    return explode(',',$arr1);
}

//分页函数
function fenye($page,$pagesize=20,$count,$url){

    $countpage = ceil($count/$pagesize);

    $pageinfo = '<div class="pagelist"> ';


    if($page==1){
        $pageinfo .= '<a href="javascript://">上一页</a>';
    }else{
        $pageinfo .= '<a href="'.$url.'&page=1">首页</a>';
        $pageinfo .= '<a href="'.$url.'&page='.($page-1).'">上一页</a>';
    }

    for($i = -2;$i<3;$i++){
        if(($i+$page)>0&&$i!=0&&($i+$page)<=$countpage){
            $pageinfo .= '<a href="'.$url.'&page='.($i+$page).'">'.($i+$page).'</a>';
        }else if($i==0){
            $pageinfo .= '<span class="current">'.$page.'</span>';
        }
    }

    if($page==$countpage){
        $pageinfo .= '<a href="javascript://">下一页</a>';
    }else{
        $pageinfo .= '<a href="'.$url.'&page='.($page+1).'">下一页</a>';
        $pageinfo .= '<a href="'.$url.'&page='.$countpage.'">尾页</a>';
    }

    $pageinfo .= '</div>';

    return $pageinfo;

}

//前端分页函数
function  qfenye($page,$pagesize=10,$count,$url){

    $countpage = ceil($count/$pagesize);

    $pageinfo = '<div class="msgbottomr"><div class="dis_in"> ';


    if($page==1){
        $pageinfo .= '<a class="btn_add btn_sure left" href="javascript://">上一页</a>';
    }else{
        $pageinfo .= '<a href="'.$url.'/1" class="btn_add btn_sure left">首页</a>';
        $pageinfo .= '<a href="'.$url.'/'.($page-1).'" class="btn_add btn_sure left">上一页</a>';
    }

    for($i = -2;$i<3;$i++){
        if(($i+$page)>0&&$i!=0&&($i+$page)<=$countpage){
            $pageinfo .= '<a href="'.$url.'/'.($i+$page).'" class="match btn_sure left ">'.($i+$page).'</a>';
        }else if($i==0){
            $pageinfo .= '<a href="javascript://" class="match btn_sure left act">'.$page.'</a>';
        }
    }

    if($page==$countpage){
        $pageinfo .= '<a href="javascript://" class="btn_add btn_sure left ">下一页</a>';
    }else{
        $pageinfo .= '<a href="'.$url.'/'.($page+1).'" class="btn_add btn_sure left ">下一页</a>';
        $pageinfo .= '<a href="'.$url.'/'.$countpage.'" class="btn_add btn_sure left">末页</a>';
    }

    $pageinfo .= '</div></div>';

    return $pageinfo;

}

//搜索分页函数
function  sfenye($page,$pagesize=10,$count,$url){

    $countpage = ceil($count/$pagesize);

    $pageinfo = '<div class="msgbottomr"><div class="dis_in"> ';


    if($page==1){
        $pageinfo .= '<a class="btn_add btn_sure left" href="javascript://">上一页</a>';
    }else{
        $pageinfo .= '<a href="'.$url.'&page=1" class="btn_add btn_sure left">首页</a>';
        $pageinfo .= '<a href="'.$url.'&page='.($page-1).'" class="btn_add btn_sure left">上一页</a>';
    }

    for($i = -2;$i<3;$i++){
        if(($i+$page)>0&&$i!=0&&($i+$page)<=$countpage){
            $pageinfo .= '<a href="'.$url.'&page='.($i+$page).'" class="match btn_sure left ">'.($i+$page).'</a>';
        }else if($i==0){
            $pageinfo .= '<a href="javascript://" class="match btn_sure left act">'.$page.'</a>';
        }
    }

    if($page==$countpage){
        $pageinfo .= '<a href="javascript://" class="btn_add btn_sure left ">下一页</a>';
    }else{
        $pageinfo .= '<a href="'.$url.'&page='.($page+1).'" class="btn_add btn_sure left ">下一页</a>';
        $pageinfo .= '<a href="'.$url.'&page='.$countpage.'" class="btn_add btn_sure left">末页</a>';
    }

    $pageinfo .= '</div></div>';

    return $pageinfo;

}

//获取用户ip
function getIP() {
    if (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
    }elseif (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    }elseif (getenv('HTTP_X_FORWARDED')) {
        $ip = getenv('HTTP_X_FORWARDED');
    }elseif (getenv('HTTP_FORWARDED_FOR')) {
        $ip = getenv('HTTP_FORWARDED_FOR');
    }elseif (getenv('HTTP_FORWARDED')) {
        $ip = getenv('HTTP_FORWARDED');
    }else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


?>