<?php
include 'db_config.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    if ($action === "place-order") {
        // Retrieve data from the form
        $user_id = $_POST['user_id'];
        $total_amount = $_POST['total_amount'];
        $product_ids = $_POST['product_id'];
        $quantities = $_POST['quantity'];
        $cart_id = $_POST['cart_id'];
    
        // Loop through products and insert into cart table
        for ($i = 0; $i < count($product_ids); $i++) {
            $product_id = $product_ids[$i];
            $quantity = $quantities[$i];

            // Insert data into the cart table
            $sql = "INSERT INTO cart (cart_id, user_id, product_id, quantity) 
                    VALUES ('$cart_id', '$user_id', '$product_id', '$quantity')";
            $conn->query($sql);
        }
    
        // Insert data into the orders table
        $sql = "INSERT INTO orders (user_id, total_amount) 
                VALUES ('$user_id', '$total_amount')";
        $conn->query($sql);
    
        // Additional actions after placing the order, e.g., clear the cart
    
        // Redirect to a confirmation page or wherever you need
        header("Location: cart.php?order_placed=true");
    }else if ($action === "signup") {
        // Handle signup
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Generate a unique cart_id (you can customize this logic based on your requirements)
        $cart_id = mt_rand(100, 999);
    
        // Please note: In a real-world scenario, you should use password_hash here.
    
        $sql = "INSERT INTO users (first_name, last_name, phone_number, address, email, password, cart_id) 
                VALUES ('$first_name', '$last_name', '$phone_number', '$address', '$email', '$password', $cart_id)";
    
        if ($conn->query($sql) === TRUE) {
            // Retrieve the user_id and cart_id after signup
            $user_id = $conn->insert_id;
            $cart_id = $cart_id;  // Use the generated cart_id

            // Store user_id and cart_id in the session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['cart_id'] = $cart_id;

            // Signup successful, set session and redirect to index.php
            $_SESSION['username'] = $first_name; // Assuming you want to use first_name as the username
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }elseif ($action === "signin") {
        // Handle signin
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE first_name='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            // In a real-world scenario, you should use password_verify here.
            if ($password === $row['password']) {
                // Signin successful, set session and redirect to index.php
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['cart_id'] = $row['cart_id'];
                $_SESSION['username'] = $username;
                header("Location: index.php");
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "User not found";
        }
    }elseif ($action === "forgot_password") {
        // Handle forgot password
        $email = $_POST['email'];

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // In a real-world scenario, you'd generate and send a unique token for password reset via email
            echo "Password reset instructions sent to your email.";
        } else {
            echo "Email not found";
        }
    
    }
}

$conn->close();
?>
