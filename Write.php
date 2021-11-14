<?php
session_start();
include(".Config.php");
include("src/login_info.php");

if (empty ( $_SESSION ['user'] )){
	header ( "location:login.php?req_url=" . $_SERVER ['REQUEST_URI'] );
	exit();
}
function db_connection($servername, $db_username, $db_password, $dbname){
	global $conn;
	$conn = new mysqli($servername, $db_username, $db_password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_query($conn, 'set names utf8');
}

function db_query_row($sql){
	global $conn;
	if(!mysqli_query($conn, $sql)){
		die('Error : ' . mysqli_error($conn));
	}
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return $row;
	}else{
		return FALSE;
	}
}

function db_INSERT($sql){
	global $conn;
	if ($conn->query($sql) === TRUE) {
		$result = $conn->query("SELECT LAST_INSERT_ID();");
		$row = $result->fetch_assoc();
		return $row["LAST_INSERT_ID()"];
	} else {
		die ("Error: " . $sql . "<br>" . $conn->error);
	}
}

function db_exec($sql){
	global $conn;
	if ($conn->query($sql) === TRUE) {
		return TRUE;
	} else {
		die ("Error: " . $sql . "<br>" . $conn->error);
	}
}

function db_MAXID(){
	$sql = "SELECT MAX(ID) FROM `device` WHERE 1";
	$row = db_query_row($sql);
	if (empty($row["MAX(ID)"])){
		return 0;
	}else{
		return $row["MAX(ID)"];  //print_r(); 调试输出用
	}
	
}

function createRandomStr($length){
	$str = array_merge(range(0,9),range('a','z'),range('A','Z'));
	shuffle($str);
	$str = implode('',array_slice($str,0,$length));
	return $str;
}

function Give_post($postname){
	global $conn;
	if(!empty ($_POST[$postname])){
		return "'".mysqli_real_escape_string($conn,$_POST[$postname])."'";
	}else{
		return "NULL";
	}
}

class json_deta_c {
	public $SN = "";
}
//==这才刚刚开始===============================//

if(isset($_POST['button'])){
	db_connection($servername, $db_username, $db_password, $dbname);

	$Security = $_POST["Security"]; //安全等级 0公开 1私密 2半公开隐藏NOTE,N1,N2
	if ($Security != 0 xor $Security != 1 xor $Security != 2){
			die("安全级别错误");
	}

	$TAG = Give_post("TAG");
	$TIME = Give_post("TIME");
	$NOTE = Give_post("NOTE");
	$N1 = Give_post("N1");
	$N2 = Give_post("N2");

	//$MAXIDadd1 = db_MAXID() + 1;
	//$SN_ = "m".$MAXIDadd1.createRandomStr(4);
	$SN = "'".createRandomStr(6)."'";
	$User_ID = "'".$_SESSION['User_ID']."'";
	
	$sql = "INSERT INTO `device` (`ID`, `SN`, `TAG`, `TIME`, `User_ID`, `Security`, `NOTE`, `N1`, `N2`) VALUES (NULL, ".$SN.", ".$TAG.", ".$TIME.", ".$User_ID.", ".$Security.", ".$NOTE.", ".$N1.", ".$N2.");";
	$LAST_ID = db_INSERT($sql);
	$SN = $_SESSION['User_Tag'].$LAST_ID.createRandomStr(4);
	$sql = "UPDATE `device` SET `SN` = '".$SN."' WHERE `device`.`ID` = $LAST_ID";
	db_exec($sql);
	$conn->close();
	if($_GET['type']=='json'){  #json输出
		$json_deta->SN = $SN;
		header('content-type:application/json;charset=utf8');
		echo json_encode($json_deta, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
	}else{
		header ( "location:Read.php?key=" . $SN );
	}
}else{
	include('src/Write.html.php');
	
}


	//INSERT INTO `device` (`ID`, `SN`, `TAG`, `TIME`, `NOTE`, `N1`, `N2`) VALUES (NULL, 'SNSNSN', 'TAGTAG', 'TTT', 'NNNN', '1111', '2222');
	//SELECT LAST_INSERT_ID(); LAST_INSERT_ID()
	//UPDATE `device` SET `TAG` = '标签机' WHERE `device`.`ID` = 7
?>