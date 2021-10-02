<?php
$pass = $_GET['pass'];
//echo $pass.'<br>';
//echo md5($pass).'<br>';
//echo md5(md5($pass)).'<br>';
echo sha1(md5(md5($pass))).'<br>';
?>