<?php
// Connection file
$host = "localhost";
$user = "root";
$pwd = "";
try{
	//connection string
$conn = new PDO("mysql:host=$host;dbname=gmodb", $user, $pwd);
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//echo "Connected successfully";
}
catch(Exception $e){
echo ("Internal Login Error, Please Contact Web Site Support");
$error = "Error message: ".$e->getMessage() ." Error at line: ".$e->getLine()." in a file named : ".$e->getFile();
error_log($error);
return;
}
?>
