<?php
// http请求

// 1. 接值
$name = $_POST['name'];
$password = $_POST['password'];

$dbms='mysql';     //数据库类型
$host='localhost:3306'; //数据库主机名
$dbName='test';    //使用的数据库
$user='root';      //数据库连接用户名
$pass='milkeyY-';          //对应的密码
$dsn="$dbms:host=$host;dbname=$dbName";
$dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//进行信息处理
if($name != null){
			if ($password != null) {
						
						$sql = "select password from users where name='$name'";
						$result = $dbh->query("$sql"); 
						$result->setFetchMode(PDO::FETCH_NUM); //数字索引方式  
						$row = $result->fetch(); 
						

						//页面跳转至登录页面
						if (password_verify($password,$row[0])) {
							$url = "index2.php";
							header("Refresh:3,URL=$url");
							echo '登录成功！3s后跳转到主页！';
						
						}
						else{
							$url = "login.php";
							header("Refresh:3,URL=$url");
							echo "登录失败！请检查您的用户名和密码！";
							
						}
					}
			
			else{
				$url = "index1.php";
				header("Refresh:1,URL=$url");
				echo "password不能为空！";
			}
}
		
else {
	$url = "index1.php";
	header("Refresh:1,URL=$url");
	echo "name不能为空！";
}



// 防止sql注入