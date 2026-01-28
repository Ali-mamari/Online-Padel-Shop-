<?php 
include 'condb.php'; 

$stmt = $conn->query("SELECT * FROM customertbl");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <style>
        /* Basic styling for the body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container to center the table */
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
        }

        /* Table header styling */
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            color: #333;
        }

        /* Optional: Add zebra-stripe rows */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Styling for the table */
        table {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Button for going back or other actions */
        .back-btn {
            display: block;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>View Users</h1>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>City</th>
                <th>Phone Number</th>
                <th>Country</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['cid']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['city']; ?></td>
                <td><?php echo $user['phone']; ?></td>
                <td><?php echo $user['country']; ?></td>
                <td><?php echo $user['address']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Optional back button -->
    <a href="adminprofile.php" class="back-btn">Back to Dashboard</a>
</div>

</body>
</html>
