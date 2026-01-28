<?php
session_start();

// Check if the 'username' session variable is set
if (isset($_SESSION['username'])) {
    echo "Thanks " . $_SESSION['username'] . " for visiting us - Stay Connected";
    session_unset();
    session_destroy();
} else {
    echo "You are not logged in.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        /* Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #333;
        }

        /* Container for message */
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        /* Heading Styling */
        h1 {
            color: #4CAF50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Message Text */
        p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Button Styling */
        a {
            display: inline-block;
            padding: 12px 30px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #45a049;
        }

        /* Responsive Styling for smaller screens */
        @media (max-width: 600px) {
            h1 {
                font-size: 20px;
            }

            p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Thank You!</h1>
    <!-- Check if the session variable is set before displaying the username -->
    <p>
        <?php
        if (isset($_SESSION['username'])) {
            echo "Thanks, " . $_SESSION['username'] . ", for visiting us. Stay connected!";
        } else {
            echo "You are not logged in.";
        }
        ?>
    </p>
    <a href="login.php">Click to Login Again</a>
	<BR>	<BR>

        <a href="homep.php">Click to go to home page</a>
        
       
</div>

</body>
</html>
