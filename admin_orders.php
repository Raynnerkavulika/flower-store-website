<?php 
include 'config.php';

session_start();

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];

  $delete_orders = mysqli_query($conn,"DELETE FROM `orders` WHERE id = '$delete_id'");
};

if(isset($_POST['update_order'])){
  $order_id = $_POST['order_id'];
  $update_payment = $_POST['update_payment'];

  mysqli_query($conn,"UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_id'");
  $message[] = "order has been updated successfully";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin orders</title>

  <!-- custom css file -->
  <link rel="stylesheet" href="style.css">

<!-- font awesome cdn link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
     
<!-- admin header -->

<?php include 'admin_header.php'; ?>


<section class="placed-orders">
   <h3 class="title">placed orders</h3>

   <div class="box-container">
    <?php
      $select_orders = mysqli_query($conn,"SELECT * FROM `orders`");
      if(mysqli_num_rows($select_orders)>0){
        while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    ?>
        <div class="box">
          <p>user id: <span><?php echo $fetch_orders['id'];?></span></p>
          <p>user name: <span><?php echo $fetch_orders['name'];?></span></p>
          <p>number: <span><?php echo $fetch_orders['number'];?></span></p>
          <p>email: <span><?php echo $fetch_orders['email'];?></span></p>
          <p>payment method: <span><?php echo $fetch_orders['method'];?></span></p>
          <p>address: <span><?php echo $fetch_orders['address'];?></span></p>
          <p>total products: <span><?php echo $fetch_orders['total_products'];?></span></p>
          <p>total price: <span><?php echo $fetch_orders['total_price'];?></span></p>
          <p>placed on: <span><?php echo $fetch_orders['placed_on'];?></span></p>
          <p>payment status: <span><?php echo $fetch_orders['payment_status'];?></span></p>
          <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id'];?>">
            <select name="update_payment" class="drop-down">
              <option value="" selected disabled><?php echo $fetch_orders['payment_status'];?></option>
              <option value="pending">pending</option>
              <option value="completed">completed</option>
            </select>
            <div class="flex-btn">
              <input type="submit" value="update" class="option-btn" name="update_order">
              <a href="admin_ordes.php?delete=<?php echo $fetch_orders['id'];?>" onclick="return confirm('Are you sure you want to delete this order?');" class="delete-btn">delete</a>
            </div>
          </form>
        </div>
    <?php
        }
      }else{
        echo'<p class="empty">no orders have been placed yet!</p>';
      }
    ?>
   </div>
  </section>
</body>
</html>