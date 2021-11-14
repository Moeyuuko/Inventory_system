<?php
session_start();

include(".Config.php");
include("src/login_info.php");

// Create connection
$conn = new mysqli($servername, $db_username_Readonly, $db_password_Readonly, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
mysqli_query($conn, 'set names utf8');

class json_deta_c {
		public $Security = "";
		public $SN = "";
		public $TAG  = "";
		public $TIME = "";
		public $NOTE = "";
		public $N1 = "";
		public $N2 = "";
	}

$SN = $_GET['key'];
if(strlen($SN)<=12 && strlen($SN)>0){
	$SN = mysqli_real_escape_string($conn,$SN);
	$sql = "SELECT * FROM `device` WHERE `SN` = '$SN'";
	//echo ($sql."<br>".strlen($SN)."<br>");
	if(!mysqli_query($conn, $sql)){die('Error : ' . mysqli_error($conn));}
	$result = $conn->query($sql);
	$conn->close();

	if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$Security = $row["Security"]; //安全等级 0公开 1私密 2半公开隐藏NOTE,N1,N2
				$json_deta->Security = $Security;				
				switch ($Security){
					case 0:
						$json_deta->SN = $SN = $row["SN"];
						$json_deta->TAG = $TAG = $row["TAG"];
						$json_deta->TIME = $TIME = $row["TIME"];
						$json_deta->NOTE = $NOTE = $row["NOTE"];
						$json_deta->N1 = $row["N1"];
						$N1 = nl2br($row["N1"]);
						$json_deta->N2 = $N2= $row["N2"];
						break;
					case 1:
						if (empty ( $_SESSION ['user'] )){
							if($_GET['type']=='json'){  #json输出
								header('content-type:application/json;charset=utf8');
								echo json_encode($json_deta, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
							}else{
								header ( "location:login.php?req_url=" . $_SERVER ['REQUEST_URI'] );
							}
							exit();
						}
						$json_deta->SN = $SN = $row["SN"];
						$json_deta->TAG = $TAG = $row["TAG"];
						$json_deta->TIME = $TIME = $row["TIME"];
						$json_deta->NOTE = $NOTE = $row["NOTE"];
						$json_deta->N1 = $row["N1"];
						$N1 = nl2br($row["N1"]);
						$json_deta->N2 = $N2= $row["N2"];
						break;
					case 2:
						$json_deta->SN = $SN = $row["SN"];
						$json_deta->TAG = $TAG = $row["TAG"];
						$json_deta->TIME = $TIME = $row["TIME"];
						$json_deta->N2 = $N2= $row["N2"]; //N2属于半公开
						if (!empty ( $_SESSION ['user'] )){
							$json_deta->NOTE = $NOTE = $row["NOTE"];
							$json_deta->N1 = $row["N1"];
						}
						break;
					default:
						$SN = "安全级别错误";
						$TAG = "安全级别错误";
						$TIME = "安全级别错误";
				}
				if($_GET['type']=='json'){  #json输出
					header('content-type:application/json;charset=utf8');
					echo json_encode($json_deta, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
				}else{
					include ('src/Read.html.php');
				}
			}
	} else {
		if($_GET['type']=='json'){  #json输出
			http_response_code(404); #json方式返回404表示找不到
		}else{
			$SN = "查询不到";
			$TAG = "Not Found.";
			$TIME = "(Ｔ▽Ｔ)";
			include ('src/Read.html.php');
		}
	}
} else {
	echo "<p style='font-size: 9vw; text-align: left; width:100%;'>SN ERROR.</p>";
}

?>