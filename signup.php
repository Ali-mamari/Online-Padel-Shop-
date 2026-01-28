<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Signup Form</title>
<style>
    /* Basic Reset */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .form-container {
        background-color: #fff;
        padding: 20px;
        max-width: 400px;
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .form-container form {
        display: flex;
        flex-direction: column;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        font-size: 16px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .links {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .links a {
        color: #4CAF50;
        text-decoration: none;
        font-size: 14px;
    }

    .links a:hover {
        text-decoration: underline;
    }

    .message {
        margin-top: 20px;
        color: red;
        font-weight: bold;
        text-align: center;
    }
</style>

<script>
    // Client-side validation for password length and phone number length
    function validateForm() {
        var password = document.getElementById("pwd").value;
        var phone = document.getElementById("phone").value;

        // Password length check
        if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            return false;
        }

        // Phone number length check
        if (phone.length !== 8 || isNaN(phone)) {
            alert("Phone number must be exactly 8 digits long.");
            return false;
        }

        return true;
    }
</script>

</head>
<body>
<div class="form-container">
    <h1>Signup Form</h1>
    <form action="" method="post" onsubmit="return validateForm()">
        <label for="cname">Customer Name</label>
        <input type="text" id="cname" name="cname">

        <label for="email">Email</label>
        <input type="email" id="email" name="email">

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone">

        <label for="city">City</label>
        <input type="text" id="city" name="city">

        <label for="country">Country</label>
        <input type="text" id="country" name="country">

        <label for="address">Address</label>
        <input type="text" id="address" name="address">

        <label for="un">User Name</label>
        <input type="text" id="un" name="un">

        <label for="pwd">Password</label>
        <input type="password" id="pwd" name="pwd">

        <input type="submit" name="sb" value="Save">
    </form>
    <div class="links">
        <a href="login.php">Already have an account?</a>
        <a href="adminsignup.php">admin registration</a>
    </div>
</div>

<?php
// Check validation
if (isset($_POST['sb'])) {
    // Server-side password length validation
    if (strlen($_POST['pwd']) < 6) {
        echo "<div class='message'>Password must be at least 6 characters long.</div>";
    // Server-side phone number length validation
    } elseif (strlen($_POST['phone']) !== 8 || !is_numeric($_POST['phone'])) {
        echo "<div class='message'>Phone number must be exactly 8 digits long.</div>";
    } elseif (!empty($_POST['cname']) && !empty($_POST['email']) && !empty($_POST['phone']) &&
        !empty($_POST['city']) && !empty($_POST['country']) && !empty($_POST['address']) &&
        !empty($_POST['un']) && !empty($_POST['pwd'])) {
        
        // Receive data
        $name = $_POST['cname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $address = $_POST['address'];
        $username = $_POST['un'];
        $password = $_POST['pwd'];
        
        // Database connection and data insertion
        include 'condb.php';
        
        $sql = "SELECT * FROM usertbl WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':username' => $username]);
        
        if ($stmt->rowCount() > 0) {
            echo "<div class='message'>User Name already exists. Please choose another one.</div>";
        } else {
            // Insert into customertbl
            $sql = "INSERT INTO customertbl (name, email, phone, city, country, address, username) 
                    VALUES (:name, :email, :phone, :city, :country, :address, :username)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':city' => $city,
                ':country' => $country,
                ':address' => $address,
                ':username' => $username
            ]);

            // Insert into usertbl
            $ut = "cust";
            $sql = "INSERT INTO usertbl (username, usertype, password) 
                    VALUES (:username, :usertype, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':usertype' => $ut,
                ':password' => $password
            ]);

            echo "<div class='message' style='color:green;'>Customer registered successfully!</div>";
            header("Location: login.php");
            exit;
        }
    } else {
        echo "<div class='message'>Please fill all the fields.</div>";
    }
}
?>
</body>
</html>
