<?php
session_start();
foreach($_GET as $key=>$val) {            // read get request from web
	$SN = $val;
}

include(".Config.php");
include("src/login_info.php");

// Create connection
$conn = new mysqli($servername, $db_username_Readonly, $db_password_Readonly, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
mysqli_query($conn, 'set names utf8');

if(strlen($SN)<=12){
	$SN = mysqli_real_escape_string($conn,$SN);
	$sql = "SELECT * FROM `device` WHERE `SN` = '$SN'";
	//echo ($sql."<br>".strlen($SN)."<br>");
	if(!mysqli_query($conn, $sql)){die('Error : ' . mysqli_error($conn));}
	$result = $conn->query($sql);
	$conn->close();

	if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$Security = $row["Security"]; //安全等级 0公开 1私密 2半公开隐藏NOTE,N1,N2
				
				switch ($Security){
					case 0:
						$SN = $row["SN"];
						$TAG = $row["TAG"];
						$TIME = $row["TIME"];
						$NOTE = $row["NOTE"];
						$N1 = $row["N1"];
						$N2= $row["N2"];
						break;
					case 1:
						if (empty ( $_SESSION ['user'] )){
							header ( "location:login.php?req_url=" . $_SERVER ['REQUEST_URI'] );
							exit();
						}
						$SN = $row["SN"];
						$TAG = $row["TAG"];
						$TIME = $row["TIME"];
						$NOTE = $row["NOTE"];
						$N1 = nl2br($row["N1"]);
						$N2= $row["N2"];
						break;
					case 2:
						$SN = $row["SN"];
						$TAG = $row["TAG"];
						$TIME = $row["TIME"];
						$N2= $row["N2"]; //N2属于半公开
						if (!empty ( $_SESSION ['user'] )){
							$NOTE = $row["NOTE"];
							$N1 = nl2br($row["N1"]);
						}
						break;
					default:
						$SN = "安全级别错误";
						$TAG = "安全级别错误";
						$TIME = "安全级别错误";
				}
				include ('src/Read.html.php');
			}
	} else {
		echo "<p style='font-size: 9vw; text-align: left; width:100%;'>Not Found.</p>";
	}
} else {
	echo "<p style='font-size: 9vw; text-align: left; width:100%;'>SN too lonnnnnng.</p>";
}

?>