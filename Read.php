<?php
	foreach($_GET as $key=>$val) {            // read get request from web
		$SN = $val;
	}
//$servername = "";                //connect db
//$username = "";
//$password = "*";
//$dbname = "";
include(".key.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$SN = mysqli_real_escape_string($conn,$SN);
$sql = "SELECT * FROM `device` WHERE `SN` = '$SN'";
//echo ($sql."<br>".strlen($SN)."<br>");
mysqli_query($conn, 'set names utf8');
if(strlen($SN)<=12){
	if(!mysqli_query($conn, $sql))
	{
		die('Error : ' . mysqli_error($conn));
	}
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// output db
			while($row = $result->fetch_assoc()) {
				$TAG = $row["TAG"];
				$TIME = $row["TIME"];
				$NOTE = $row["NOTE"];
				$N1 = $row["N1"];
				$N2= $row["N2"];
				header('Content-Type:text/html; charset=UTF-8; lang=zh-CN;');
				echo"<html lang=\"zh-CN\"><body>";
				echo"<div style='text-align: center'>";
				echo"<h1>";
				print ("库存系统");
				echo"</h1>";
				echo"</br>";
				echo"<div style='border: 5px solid;'>";
				echo"<p style='font-size: 5vw; text-align: left; margin-left: 10%; width:80%;'>";
				print ("SN：".$SN);
				echo"</br>";
				print ("TAG：".$TAG);
				echo"</br>";
				if($TIME != NULL){
					print ("Date：".$TIME);
				}else{
					print ("Date：Unknow");
				}

				if($NOTE != NULL){
					echo"</br>";
					print ("INFO：");
					echo"<p style='font-size: 4vw; text-align: left; margin-left: 10%; width:80%; height: 30%; border: 5px inset;'>";
					print ($NOTE);
					echo"</p>";
				}else{
				}
				if($N1 != NULL){
					echo"</br>";
					echo"<p style='font-size: 3vw; text-align: left; margin-left: 10%; width:80%; border: 5px inset;'>";
					print ($N1);
					echo"</p>";
				}else{
				}
				if($N2 != NULL){
					echo"</br>";
					echo"<p style='font-size: 3vw; text-align: left; margin-left: 10%; width:80%; border: 5px inset;'>";
					print ($N2);
					echo"</p>";
				}else{
				}
			echo"</p>";
			echo"</div>";
			echo"</div>";
			echo"</body></html>";
			}
	} else {
		echo "Not Found";
	}
} else {
	echo "SN too lonnnnnng";
}
$conn->close();
?>