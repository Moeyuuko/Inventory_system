<html lang="zh-CN">
	<head>
		<title>搜索-库存系统</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style>
			body { 
				font-family: Helvetica, Arial, sans-serif; 
				font-size:16px; color: #000; 
				font-weight:normal;
			}
			.button {
				-webkit-appearance:none;
				height: 1.8em;
				width: 5.3em;
			}
		</style>
	</head>
	<body>
		<div style='text-align: center; height: 95%;'>
			<h1 id=title style='font-size: 5vw;'>库存系统</h1>
			<div style='border: 5px solid;'>
				<p style='font-size: 5vw;'>
					<form name="input" action="Read.php" method="get" style='font-size: 5vw; text-align: left; width:100%;'>
						SN: 
						<input type="text" name="key" required="required" style='font-size: 5vw; width:60%;'>
						<input type="submit" value="Submit" style='font-size: 5vw;' class="button">
					</form>
				</p>
			</div>
			<a id="login_info" class="login_info"><?php echo login_info();?></a>
		</div>
		<footer><a style='color:#000000; position:absolute; font-size: 2vw;' href="" target="_blank" >©2021 Moeyuuko. All rights reserved.</a></footer>
	</body>
</html>