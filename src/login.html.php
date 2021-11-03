<html lang="zh-CN">
	<head>
		<title>登录-萌域库存</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style>
			body { font-family: Helvetica, Arial, sans-serif; font-size:16px; color: #000; font-weight:normal;}
			.button {
				-webkit-appearance:none;
				height: 1.8em;
				width: 5.3em;
			}
			.login_info {
				font-size: 5vw;
				text-align: center;
			}
		</style>
		<script src="js/md5.min.js"></script>
	</head>
	<body>
		<div style='text-align: center'>
			<h1 style='font-size: 5vw;'>登录</h1>
			<div style='border: 5px solid;'>
				<p style='font-size: 5vw;'>
					<form id="form1" name="form1" method="post" action="" onsubmit="return checkForm()" style='font-size: 5vw; text-align: center; width:100%;'>
						<p style='margin:0px;'>--用户名--</p>
						<input type="text" name="username" required="required" id="username" value="" style='font-size: 5vw; width:95%;'/>
						<p style='margin:0px;'>--密码--</p>
						<input type="password" required="required" id="password" value="" style='font-size: 5vw; width:95%;'/>
						<input type="hidden" name="password" id="password_md5">
						<br><br><input type="submit" name="button" id="button" value="登录" style='font-size: 5vw;' class="button"/><br>
						<br><input type="checkbox" name="remember" value="1" checked="true" style="zoom:200%;">记住密码
					</form>
				</p>
			</div>
			<?php echo $login_info?>
		</div>
		<footer><a style='color:#000000; position:absolute; font-size: 2vw;' href="https://github.com/Moeyuuko" target="_blank" >©2021 Moeyuuko. All rights reserved.</a></footer>
		<script>
			function checkForm() {
				var pwd = document.getElementById('password');
				var pwd_md5 = document.getElementById('password_md5');
				pwd_md5.value = md5(pwd.value);
				return true;
			}
		</script>
	</body>
</html>