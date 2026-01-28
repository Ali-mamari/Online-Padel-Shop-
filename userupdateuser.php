<?php 
include 'condb.php';

$cid = $name = $email = $phone = $city = $country = $address = '';

if (isset($_GET['id'])) {
    $cid = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM customertbl WHERE cid=:cid");
    $stmt->execute([':cid' => $cid]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $city = $row['city'];
        $country = $row['country'];
        $address = $row['address'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['up'])) {
        $cid = $_POST['cid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $address = $_POST['address'];

        $sql = "UPDATE customertbl SET name=:name, email=:email, phone=:phone, city=:city, country=:country, address=:address WHERE cid=:cid";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':city' => $city,
            ':country' => $country,
            ':address' => $address,
            ':cid' => $cid
        ]);

        header("Location: adminviewuser.php");
        exit();
    } elseif (isset($_POST['del'])) {
        $cid = $_POST['cid'];
        $stmt = $conn->prepare("DELETE FROM customertbl WHERE cid=:cid");
        $stmt->execute([':cid' => $cid]);

        echo "<br><br>Successfully deleted";
        header("Location: adminviewuser.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        label {
            font-size: 14px;
            color: #555;
            text-align: left;
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        input[type="submit"] {
            width: 48%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .delete-btn:hover {
            background-color: #e53935;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
        }
        .form-actions input {
            width: 48%;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Update User</h1>
    <form action="" method="post">
        <input type="hidden" name="cid" value="<?php echo $cid; ?>">
        
        <label>Username</label>
        <input type="text" name="name" value="<?php echo $name; ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required>

        <label>Phone Number</label>
        <input type="text" name="phone" value="<?php echo $phone; ?>" required>

        <label>City</label>
        <input type="text" name="city" value="<?php echo $city; ?>" required>

        <label>Country</label>
        <input type="text" name="country" value="<?php echo $country; ?>" required>

        <label>Address</label>
        <input type="text" name="address" value="<?php echo $address; ?>" required>

        <div class="form-actions">
            <input type="submit" name="up" value="Update">
            <input type="submit" name="del" value="Delete User Info" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?');">
        </div>
    </form>
</div>

</body>
</html>
