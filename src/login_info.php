<?php
include(".Config.php");
function login_info(){
	global $ROOT_DIR;
	$html = <<<EOF
<style>
	.login_info {
		font-size: 5vw;
		text-align: center;
	}
</style>
EOF;
	echo $html;
	$gohome = '<a class="login_info" href='.$ROOT_DIR.'>主页</a>';
	$goWrite = '<a class="login_info" href='.$ROOT_DIR.'Write.php>录入</a>';
	if (!empty ( $_SESSION ['user'] )){
		$re = $_SESSION['user'].'<br><a class="login_info" href=logout.php?req_url='.$_SERVER ['REQUEST_URI'].'>登出</a>';
		switch ($_SERVER ['REQUEST_URI']){
			case $ROOT_DIR: //主页
				return $re.'&nbsp;&nbsp;&nbsp;&nbsp;'.$goWrite;
			case $ROOT_DIR.'Write.php': //录入
				return $re.'&nbsp;&nbsp;&nbsp;&nbsp;'.$gohome;
			default:
				return $re.'&nbsp;&nbsp;&nbsp;&nbsp;'.$gohome.'&nbsp;&nbsp;&nbsp;&nbsp;'.$goWrite;
		}
	}else{
		$re = '<a class="login_info" href=login.php?req_url='.$_SERVER ['REQUEST_URI'].'>登录</a>';
		switch ($_SERVER ['REQUEST_URI']){
			case $ROOT_DIR:
				return $re;
			default:
				return $re.'&nbsp;&nbsp;&nbsp;&nbsp;'.$gohome;
		}
	}
}
?>