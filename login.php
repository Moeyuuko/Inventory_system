<?php
session_start();
include(".Config.php");
include("src/Check.php");
if (!empty($_POST['remember'])){$remember = 1;}else{$remember = 0;}

if(isset($_POST['button'])){
	login($_POST['username'],$_POST['password'],$remember);
}else{
	if (empty ( $_SESSION ['user'] )){
		if (empty ( $_COOKIE ['username'] ) || empty ( $_COOKIE ['password'] )) {
			$login_info = '<a class="login_info" href="'.$ROOT_DIR.'">主页</a>';
			include ("src/login.html.php");
		}else{
			login($_COOKIE ['username'],$_COOKIE ['password'],1);
		}
	}else{
		$login_info = '<a id="login_info" class="login_info">'.$_SESSION['user'].' 已经登录了<br><a class="login_info" href="logout.php?req_url='.$_SERVER ['REQUEST_URI'].'">登出</a></a>';
		include ("src/login.html.php");
	}
}
?>