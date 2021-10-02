<html lang="zh-CN">
	<head>
		<title>写-萌域库存</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style>
			body { font-family: Helvetica, Arial, sans-serif; font-size:16px; color: #000; font-weight:normal;}
			.button {
				-webkit-appearance:none;
				height: 1.8em;
				width: 5.3em;
			}
		</style>
	</head>
	<body>
		<div style='text-align: center;'>
			<h1 style='font-size: 5vw;'>录入</h1>
			<div style='border: 5px solid;'>
				<p style='font-size: 5vw;'>
					<form name="input" action="" method="POST" style='font-size: 5vw; text-align: center; width:100%;'>
						<p style='margin:0px;'>--TAG--</p>
						<input type="text" name="TAG" required="required" style='font-size: 5vw; width:95%;'>
						<p style='margin:0px;'>--TIME--</p>
						<input type="text" name="TIME" required="required" style='font-size: 5vw; width:95%;' value='<?php echo date("Y/m/d H:i",time());?>'>
						<p style='margin:0px;'>--NOTE--</p>
						<textarea name="NOTE" style='font-size: 5vw; width:95%; min-height:30%;'></textarea>
						<p style='margin:0px;'>--INFO--</p>
						<textarea name="N1" style='font-size: 5vw; width:95%; min-height:20%;'></textarea>
						<p style='margin:0px;'>--Public--</p>
						<textarea name="N2" style='font-size: 5vw; width:95%; min-height:20%;'></textarea><br><br>
						<input type="radio" name="Security" style="zoom:250%"; value="1" checked="true">私密 
						<input type="radio" name="Security" style="zoom:250%"; value="0">公开 
						<input type="radio" name="Security" style="zoom:250%"; value="2">半公开
						<br><br><br>
						<input type="submit" name="button" value="Submit" style='font-size: 5vw;' class="button"><br><br>

					</form>
				</p>
			</div>
			<a id="login_info" class="login_info"><?php echo login_info();?></a>
		</div>
		<footer><a style='color:#000000; position:absolute; font-size: 2vw;' href="" target="_blank" >©2021 Moeyuuko. All rights reserved.</a></footer>
	</body>
</html>