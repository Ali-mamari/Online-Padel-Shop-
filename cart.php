<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shopping Cart</title>
<style>
    /* Your CSS styles */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; color: #333; }
    h1, h2, h3 { text-align: center; color: #333; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    th { background-color: #f7f7f7; font-weight: bold; }
    img { max-width: 100px; max-height: 150px; height: auto; }
    .form-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 600px; margin: 0 auto; }
    label { font-weight: bold; display: inline-block; margin-bottom: 8px; }
    input[type="text"], input[type="number"], input[type="date"] { width: 100%; padding: 10px; font-size: 16px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; }
    input[type="submit"] { width: 100%; padding: 12px; background-color: #4CAF50; color: #fff; font-size: 16px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease; }
    input[type="submit"]:hover { background-color: #45a049; }
    .links { text-align: center; margin-top: 20px; }
    .links a { color: #4CAF50; text-decoration: none; font-size: 14px; }
    .links a:hover { text-decoration: underline; }
    .address-info { text-align: center; font-size: 16px; margin: 20px 0; }
</style>
</head>
<body>
<h1>Shopping Cart</h1>

<div class="address-info">
    <?php 
    include 'condb.php';
    session_start();
    $username = $_SESSION['username'];
    echo "<p>Dear <strong>{$username}</strong></p>";
    echo "<a href='logout.php'>Logout</a>";
    echo "<h2>Place Your Order</h2>";

    $stmt = $conn->query("SELECT * FROM customertbl WHERE username='$username'");
    $stmt->execute(); 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $cname = $row['name'];
    echo "<h3>Dear <b>{$cname}</b>, Your Shipment Address</h3>";
    echo "<p>Address: {$row['address']}<br>City: {$row['city']}<br>Country: {$row['country']}<br>Contact No: {$row['phone']}</p>";
    $cid = $row['cid'];
    ?>

    <?php
    if(isset($_GET['id'])) {
        $pid = $_GET['id'];
        $stmt = $conn->query("SELECT * FROM producttbl WHERE pid='$pid'");
        $stmt->execute(); 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<table>";
        echo "<tr><th>Name</th><th>Price (OMR)</th><th>Picture</th></tr>";
        echo "<tr>";
        echo "<td>{$row['pname']}</td>";
        echo "<td>{$row['pprice']} OMR</td>";
        echo "<td><a href='{$row['pic']}'><img src='{$row['pic']}' alt='Product Image'/></a></td>";
        echo "</tr>";
        echo "</table>";
        $price = $row['pprice'];
        $qty = $row['qty'];
    }
    ?>
</div>

<div class="form-container">
    <form action="" method="post">
        <label>Product ID</label>
        <input type="text" name="pid" readonly value="<?php if(!empty($pid)){echo $pid;} ?>">

        <label>Quantity</label>
        <input type="number" name="oqty" value="1">

        <label>Credit Card No</label>
        <input type="number" name="ccno" value="12345678987654321">

        <label>Expiry Date</label>
        <input type="date" name="exp">

        <label>CVC Code</label>
        <input type="number" name="cvc" value="345">

        <input type="submit" name="sb" value="Place Order">
    </form>
</div>

<div class="links">
    <a href="userupdateuser.php">Update Info</a>
</div>

</body>
</html>

<?php
if(isset($_POST['sb'])) {
    if(!empty($_POST['oqty']) && !empty($_POST['ccno']) && !empty($_POST['exp']) && !empty($_POST['cvc'])) {
        $totalbill = $_POST['oqty'] * $price;
        
        // Insert order into ordertbl
        $sql = "INSERT INTO ordertbl (cid, pid, oprice, quantity, totalbill, odate, ccno, cvc, expdate) 
                VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':a' => $cid,
            ':b' => $pid,
            ':c' => $price,
            ':d' => $_POST['oqty'],
            ':e' => $totalbill,
            ':f' => date("Y-m-d"),
            ':g' => $_POST['ccno'],
            ':h' => $_POST['cvc'],
            ':i' => $_POST['exp']
        ));

        echo "<p style='text-align: center; color: green;'>Order inserted successfully!</p>";
        
        // Update quantity in producttbl
        $qty = $qty - $_POST['oqty'];
        $sql = "UPDATE producttbl SET qty = :q WHERE pid='$pid'";
        $stmt1 = $conn->prepare($sql);
        $stmt1->execute(array(':q' => $qty));
        header("Location: thanks.php");
    }
} 
?>
