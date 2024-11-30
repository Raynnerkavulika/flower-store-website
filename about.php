<?php 
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
  header('location:login.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about page</title>

  <!-- custom css file -->
  <link rel="stylesheet" href="style.css">

<!-- font awesome cdn link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
     
<!-- admin header -->

<?php include 'header.php'; ?>


<section class="about">
  <div class="flex">
    <div class="image">
      <img src="images/about-img-1.png" alt="">
    </div>
     
    <div class="content">
      <h3>why choose us</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id possimus culpa quo iste pariatur hic expedita quasi officia fugit non.</p>
      <a href="shop.php">shop</a>
    </div>
  </div>
</section>








<?php include 'footer.php'; ?>
</body>
</html>