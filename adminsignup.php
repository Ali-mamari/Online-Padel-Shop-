<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup Form</title>
    <style>
        /* Basic styling for body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container for the form */
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        /* Heading styling */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form labels and inputs */
        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        /* Submit button styling */
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Link for already have account */
        .login-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        /* Error message styling */
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Admin Signup Form</h1>
    <form action="" method="post">
        <label>User Name</label>
        <input type="text" name="un" required>

        <label>Password</label>
        <input type="password" name="pwd" required>

        <input type="submit" name="sb" value="Save">
        	<a href="homep.php" class="button">home page</a>

        <a href="adminlogin.php" class="login-link">Already have an account?</a>
    </form>
</div>

<?php
// Check validation
if (isset($_POST['sb'])) {
    if (!empty($_POST['un']) && !empty($_POST['pwd'])) {
        // Receive data
        $username = $_POST['un'];
        $password = $_POST['pwd'];
        
        // Connection
        include 'condb.php';
        $sql = "SELECT * FROM admin WHERE username = '$username'";
        $stmt = $conn->query($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $n = $stmt->rowCount();

        if ($n > 0) {
            echo "<p class='error'>Username already exists. Please change.</p>";
        } else {
            // Insert into customer table
            $sql = "INSERT INTO customertbl (username) VALUES (:username)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':username' => $username));

            echo "<p>Admin inserted successfully.</p>";

            // Insert into admin table
            $sql = "INSERT INTO admin (username, password) VALUES (:name, :pw)";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':name' => $username, ':pw' => $password));

            echo "<p>Admin inserted successfully.</p>";

            // Redirect to login page after successful signup
            header("Location: adminlogin.php");
            exit(); // Ensure script stops here after redirection
        }
    } else {
        echo "<p class='error'>Please fill all the fields.</p>";
    }
}
?>

</body>
</html>
