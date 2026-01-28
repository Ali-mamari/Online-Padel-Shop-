<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Online Racket Shop</title>

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
        align-items: flex-start;
        flex-direction: row;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .welcome-message {
        font-size: 18px;
        color: #555;
        margin-bottom: 20px;
        text-align: center;
    }

    .logout-link {
        display: inline-block;
        text-decoration: none;
        color: #4CAF50;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .logout-link:hover {
        text-decoration: underline;
    }

    /* Filter Form */
    .filter-section {
        width: 300px;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-right: 20px;
    }

    .filter-section h2 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #333;
    }

    .filter-section select, .filter-section input {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .filter-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border: none;
        width: 100%;
        cursor: pointer;
    }

    .filter-button:hover {
        background-color: #45a049;
    }

    /* Products Table */
    table {
        width: 100%;
        max-width: 800px;
        margin: 20px 0;
        border-collapse: collapse;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
    }

    td {
        background-color: #fff;
    }

    img {
        max-width: 80px;
        max-height: 120px;
        height: auto;
        border-radius: 4px;
    }

    .buy-link {
        background-color: #4CAF50;
        color: white;
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .buy-link:hover {
        background-color: #45a049;
    }

    .action-column {
        text-align: center;
    }
</style>
</head>
<body>
    <div class="filter-section">
        <h2>Search and Filter</h2>
        <form action="" method="get">
            <!-- Search Field -->
            <input type="text" name="search" placeholder="Search by name" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">

            <!-- Price Range Filter -->
            <select name="price_range">
                <option value="">Select Price Range</option>
                <option value="0-20" <?php echo isset($_GET['price_range']) && $_GET['price_range'] == '0-20' ? 'selected' : ''; ?>>0 - 20 OMR</option>
                <option value="20-40" <?php echo isset($_GET['price_range']) && $_GET['price_range'] == '20-40' ? 'selected' : ''; ?>>20 - 40 OMR</option>
                <option value="40-60" <?php echo isset($_GET['price_range']) && $_GET['price_range'] == '40-60' ? 'selected' : ''; ?>>40 - 60 OMR</option>
                <option value="60-80" <?php echo isset($_GET['price_range']) && $_GET['price_range'] == '60-80' ? 'selected' : ''; ?>>60 - 80 OMR</option>
                <option value="80-100" <?php echo isset($_GET['price_range']) && $_GET['price_range'] == '80-100' ? 'selected' : ''; ?>>80 - 100 OMR</option>
                <option value="100+" <?php echo isset($_GET['price_range']) && $_GET['price_range'] == '100+' ? 'selected' : ''; ?>>100+ OMR</option>
            </select>

            <button type="submit" class="filter-button">Filter</button>
        </form>
    </div>

    <div>
        <?php
        session_start();
        echo "<div>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</div>";
        echo "<a class='logout-link' href='logout.php'>Logout</a>";
        echo "<h1>Get Online Rackets</h1>";

        include 'condb.php';

        // Construct SQL query based on filters
        $sql = "SELECT * FROM producttbl WHERE 1=1";

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $sql .= " AND pname LIKE :search";
        }
        if (isset($_GET['price_range']) && $_GET['price_range'] != '') {
            switch ($_GET['price_range']) {
                case '0-20':
                    $sql .= " AND pprice < 20";
                    break;
                case '20-40':
                    $sql .= " AND pprice BETWEEN 20 AND 40";
                    break;
                case '40-60':
                    $sql .= " AND pprice BETWEEN 40 AND 60";
                    break;
                case '60-80':
                    $sql .= " AND pprice BETWEEN 60 AND 80";
                    break;
                case '80-100':
                    $sql .= " AND pprice BETWEEN 80 AND 100";
                    break;
                case '100+':
                    $sql .= " AND pprice > 100";
                    break;
            }
        }

        try {
            // Prepare and execute the query
            $stmt = $conn->prepare($sql);

            if (isset($_GET['search']) && $_GET['search'] != '') {
                $stmt->bindValue(':search', '%' . $_GET['search'] . '%');
            }

            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $n = $stmt->rowCount();

            if ($n > 0) {
                echo "<table>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Price (OMR)</th>";
                echo "<th>Picture</th>";
                echo "<th class='action-column'>Action</th>";
                echo "</tr>";

                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['pname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['pprice']) . " OMR</td>";
                    echo "<td><a href='" . htmlspecialchars($row['pic']) . "'><img src='" . htmlspecialchars($row['pic']) . "' alt='Product Image'/></a></td>";
                    echo "<td class='action-column'><a class='buy-link' href='Cart.php?id=" . htmlspecialchars($row['pid']) . "'>Buy</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No products found matching your criteria.</p>";
            }
        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
</body>
</html>
