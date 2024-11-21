<!DOCTYPE html>
<html>
<head>
    <title>Customer Review Page</title>
    <link rel="stylesheet" href="review.css" media="all"/>
</head>
<body>
    <!-- Header Section -->
    <header>
    
    <div id="navbar">
            <ul id="menu">
            <li>
    <a href="index.php">
        <span class="icon">&#127968;</span> Home
    </a>
</li>
<li>
    <a href="all_products.php">
        <span class="icon">&#128083;</span> All products
    </a>
</li>
<li>
    <a href="customer/my_account.php">
        <span class="icon">&#128101;</span> My Account
    </a>
</li>
<li>
    <a href="customer_register.php">
        <span class="icon">&#128100;</span> Sign Up
    </a>
</li>
<li>
    <a href="cart.php">
        <span class="icon">&#128722;</span> Shopping Cart
    </a>
</li>
<li>
    <a href="review.php">
        <span class="icon">&#128073;</span> Review
    </a>
</li>
</ul>
       
    </header>

    <title>Customer Review Page</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <h1>Customer Reviews</h1>
    </header>

    <!-- Customer Review Section -->
    <section class="customer-reviews">
        <div class="container">
            <h2>Leave a Review</h2>
            <form action="submit_review.php" method="post" id="reviewForm">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="rating">Rating:</label>
                <select id="rating" name="rating" required>
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>

                <label for="review">Review:</label>
                <textarea id="review" name="review" rows="4" required></textarea>

                <button type="submit" id="submitButton">Submit Review</button>
            </form>

            <!-- Success message container -->
            <div id="successMessage" style="display: none;">
                <p>Review submitted successfully! Thank you so much!</p>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const reviewForm = document.getElementById("reviewForm");
            const successMessage = document.getElementById("successMessage");

            reviewForm.addEventListener("submit", function (event) {
                event.preventDefault();

        
                if (true) {
                    reviewForm.style.display = "none";
                    successMessage.style.display = "block"; 
                }
            });
        });
    </script>
        <section class="customer-reviews">
        <div class="container">
            <h2>Customer Reviews</h2>
            <div class="review">
                <div class="reviewer-info">
                    <img src="images/customer1.jpg" alt="Customer 1">
                    <p><strong>Sam Lobo</strong></p>
                </div>
                <div class="review-content">
                    <p>Excellent eyewear collection! I found the perfect pair of glasses for me. The quality is outstanding, and the prices are reasonable. I highly recommend this store.</p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div>
                </div>
            </div>
            <div class="review">
                <div class="reviewer-info">
                    <img src="images/customer2.jpg" alt="Customer 2">
                    <p><strong>Suraj Kajuvedi</strong></p>
                </div>
                <div class="review-content">
                    <p>I had a fantastic shopping experience here. The website is user-friendly, the delivery was quick, and the eyeglasses are stylish. I'll definitely shop here again.</p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
            </div>
            <!-- Add more reviews as needed -->
        </div>
    </section>
</body>
</html>

  

