<?php
header("Content-type: text/html; charset=utf-8");
//error_reporting(0);
//curl
/**
*实现功能支持发送微博，发送微博带图。
*不念制作，各位网友可随意分发，修改，重置。
*http://www.bunian.cn/
*
*/
function curl($url,$post=0,$header=0,$cookie=0,$referer=0,$ua=0,$nobaody=0){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		$httpheader[] = "Accept:*/*";
		$httpheader[] = "Accept-Encoding:gzip,deflate,sdch";
		$httpheader[] = "Accept-Language:zh-CN,zh;q=0.8";
		$httpheader[] = "Connection:close";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
		if($post){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}
		if($header){
			curl_setopt($ch, CURLOPT_HEADER, TRUE);
		}
		if($cookie){
			curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		}
		if($referer){
			curl_setopt($ch, CURLOPT_REFERER, $referer);
		}
		if($ua){
			curl_setopt($ch, CURLOPT_USERAGENT,$ua);
		}else{
			curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.167 Safari/537.36');
		}
		if($nobaody){
			curl_setopt($ch, CURLOPT_NOBODY,1);
		}
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$ret = curl_exec($ch);
		curl_close($ch);
		return $ret;
	}

$about=['伤感','孤独','失恋','伤心','搞笑'];
$pn=mt_rand(0,4);
$text=curl('http://api.bunian.cn/yulu/?fun=wb&about='.$about[$pn]);
$pic_id='';
$post=[
'title' =>'今日要说什么？',
'location' => 'v6_content_home',
'text' => $text,//需要发送微博的内容
'pic_id' => $pic_id,//微博图片id，需事先上传好
'isReEdit' => false,
'pub_source' => 'page_2',
'topic_id' => '1022%3A',
'pub_type' => 'dialog',
'_t' => 0,
'style_type' => 1,
];
$url='https://weibo.com/aj/mblog/add?ajwvr=6&__rnd=2918942797035';//不需要改变
$referer='https://weibo.com/u/5458778095/home?topnav=1&wvr=6';//可改可不改
$cookie='';//微博 Cookies
curl($url,$post,'',$cookie,$referer);
echo true;
