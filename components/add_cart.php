<?php

// Check if the 'add_to_cart' POST variable is set
if(isset($_POST['add_to_cart'])){

   // If the user is not logged in, redirect to the login page
   if($user_id == ''){
      header('location:login.php');
   }else{

      // Retrieve and sanitize product details from the POST request
      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $qty = $_POST['qty'];
      $qty = filter_var($qty, FILTER_SANITIZE_STRING);

      // Check if the product is already in the user's cart
      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      // If the product is already in the cart, add a message indicating this
      if($check_cart_numbers->rowCount() > 0){
         $message[] = 'Already added to cart!';
      }else{
         // Otherwise, insert the product into the cart
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
         $message[] = 'Added to cart!';
      }

   }

}

?>
