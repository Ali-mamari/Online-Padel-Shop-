

<?php
include 'condb.php';
if(isset($_GET['id']))
{
	$cid = $_GET['id'];
	$stmt = $conn-> query("SELECT * FROM
	customertbl WHERE cid='$cid'");
	$stmt-> execute();
	$row = $stmt-> fetch(PDO::FETCH_ASSOC);
	//Fetch Records
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $address = $_POST['address'];


}
?>
<html>
<body>
<h1> Update User </h1>
<form action="" method="post">
<label>User ID </label>
<input type="text" name="cid" >
<br><br>
<label>Username</label>
<input type="text" name="name">
<br><br>
<label>Email</label>
<input type="email" name="email">
<br><br>
<label>Phone Number</label>
<input type="text" name="phone">
<label>City</label>
<input type="text" name="city">
<br><br>
<label>Country</label>
<input type="text" name="country">
<br><br>
<label>Address</label>
<input type="text" name="address">
<br><br>
<input type="submit" name="up" value="Update">
<input type="submit" name="del"  value="Delete user info" >

</form>
</body>
</html>




<?php

if(isset($_POST['up']))
{

    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $address = $_POST['address'];

$sql = "UPDATE customertbl SET name=:name, email=:email, phone=:phone, city=:city, country=:country, address=:address WHERE cid=:cid";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':city' => $city,
        ':country' => $country,
        ':address' => $address,
        ':cid' => $cid
    ));

    // Redirect to adminviewuser.php after update
    header("Location: adminviewuser.php");
}

	if(isset($_POST['del']))
		{
		    $abc = $_POST['cid'];
			$stmt = $conn->query("DELETE FROM customertbl WHERE cid='$abc'");
			$stmt -> execute();
			echo "<br><br>Successfully deleted";

		header("Location: adminviewuser.php");

		}


?>

