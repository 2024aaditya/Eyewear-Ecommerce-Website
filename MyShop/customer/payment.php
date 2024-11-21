<!DOCTYPE html>
<html>
<head>
    <title>Net Banking Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fceed1; /* Light gray background for the page */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 800px;
            height: 450px;
            background-color: #e5eaf5; /* White background for the container */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #333333; /* Dark gray color for heading */
        }

        label,
        input[type="text"],
        input[type="submit"] {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #cccccc; /* Light gray border */
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #5252d4; /* Green color for submit button */
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3d7c47; /* Darker green on hover */
        }
    </style>
	<script>
        function validateForm() {
            var cardNumber = document.getElementById("card_number").value;
            var cvv = document.getElementById("cvv").value;
            var expiryDate = document.getElementById("expiry_date").value;

            var cardNumberRegex = /^\d{16}$/;
            var cvvRegex = /^\d{3}$/;
            var expiryDateRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;

            if (!cardNumber.match(cardNumberRegex)) {
                alert("Please enter a valid 16-digit card number.");
                return false;
            }

            if (!cvv.match(cvvRegex)) {
                alert("Please enter a valid 3-digit CVV.");
                return false;
            }

            if (!expiryDate.match(expiryDateRegex)) {
                alert("Please enter a valid expiry date in MM/YY format.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body> 

<div class="container">
    <center><h1>Net Banking Payment</h1>
	<h3 id="changer" style="color:red;">Please Fill the Details Correctly</h3></center>

    <?php
    // PHP code for database connection and data insertion
    $servername = "localhost";
    $username = "root"; // Default username (change this if different)
    $password = ""; // Default password (change this if set)
    $dbname = "myshop"; // Changed database name to myshop

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $card_number = $_POST['card_number'];
        $expiry_date = $_POST['expiry_date'];
        $cvv = $_POST['cvv'];

        $stmt = $conn->prepare("INSERT INTO cardinfo (card_number, card_exp_date, card_cvv) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $card_number, $expiry_date, $cvv);

        if ($stmt->execute()) {
            echo "<script>alert('Card details added to the database successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>

    <!-- Payment form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onSubmit="paymentSuccessful()">
        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" required>

        <label for="expiry_date">Expiry Date:</label>
        <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" required>

        <input type="submit" value="Submit">
    </form>
</div>

<script>
    function paymentSuccessful() {
        alert("Payment successful!")
		let text = "Card Details Are submitted";
		document.getElementById("changer").innerHTML = text;
    }
</script>

</body>
</html>
