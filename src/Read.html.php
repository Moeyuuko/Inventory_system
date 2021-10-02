<html lang="zh-CN">
	<head>
		<title>信息-库存系统</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style>
			body { font-family: Helvetica, Arial, sans-serif; font-size:16px; color: #000; font-weight:normal;}
			.div_1{font-size: 5vw; text-align: left; margin-left: 5%;}
			.p_1{font-size: 4vw; text-align: left; width:94%; min-height: 20%; margin-bottom: 5%; margin-top: 0%; border: 3px inset;}
			.p_2{font-size: 4vw; text-align: left; width:94%; min-height: 5%; margin-bottom: 5%; margin-top: 0%; border: 3px inset;}
		</style>
	</head>
	<body>
		<div style='text-align: center;'>
			<h1 id=title style='font-size: 5vw;'>库存信息</h1>
			<div style='border: 5px solid;'>
				<p style='font-size: 5vw; text-align: left; margin-left: 5%; width:95%;'>
					<a id="SN">SN: <?php echo $SN?></a>
					<br><a id="TAG">TAG <?php echo $TAG?></a>
					<br><a id="TIME">TIME: <?php echo $TIME?></a>
					<?php
					if (!empty($NOTE)){
						echo "<div id=\"NOTE_div\" class=\"div_1\" >NOTE: <p id=\"NOTE\" class=\"p_1\">".$NOTE."</p></div>";
					}
					if (!empty($N1)){
						echo "<div id=\"N1_div\" class=\"div_1\" >N1: <p id=\"N1\" class=\"p_2\">".$N1."</p></div>";
					}
					if (!empty($N2)){
						echo "<div id=\"N2_div\" class=\"div_1\" >N2: <p id=\"N2\" class=\"p_2\">".$N2."</p></div>";
					}
					?>
				</p>
			</div>
			<a id="login_info" class="login_info"><?php echo login_info();?></a>
		</div>
		<footer><br><br><a style='color:#000000; position:absolute; font-size: 2vw;' href="" target="_blank" >©2021 Moeyuuko. All rights reserved.</a></footer>
	</body>
</html>