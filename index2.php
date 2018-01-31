<?php 
$dbms = 'mysql';
$host = 'localhost:3306';
$dbName = 'dizoom';
$user = 'root';
$pass = 'milkeyY-';
$dsn = "$dbms:host=$host; dbname=$dbName";//$dbname前面不能有空格
$dbh = new PDO($dsn , $user , $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "select * from copy";
$res = $dbh->query($sql);
foreach ($res as $row) {
    print $row['title'] . "/n";   
    print $row['original']."/t";
    print $row['author']."/n";
    print $row['content'] . "/n";   
 
}
?>