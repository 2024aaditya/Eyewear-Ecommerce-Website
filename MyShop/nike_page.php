<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Nike</title>
    <!-- Include Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .swiper-container {
            width: 100%;
            height: 80vh;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .image {
            max-width: 100%;
            max-height: 60vh;
            object-fit: contain;
            border: 2px solid #fff;
            border-radius: 10px;
        }

        .rating {
            margin-top: 20px;
            font-size: 24px;
            color: #333;
        }

        .star-rating {
            color: #ffcc00;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #333;
            background-color: #ffcc00;
            border-radius: 50%;
            font-size: 24px;
            width: 40px;
            height: 40px;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: #ff9900;
        }
    </style>
</head>
<body>
    <nav>
        <!-- Your navigation menu here -->
    </nav>
    <div class="welcome-text" style="text-align: center; padding: 20px;">
    <h1 style="font-size: 36px; color: #333;">Welcome to</h1>
    <h2 style="font-size: 48px; color: #f00; font-weight: bold;">Nike Brands Goggles</h2>
    <p style="font-size: 20px; color: #666;">Discover the latest in eyewear fashion</p>
</div>


    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img class="image" src="nike/1.jpg" alt="Image 1">
                <p class="rating">Rating: <span class="star-rating">★★★★☆☆</span></p>
            </div>
            <div class="swiper-slide">
                <img class="image" src="nike/31mesLWf7hL.jpg" alt="Image 2">
                <p class="rating">Rating: <span class="star-rating">★★★★☆☆</span></p>
            </div>
            <div class="swiper-slide">
                <img class="image" src="nike/51+00yVlomL._SX522_.jpg" alt="Image 3">
                <p class="rating">Rating: <span class="star-rating">★★★★☆☆</span></p>
            </div>
            <div class="swiper-slide">
                <img class="image" src="nike/51cZg2xtHjL._SX522_.jpg" alt="Image 4">
                <p class="rating">Rating: <span class="star-rating">★★★★☆☆</span></p>
            </div>
            <div class="swiper-slide">
                <img class="image" src="nike/51d1ZHoNCnL._SX679_.jpg" alt="Image 5">
                <p class="rating">Rating: <span class="star-rating">★★★★☆☆</span></p>
            </div>
            <div class="swiper-slide">
                <img class="image" src="nike/61B-BUD8xwL._SX522_.jpg" alt="Image 6">
                <p class="rating">Rating: <span class="star-rating">★★★★☆☆</span></p>
            </div>
            <div class="swiper-slide">
                <img class="image" src="nike/51XrOYWEw9L._SX522_.jpg" alt="Image 7">
                <p class="rating">Rating: <span class="star-rating">★★★★☆☆</span></p>
            </div>
            <div class="swiper-slide">
                <img class="image" src="nike/8.jpg" alt="Image 8">
                <p class="rating">Rating: <span class="star-rating">★★★★☆☆</span></p>
            </div>
            <div class="swiper-slide">
                <img class="image" src="nike/51uchN8srtL._SX522_.jpg" alt="Image 9">
                <p class="rating">Rating: <span class="star-rating">★★★★☆☆</span></p>
            </div>
            <div class="swiper-slide">
                <img class="image" src="nike/10.jpg" alt="Image 10">
                <p class="rating">Rating: <span class="star-rating">★★★★☆☆</span></p>
            </div>
        </div>
    </div>
           <!-- Navigation controls -->
           <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

</body>
</html>