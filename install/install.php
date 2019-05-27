<html>
<title>Welcome</title>
<style>
#form_login{
background-image:url('../images/debut_light/debut_light.png');
margin-top:50px;
margin-left:auto;
margin-right:auto;
padding:20px;
width:170px;
border:2px solid;
border-radius:10px; 
border-color:#dedede;
}
</style>

<body>
<div id="form_login" align="center">
<h3 align="center">Instalasi Database ...</h1>
<?php 
	if(isset($_POST['host'])){
		ini_set('max_execution_time', 900);
		$mysqlConnection=mysql_connect($_POST['host'],$_POST['user'],$_POST['pass']) or die('Install Gagal. Harap Cek Database.');
		if (!mysql_connect($_POST['host'],$_POST['user'],$_POST['pass'])){
			echo "Install Gagal. Harap Cek Database.";
		}else{
			$buat_db=mysql_query("create database ".$_POST['db']."");
			if (!$buat_db){
				echo "Install Gagal. Database Sudah Ada.";
			}else{
				$filename = 'data.sql';
				mysql_select_db($_POST['db']) or die('Error selecting MySQL database: ' . mysql_error());
				$templine = '';
				$lines = file($filename);
				foreach ($lines as $line){
					if (substr($line, 0, 2) == '--' || $line == '')
						continue;
					$templine .= $line;
					if (substr(trim($line), -1, 1) == ';'){
						mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
						$templine = '';
					}
				}
				$file_config = fopen('config.php', 'w+');
				fwrite($file_config, "<?php \r\n");
				fwrite($file_config, "\$iHostName='".$_POST['host']."'; \r\n");
				fwrite($file_config, "\$iUserName='".$_POST['user']."'; \r\n");
				fwrite($file_config, "\$iPassword='".$_POST['pass']."'; \r\n");
				fwrite($file_config, "\$iDb='".$_POST['db']."'; \r\n");
				fwrite($file_config, "\$iPort='".$_POST['port']."'; \r\n");
				fwrite($file_config, "?>");
				fclose($file_config);
				header('Location:.');
			}
		}
	}
?>
<form method="POST" action="install.php">
Host <br/><input type="text" name="host"/><br/>
Username  <br/><input type="text" name="user"/><br/>
Password  <br/><input type="password" name="pass"/><br/>
Database name <br/> <input type="text" name="db"/><br/>
Port <br/> <input type="text" name="port" value="3306"/><br/>

<input type="submit" name="submit" value="next >"/>
</form>
</div>
</body>
</html>