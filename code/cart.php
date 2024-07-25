<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: signin.html");
    exit();
}


        if (isset($_GET['order_placed']) && $_GET['order_placed'] == 'true') {
            echo '<p class="confirmation-message">Order placed successfully! Thank you for shopping with us.</p>';
        }
// Check if the user clicked the "Remove" button
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_item'])) {
    // Get the index of the item to be removed
    $index = $_POST['item_index'];

    // Remove the item from the cart array
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        // Reset the array keys to avoid gaps
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .product {
            width: 18%;
            margin: 1%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .product img {
            max-width: 100%;
            height: auto;
        }

        .confirmation-message {
            color: green;
            text-align: center;
        }

        .place-order-button {
            text-align: center;
            margin-top: 20px;
        }

        .total-amount {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <header>
        <h1>E-Commerce</h1>

        <?php
        if (isset($_SESSION['username'])) {
            echo '<p>Welcome, ' . $_SESSION['username'] . '!</p>';
            echo '<p><a href="logout.php">Logout</a></p>';
        }
        ?>
    </header>

    <nav>
        <a href="index.php">Home</a>
    </nav>

    <h2 style="text-align: center;">Your Cart</h2>

    <div class="container">
        <?php
        // Display the products in the cart
        $totalQuantity = 0;
        $totalAmount = 0;

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $index => $product) {
                echo '<div class="product">';
                echo '<h3>' . $product['name'] . '</h3>';
                echo '<p>Price: '.'Rs' . $product['price'] . '</p>';
                // Add a form with a hidden input to store the index of the item to be removed
                echo '<form action="cart.php" method="post">';
                echo '<input type="hidden" name="item_index" value="' . $index . '">';
                echo '<input type="submit" name="remove_item" value="Remove">';
                echo '</form>';
                echo '</div>';

                $totalQuantity += 1; // Increment quantity by 1 for each product
                $totalAmount += (float)$product['price']; // Ensure $product['price'] is treated as a float
            }
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>
    </div>

    <div class="total-amount">
        <p>Total Amount: Rs<?php echo $totalAmount; ?></p>
    </div>

   <!-- Add a form to collect data and submit to process.php -->
<div class="place-order-button">
    <form action="process.php" method="post">
        <input type="hidden" name="action" value="place-order">

        <!-- Include user_id, total amount, and any other required data as hidden inputs -->
        <?php
        // Assuming you set $_SESSION['user_id'] somewhere after login/signup
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
        ?>
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

        <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">

        <!-- Loop through cart items to include product_id and quantity -->
        <?php foreach ($_SESSION['cart'] as $index => $product): ?>
            <input type="hidden" name="product_id[]" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="quantity[]" value="1">
        <?php endforeach; ?>

        <!-- Add a hidden input for cart_id (assuming it's stored in the user table) -->
        <input type="hidden" name="cart_id" value="<?php echo $_SESSION['cart_id']; ?>">

        <input type="submit" name="place_order" value="Place Order">
        
    </form>
</div>




    <footer>
        <p>&copy; 2023 Simple E-Commerce. All rights reserved.</p>
    </footer>

</body>
</html>
