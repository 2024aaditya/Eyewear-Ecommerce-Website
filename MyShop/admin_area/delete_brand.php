<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Brand</title>
    <link rel="stylesheet" href="brand.css">
</head>
<body>
    <div class="delete-brand-container">
        <h1>Delete Brand</h1>
        <!-- Your delete brand form goes here -->

        <!-- Display the alert message after deletion -->
        <div class="alert">
            <?php
                if (isset($_GET['delete_brand'])) {
                    echo "One brand has been deleted. <a href='index.php?view_brands'>View Brands</a>";
                }
            ?>
        </div>
    </div>
</body>
</html>
