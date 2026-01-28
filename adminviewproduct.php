<?php
// adminviewproduct.php
session_start();
echo " Welcome " . $_SESSION['username'];
echo "<br>";
echo "<a href='logout.php' class='logout-btn'>Logout</a>";
echo "<h1> Get Online rackets - Administration Work </h1>";

include 'condb.php';
$sql = "SELECT * FROM producttbl";
$stmt = $conn->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$n = $stmt->rowCount();

echo "<br><a href='adminprofile.php' class='profile-link'>Click to Admin Profile</a><br><br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Product View</title>
    <style>
        /* Basic body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Container for the product list */
        .container {
            width: 90%;
            max-width: 1200px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        /* Header styling */
        h1 {
            text-align: center;
            color: #333;
        }

        /* Logout and profile link styling */
        .logout-btn, .profile-link {
            color: #4CAF50;
            text-decoration: none;
            font-size: 16px;
            margin-top: 10px;
        }

        .logout-btn:hover, .profile-link:hover {
            text-decoration: underline;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Image styling */
        img {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
        }

        /* Action buttons styling */
        .action-btn {
            color: #007BFF;
            text-decoration: none;
            margin-right: 15px;
        }

        .action-btn:hover {
            text-decoration: underline;
        }

        /* Confirmation dialog styling */
        .delete-btn {
            color: #e53935;
        }

        .delete-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Picture</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($n > 0) {
                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>{$row['pname']}</td>";
                    echo "<td>{$row['pprice']}</td>";
                    echo "<td><a href='{$row['pic']}'><img src='{$row['pic']}' alt='{$row['pname']}' /></a></td>";
                    echo "<td>
                        <a href='updateproduct.php?id={$row['pid']}' class='action-btn'>Update</a> |
                        <a href='deleteproduct.php?id={$row['pid']}' class='delete-btn' onclick=\"return confirm('Are you sure you want to delete this product?');\">Delete</a>
                        </td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
