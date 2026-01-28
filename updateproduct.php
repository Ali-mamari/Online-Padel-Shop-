<?php 
include 'condb.php';

if (isset($_GET['id'])) {
    $pid = $_GET['id'];
    $stmt = $conn->query("SELECT * FROM producttbl WHERE pid='$pid'");
    $stmt->execute(); 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Fetch records
    $pname = $row['pname'];
    $pprice = $row['pprice'];
    $qty = $row['qty'];
}

if (isset($_POST['sb'])) {
    if (!empty($_POST['pid']) && !empty($_POST['pname']) && !empty($_POST['pprice']) && !empty($_POST['pqty'])) { 
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pqty = $_POST['pqty'];

        $sql = "UPDATE producttbl SET pname = :a, pprice = :d, qty = :e WHERE pid = '$pid'";
        $stmt1 = $conn->prepare($sql);
        $stmt1->execute(array(
            ':a' => $pname, 
            ':d' => $pprice,
            ':e' => $pqty
        ));
        header("Location: adminviewproduct.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        input[type="number"], input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #007bff;
        }
        .link:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            text-align: center;
        }
        .success {
            color: green;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Update Product</h1>
        
        <form action="" method="post">
            <label for="pid">Product ID</label>
            <input type="number" name="pid" readonly value="<?php if (!empty($pid)) { echo $pid; } ?>">

            <label for="pname">Product Name</label>
            <input type="text" name="pname" value="<?php if (!empty($pname)) { echo $pname; } ?>">

            <label for="pprice">Product Price</label>
            <input type="number" name="pprice" value="<?php if (!empty($pprice)) { echo $pprice; } ?>">

            <label for="pqty">Product Quantity</label>
            <input type="number" name="pqty" value="<?php if (!empty($qty)) { echo $qty; } ?>">

            <input type="submit" name="sb" value="Update Product">
        </form>

        <a class="link" href="adminviewproduct.php">View Product List</a>
    </div>

    <?php
    // Optional: Error or success messages could be added here if needed.
    ?>

</body>
</html>
