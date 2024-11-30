<?php 
include 'config.php';

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>

  <!-- custom css file -->
  <link rel="stylesheet" href="style.css">

<!-- font awesome cdn link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
     
<!-- admin header -->

<?php include 'admin_header.php'; ?>


<!-- dashboard starts -->
 <section class="dashboard">
    <h3 class="title">dashboard</h3>
    <div class="box-container">
         <div class="box">
            <?php 
              $total_pending = 0;
              $select_pending_orders = mysqli_query($conn,"SELECT * FROM `orders` WHERE payment_status = 'pending'");
              while($fetch_pending_orders = mysqli_fetch_assoc($select_pending_orders)){
                $total_pending += $fetch_pending_orders['total_price'];
              }
            ?>
            <h3>Sh <?= $total_pending; ?>/-</h3>
            <p>pending payment</p>
         </div>

         <div class="box">
            <?php 
              $total_completed = 0;
              $select_completed_orders = mysqli_query($conn,"SELECT * FROM `orders` WHERE payment_status = 'completed'");
              while($fetch_completed_orders = mysqli_fetch_assoc($select_completed_orders)){
                $total_completed += $fetch_completed_orders['total_price'];
              }
            ?>
            <h3>Sh <?= $total_completed; ?>/-</h3>
            <p>completed payments</p>
         </div>

         <div class="box">
            <?php 
              $select_orders = mysqli_query($conn,"SELECT * FROM `orders`");
              $number_of_orders = mysqli_num_rows($select_orders);
            ?>
            <h3><?= $number_of_orders; ?></h3>
            <p>orders placed</p>
         </div>

         <div class="box">
            <?php 
              $select_products = mysqli_query($conn,"SELECT * FROM `products`");
              $number_of_products = mysqli_num_rows($select_products);
            ?>
            <h3><?= $number_of_products; ?></h3>
            <p>products added</p>
         </div>

         <div class="box">
            <?php 
              $select_users = mysqli_query($conn,"SELECT * FROM `users` WHERE user_type = 'user'");
              $number_of_users = mysqli_num_rows($select_users);
            ?>
            <h3><?= $number_of_orders; ?></h3>
            <p>normal users</p>
         </div>

         <div class="box">
            <?php 
              $select_admin = mysqli_query($conn,"SELECT * FROM `users` WHERE user_type = 'admin'");
              $number_of_admin = mysqli_num_rows($select_admin);
            ?>
            <h3><?= $number_of_admin; ?></h3>
            <p>total admins</p>
         </div>

         <div class="box">
            <?php 
              $select_accounts = mysqli_query($conn,"SELECT * FROM `users`");
              $number_of_accounts = mysqli_num_rows($select_accounts);
            ?>
            <h3><?= $number_of_accounts; ?></h3>
            <p>total accounts</p>
         </div>

         <div class="box">
            <?php 
              $select_messages = mysqli_query($conn,"SELECT * FROM `message`");
              $number_of_messages = mysqli_num_rows($select_messages);
            ?>
            <h3><?= $number_of_messages; ?></h3>
            <p>new messages</p>
         </div>

    </div>
 </section>
</body>
</html>