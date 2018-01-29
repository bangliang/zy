<?php
// http请求

// 1. 接值
$name = $_POST['name'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$password = $_POST['password'];

$dbms='mysql';     //数据库类型
$host='localhost:3306'; //数据库主机名
$dbName='test';    //使用的数据库
$user='root';      //数据库连接用户名
$pass='milkeyY-';          //对应的密码
$dsn="$dbms:host=$host;dbname=$dbName";
$dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh1 = new PDO($dsn, $user, $pass); //初始化一个PDO对象
$dbh1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//进行信息处理
if($name != null){
	if($telephone != null){
		if ($email != null) {
			if ($password != null) {
					$sql1 = "select count(*) from users where name='$name' or email='$email'";
					$result1 = $dbh1->exec($sql1); 
					if($result1 > '0'){
						$url = "index.php";
						header("Refresh:3,URL=$url");
						echo "name或email已经存在！";
					}
					else{
						// 密码加密
						$password = password_hash($password, PASSWORD_DEFAULT);

						$sql = "insert into users (name,telephone,email, password) values ('$name','$telephone','$email', '$password')";//插入数据库
						$result = $dbh->exec($sql);

						//页面跳转至登录页面
						$url = "index1.php";
						if ($result != null) {
							header("Refresh:3,URL=$url");
							echo '注册成功！3s后跳转到登录页面！';
							die;
						}
						else{
							echo "注册失败！请联系管理员！";
						}
					}
			}
			else{
				$url = "index.php";
				header("Refresh:1,URL=$url");
				echo "password不能为空！";
			}
		}
		else{
			$url = "index.php";
			header("Refresh:1,URL=$url");
			echo "email不能为空！";
		} 
	}
	else{
		$url = "index.php";
		header("Refresh:1,URL=$url");
		echo "telephone不能为空！";
	} 
}
else {
	$url = "index.php";
	header("Refresh:1,URL=$url");
	echo "name不能为空！";
}



// 防止sql注入