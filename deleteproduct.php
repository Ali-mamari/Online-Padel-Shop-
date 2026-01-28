<?php
//deleteproduct.php
include 'condb.php';
if(isset($_GET['id'])){
$pid = $_GET['id'];
$stmt = $conn-> query("DELETE FROM producttbl WHERE pid='{$pid}'");
$stmt -> execute();
header("Location:adminviewproduct.php"); }
?>