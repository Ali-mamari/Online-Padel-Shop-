<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administration Page</title>
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
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        width: 100%;
        text-align: center;
    }

    /* Header styling */
    h1 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    /* Welcome text styling */
    .welcome-message {
        font-size: 18px;
        color: #555;
        margin-bottom: 30px;
    }

    /* Button styling */
    .button {
        display: block;
        background-color: #4CAF50;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        text-align: center;
    }

    .button:hover {
        background-color: #45a049;
    }

    /* Logout button */
    .logout {
        background-color: #f44336;
    }

    .logout:hover {
        background-color: #e53935;
    }
</style>
</head>
<body>

<div class="container">
    <?php
    session_start();
    echo "<h1>Administration Page</h1>";
    echo "<p class='welcome-message'>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</p>";
    ?>

    <!-- Links to other pages as buttons -->
	
    <a href="addproduct.php" class="button">Add Product</a>
    <a href="adminviewproduct.php" class="button">Update or Delete Product</a>
    <a href="updateuser.php" class="button">Update Customer Information</a>
    <a href="adminviewuser.php" class="button">View Users</a>
	<a href="homep.php" class="button">home page</a>
    <a href="logout.php" class="button logout">Logout</a>
</div>

</body>
</html>
