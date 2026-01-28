<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thank You</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        text-align: center;
    }
    h1 {
        color: #333;
        margin-bottom: 20px;
    }
    a {
        text-decoration: none;
        color: #4CAF50;
        padding: 5px 10px;
        border: 1px solid #4CAF50;
        border-radius: 3px;
    }
    .review-box {
        background-color: #f9f9f9;
        padding: 20px;
        margin-top: 30px;
        border-radius: 8px;
        border: 1px solid #ddd;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
    .review-box textarea {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
    .review-box select, .review-box input[type="submit"] {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        margin-bottom: 15px;
        border-radius: 4px;
        border: 1px solid #ddd;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }
    .review-box input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>
    <?php
    session_start();
    echo "<h1>Dear " . $_SESSION['username'] . ", Thanks for Shopping</h1>";
    echo "<h1>You will get your Racket within 3 to 5 business days</h1>";
    ?>

    <br>
    <a href='viewproduct.php'>More Shopping</a>
    <br>
    <br>
    <a href='logout.php'>Logout</a>

    <!-- Review Section -->
    <div class="review-box">
        <h2>Leave a Review</h2>
        <form action="" method="post">
            <label for="rating">Rate the Website (1 to 5 stars):</label>
            <select name="rating" id="rating" required>
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>

            <label for="review">Your Review:</label>
            <textarea name="review" id="review" rows="4" placeholder="Write your review here..." required></textarea>

            <input type="submit" name="submit_review" value="Submit Review">
        </form>
		        <a href="homep.php">Click to go to home page</a>
<a href="javascript:history.back()">Go Back</a>

        
        <!-- Displaying the Review after Submission -->
        <?php
        if (isset($_POST['submit_review'])) {
            $rating = $_POST['rating'];
            $review = $_POST['review'];
            echo "<h3>Your Review</h3>";
            echo "<p><strong>Rating:</strong> $rating/5</p>";
            echo "<p><strong>Review:</strong> $review</p>";
        }
        ?>
    </div>

</body>
</html>
