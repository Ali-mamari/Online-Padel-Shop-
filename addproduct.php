<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
            max-width: 600px;
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
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
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

        /* Image preview styling */
        .image-preview {
            margin-top: 15px;
            text-align: center;
        }

        img {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Error message */
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Add Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Product Name</label>
        <input type="text" name="pname" required>
        
        <label>Product Price</label>
        <input type="number" name="pprice" required>
        
        <label>Product Picture</label>
        <input type="file" name="img" accept="image/*" required>
        
        <label>Product Quantity</label>
        <input type="number" name="pqty" required>
        
        <input type="submit" name="sb" value="Save">
    </form>
</div>

<!-- Optional image preview (you can enhance this if you want to show an image preview before submitting) -->
<div class="image-preview" id="imagePreview"></div>

<?php
// Check if form is submitted
if (isset($_POST['sb'])) {
    // Check if all fields are filled
    if (!empty($_POST['pname']) && !empty($_POST['pprice']) && !empty($_POST['pqty'])) {
        // File upload
        $filename = $_FILES['img']['name'];
        $filetemp = $_FILES['img']['tmp_name'];
        $folder = "pics/" . $filename;
        move_uploaded_file($filetemp, $folder);

        // Database connection
        include 'condb.php';

        // Insert data into database
        $sql = "INSERT INTO producttbl (pname, pprice, pic, qty) VALUES (:a, :b, :c, :d)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':a' => $_POST['pname'],
            ':b' => $_POST['pprice'],
            ':c' => $folder,
            ':d' => $_POST['pqty']
        ));

        // Redirect after successful insertion
        header("Location: adminviewproduct.php");
        exit(); // Ensure script stops here after redirection
    } else {
        echo "<p class='error'>Please fill all the fields</p>";
    }
}
?>



</body>
</html>
