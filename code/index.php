<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: signin.html");
    exit();
}

// Check if the user clicked the "Add to Cart" button
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Get the product details from the form
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $price = $_POST['price'];

    // Initialize or retrieve the user's cart from the session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add the product to the cart
    $_SESSION['cart'][] = array('id' => $productId, 'name' => $productName, 'price' => $price);
}

// Display the cart items
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="style.css">
    <!-- Header Section -->
    <?php
    if (isset($_SESSION['username'])) {
        echo '<div style="display: flex; justify-content: space-between;">';
        echo '<p style="text-align: center; margin: 0;">Welcome, ' . $_SESSION['username'] . '!</p>';
        echo '<p style="text-align: right; margin: 0;"><a href="logout.php">Logout</a></p>';
        echo '</div>';
    }
    ?>
</head>

<body>

    <header>
        <h1>E-Commerce</h1>
    </header>

    <nav>
        <a href="#">Home</a>
        <a href="#contact">Contact</a>
        <a href="cart.php">Cart</a>
        <a href="signup.html">Signup</a>
        <a href="signin.html">Signin</a>
    </nav>

    <section>
        <!-- Product 1 -->
        <div class="product">
            <img src=pic1.jpg alt="Product 1">
            <h2>Product 1</h2>
            <p>ANKER Soundcore R50i True Wireless in-Ear Earbuds, TWS with 30H+ Playtime, Clear Calls & High Bass...

                </p>
            <p>Rs 1899</p>
            <form action="index.php" method="post">
                <input type="hidden" name="product_id" value="1">
                <input type="hidden" name="product_name" value="Product 1">
                <input type="hidden" name="price" value="1899">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Repeat the above product block for each product -->

        <!-- Product 2 -->
        <div class="product">
            <img src=pic2.jpg alt="Product 2">
            <h2>Product 2</h2>
            <p>Boult Audio Z60 Truly Wireless in Ear Earbuds with 60H Playtime, 4 Mics ENC Clear Calling 50ms Low Latency..
                
                </p>
            <p>Rs 1200</p>
            <form action="index.php" method="post">
                <input type="hidden" name="product_id" value="2">
                <input type="hidden" name="product_name" value="Product 2">
                <input type="hidden" name="price" value="1200">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Repeat the above product block for each product -->

        <!-- Product 3 -->
        <div class="product">
            <img src="pic3.jpeg" alt="Product 3">
            <h2>Product 3</h2>
            <p>OnePlus Nord Buds 2 TWS in Ear Earbuds with Mic,Upto 25dB ANC 12.4mm Dynamic Titanium Drivers ...

            </p>
            <p>Rs 2499</p>
            <form action="index.php" method="post">
                <input type="hidden" name="product_id" value="3">
                <input type="hidden" name="product_name" value="Product 3">
                <input type="hidden" name="price" value="2499">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Repeat the above product block for each product -->

        <!-- Product 4 -->
        <div class="product">
            <img src="pic4.jpeg" alt="Product 4">
            <h2>Product 4</h2>
            <p>realme Buds T300 Truly Wireless in-Ear Earbuds with 30dB ANC, 360° Spatial Audio Effect... </p>
            <p>Rs 2099</p>
            <form action="index.php" method="post">
                <input type="hidden" name="product_id" value="4">
                <input type="hidden" name="product_name" value="Product 4">
                <input type="hidden" name="price" value="2099">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Repeat the above product block for each product -->

        <!-- Product 5 -->
        <div class="product">
            <img src="pic5.jpeg" alt="Product 5">
            <h2>Product 5</h2>
            <p>boAt Airdopes 141 Bluetooth TWS Earbuds with 42H Playtime,Low Latency Mode for Gaming ...

            </p>
            <p>Rs 1299</p>
            <form action="index.php" method="post">
                <input type="hidden" name="product_id" value="5">
                <input type="hidden" name="product_name" value="Product 5">
                <input type="hidden" name="price" value="1299">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Repeat the above product block for each product -->

        <!-- Product 6 -->
        <div class="product">
            <img src="pic6.jpeg" alt="Product 6">
            <h2>Product 6</h2>
            <p>realme TechLife Buds T100 Bluetooth Truly Wireless in Ear Earbuds with mic, AI ENC ..

            </p>
            <p>Rs 1399</p>
            <form action="index.php" method="post">
                <input type="hidden" name="product_id" value="6">
                <input type="hidden" name="product_name" value="Product 6">
                <input type="hidden" name="price" value="1399">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Repeat the above product block for each product -->

        <!-- Product 7 -->
        <div class="product">
            <img src="pic7.jpeg" alt="Product 7">
            <h2>Product 7</h2>
            <p>Noise Buds VS106 Truly Wireless in-Ear Earbuds with 50H Playtime, Quad Mic with ENC...

            </p>
            <p>Rs 1200</p>
            <form action="index.php" method="post">
                <input type="hidden" name="product_id" value="7">
                <input type="hidden" name="product_name" value="Product 7">
                <input type="hidden" name="price" value="1200">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Repeat the above product block for each product -->

        <!-- Product 8 -->
        <div class="product">
            <img src="pic8.jpeg" alt="Product 8">
            <h2>Product 8</h2>
            <p>Boult Audio X30 True Wireless in Ear Earbuds with 40H Playtime, Quad Mic ENC ...

            </p>
            <p>Rs 1299</p>
            <form action="index.php" method="post">
                <input type="hidden" name="product_id" value="8">
                <input type="hidden" name="product_name" value="Product 8">
                <input type="hidden" name="price" value="1299">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Repeat the above product block for each product -->

        <!-- Product 9 -->
        <div class="product">
            <img src="pic9.jpeg" alt="Product 9">
            <h2>Product 9</h2>
            <p>Noise Newly Launched Aura Buds in-Ear Truly Wireless Earbuds with 60H of Playtime ..

            </p>
            <p>Rs 1599</p>
            <form action="index.php" method="post">
                <input type="hidden" name="product_id" value="9">
                <input type="hidden" name="product_name" value="Product 9">
                <input type="hidden" name="price" value="1599">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Repeat the above product block for each product -->

        <!-- Product 10 -->
        <div class="product">
            <img src="pic10.jpeg" alt="Product 10">
            <h2>Product 10</h2>
            <p>Blaupunkt Btw100 Khrome Bassbuds Truly Wireless Bluetooth Earbuds I Hd Sound I Gaming ...

            </p>
            <p>RS 1199</p>
            <form action="index.php" method="post">
                <input type="hidden" name="product_id" value="10">
                <input type="hidden" name="product_name" value="Product 10">
                <input type="hidden" name="price" value="1199">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>

        <!-- Repeat the above product block for each product -->

    </section>

    <footer>
        <p>&copy; 2023 Simple E-Commerce. All rights reserved.</p>
        <section id="contact">
            <p>Contact us at: <a href="mailto:ecommerce@example.com">ecommerce@example.com</a> | Phone: +9741592013</p>
        </section>
    </footer>

</body>

</html>
