<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<style>
    /* Reset some default styling */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* Body styling */
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    /* Container styling */
    .container {
        background-color: #ffffff;
        padding: 20px 40px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    /* Header styling */
    h1 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    /* Label and input styling */
    label {
        display: block;
        margin-bottom: 8px;
        color: #666;
        font-weight: bold;
        text-align: left;
    }
    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    /* Button styling */
    input[type="submit"],
    input[type="button"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        color: #fff;
    }
    input[type="submit"] {
        background-color: #4CAF50;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    input[type="button"] {
        background-color: #f44336;
        margin-top: 10px;
    }
    input[type="button"]:hover {
        background-color: #e53935;
    }

    /* Signup link styling */
    .signup-link {
        display: block;
        margin-top: 20px;
        color: #333;
        text-decoration: none;
        font-size: 14px;
    }
    .signup-link:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="container">
    <h1>Admin Login</h1>
    <form action="" method="post">
        <label for="username">Admin Username</label>
        <input type="text" id="username" name="un" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="pw" required>
        
        <input type="submit" name="sb" value="Login">
        <input type="button" name="fp" value="Forgot Password">
            <a href="adminsignup.php" class="button">Admin register</a>
        	<a href="homep.php" class="button">home page</a>

        </a>
    
    </form>
</div>

</body>
</html>

<?php
session_start();
include 'condb.php';

if (isset($_POST['sb'])) {
    if (!empty($_POST['un']) && !empty($_POST['pw'])) {
        $username = $_POST['un'];
        $password = $_POST['pw'];
        $_SESSION['username'] = $username;

        $stmt = $conn->query("SELECT * FROM admin WHERE username ='$username'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            if ($password == $row['password']) {
                header("Location: adminprofile.php");
            } else {
                echo "<p style='color: red; text-align: center;'>Wrong Password</p>";
            }
        } else {
            echo "<p style='color: red; text-align: center;'>Wrong username</p>";
        }
    }
}
?>
