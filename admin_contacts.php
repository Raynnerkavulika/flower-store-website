<?php 
include 'config.php';

session_start();

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];

  $delete_message = mysqli_query($conn,"DELETE FROM `message` WHERE id = '$delete_id'");
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin contacts</title>

  <!-- custom css file -->
  <link rel="stylesheet" href="style.css">

<!-- font awesome cdn link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
     
<!-- admin header -->

<?php include 'admin_header.php'; ?>


<section class="placed-orders">
   <h3 class="title">messages</h3>

   <div class="box-container">
    <?php
      $select_message = mysqli_query($conn,"SELECT * FROM `message`");
      if(mysqli_num_rows($select_message)>0){
        while($fetch_message = mysqli_fetch_assoc($select_message)){
    ?>
        <div class="box">
          <p>user id: <span><?php echo $fetch_message['id'];?></span></p>
          <p>user name: <span><?php echo $fetch_message['name'];?></span></p>
          <p>email: <span><?php echo $fetch_message['email'];?></span></p>
          <p>number: <span><?php echo $fetch_message['number'];?></span></p>
          <p>message: <span><?php echo $fetch_message['message'];?></span></p>
          <a href="admin_contacts.php?delete=<?php echo $fetch_message['id'];?>" onclick="return confirm('Are you sure you want to delete this message?');" class="delete-btn">delete</a>
        </div>
    <?php
        }
      }else{
        echo'<p class="empty">you have no messages yet!</p>';
      }
    ?>
   </div>
  </section>
</body>
</html>