<?php 
include 'config.php';

session_start();

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];

  $delete_users = mysqli_query($conn,"DELETE FROM `users` WHERE id = '$delete_id'");
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin users</title>

  <!-- custom css file -->
  <link rel="stylesheet" href="style.css">

<!-- font awesome cdn link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
     
<!-- admin header -->

<?php include 'admin_header.php'; ?>


<section class="user-accounts">
   <h3 class="title">user accounts</h3>

   <div class="box-container">
    <?php
      $select_users = mysqli_query($conn,"SELECT * FROM `users`");
      if(mysqli_num_rows($select_users)>0){
        while($fetch_users = mysqli_fetch_assoc($select_users)){
    ?>
        <div class="box">
          <p>user id: <span><?php echo $fetch_users['id'];?></span></p>
          <p>user name: <span><?php echo $fetch_users['name'];?></span></p>
          <p>email: <span><?php echo $fetch_users['email'];?></span></p>
          <p>user type: <span><?php echo $fetch_users['user_type'];?></span></p>
          <a href="admin_users.php?delete=<?php echo $fetch_users['id'];?>" onclick="return confirm('Are you sure you want to delete this user?');" class="delete-btn">delete</a>
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