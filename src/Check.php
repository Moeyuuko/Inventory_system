<?php
include(".Config.php");

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

function Check($username,$password){
	global $servername, $db_username_Readonly, $db_password_Readonly, $dbname, $conn;
	// Create connection
	$conn = new mysqli($servername, $db_username_Readonly, $db_password_Readonly, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_query($conn, 'set names utf8');

	$password = sha1(md5($password));
	$username = mysqli_real_escape_string($conn,$username);
	$sql = "SELECT *  FROM `Users` WHERE `User` = '" . $username . "' AND `Password` = '" . $password . "'";
	
	$row = db_query_row($sql);
	$conn->close();
	return $row;
}

function login($username,$password,$remember){
	$row = Check($username,$password);
	if($row != FALSE){
		global $ROOT_DIR;
		$_SESSION['user'] = $row["User"]; //SESSION记录用户信息
		$_SESSION['User_ID'] = $row["ID"];
		$_SESSION['User_Tag'] = $row["Tag"];
		if ($remember>0){
			setcookie ( "username", $username, time () + 3600 * 24 * 365 );
			setcookie ( "password", $password, time () + 3600 * 24 * 365 );
		}
		if (isset($_GET['req_url'])){
			header ( "location:" . $_GET['req_url'] );
		} else {
			header ( "location:" . $ROOT_DIR );
		}
	}else{
		if (! empty ( $_COOKIE ['username'] ) || ! empty ( $_COOKIE ['password'] )) 
		{
			setcookie ( "username", null, time () - 3600 * 24 * 365 );
			setcookie ( "password", null, time () - 3600 * 24 * 365 );
		}
		echo "<p style='font-size: 20vw; text-align: left; width:100%;'>Error.</p><br>";
	}
}
?>