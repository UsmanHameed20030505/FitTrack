<?php

// Include the database connection file
include '../components/connect.php';

// Start the session
session_start();

// Get the admin ID from the session
$admin_id = $_SESSION['admin_id'];

// Check if the admin ID is not set, redirect to the login page
if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- Font Awesome CDN link for icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php 
// Include the admin header component
include '../components/admin_header.php' 
?>

<!-- Admin dashboard section starts -->
<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <!-- Welcome box -->
   <div class="box">
      <h3>welcome!</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update_profile.php" class="btn">update profile</a>
   </div>

   <!-- Total pendings box -->
   <div class="box">
      <?php
         // Initialize total pendings to 0
         $total_pendings = 0;
         // Prepare and execute the select query for pending orders
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         // Calculate total pending amount
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         }
      ?>
      <h3><span>$</span><?= $total_pendings; ?><span>/-</span></h3>
      <p>total pendings</p>
      <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <!-- Total completes box -->
   <div class="box">
      <?php
         // Initialize total completes to 0
         $total_completes = 0;
         // Prepare and execute the select query for completed orders
         $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completes->execute(['completed']);
         // Calculate total completed amount
         while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
            $total_completes += $fetch_completes['total_price'];
         }
      ?>
      <h3><span>$</span><?= $total_completes; ?><span>/-</span></h3>
      <p>total completes</p>
      <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <!-- Total orders box -->
   <div class="box">
      <?php
         // Prepare and execute the select query for all orders
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         // Get the total number of orders
         $numbers_of_orders = $select_orders->rowCount();
      ?>
      <h3><?= $numbers_of_orders; ?></h3>
      <p>total orders</p>
      <a href="placed_orders.php" class="btn">see orders</a>
   </div>

   <!-- Total products box -->
   <div class="box">
      <?php
         // Prepare and execute the select query for all products
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         // Get the total number of products
         $numbers_of_products = $select_products->rowCount();
      ?>
      <h3><?= $numbers_of_products; ?></h3>
      <p>products added</p>
      <a href="products.php" class="btn">see products</a>
   </div>

   <!-- Total users box -->
   <div class="box">
      <?php
         // Prepare and execute the select query for all users
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         // Get the total number of users
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h3><?= $numbers_of_users; ?></h3>
      <p>users accounts</p>
      <a href="users_accounts.php" class="btn">see users</a>
   </div>

   <!-- Total admins box -->
   <div class="box">
      <?php
         // Prepare and execute the select query for all admins
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         // Get the total number of admins
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
      <p>admins</p>
      <a href="admin_accounts.php" class="btn">see admins</a>
   </div>

   <!-- Total messages box -->
   <div class="box">
      <?php
         // Prepare and execute the select query for all messages
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         // Get the total number of messages
         $numbers_of_messages = $select_messages->rowCount();
      ?>
      <h3><?= $numbers_of_messages; ?></h3>
      <p>new messages</p>
      <a href="messages.php" class="btn">see messages</a>
   </div>

   </div>

</section>
<!-- Admin dashboard section ends -->

<!-- Custom JS file link -->
<script src="../js/admin_script.js"></script>

</body>
</html>
