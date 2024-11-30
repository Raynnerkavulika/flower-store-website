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
    <title>home</title>

  <!-- custom css file -->
  <link rel="stylesheet" href="style.css">

<!-- font awesome cdn link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
     
<!-- admin header begins-->

<?php include 'header.php'; ?>

<!-- admin header ends-->

<section class="home">
  <div class="content">
    <h3>new collections</h3>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed sapiente odio, debitis ex excepturi modi harum 
      deleniti deserunt provident velit repellat sequi quod nobis consequatur. Autem quasi laudantium earum magni! Asperiores sapiente ad alias aliquam. Sed, libero exercitationem.</p>
    <a href="shop.php" class="btn">discover more</a>
  </div>
</section>

<section class="added-products">
   <h3 class="title">latest products</h3>
    
   <div class="box-container">
      <?php 
         $select_product = mysqli_query($conn,"SELECT * FROM `products`LIMIT 6");
         if(mysqli_num_rows($select_product) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_product)){        
      ?>
         <form action="" method="post" enctype="multipart/form-data">
          <a href="view_page.php?pid=<?php echo $fetch_product['id'];?>" class="fas fa-eye"></a>
          <div class="price">Sh <?php echo $fetch_product['price'];?>/-</div>
          <img src="uploaded_img/<?php echo $fetch_product['image'];?>" alt="">
          <div class="name"><?php echo $fetch_product['name'];?></div>
          <div class="details"><?php echo $fetch_product['details'];?></div>
          <input type="number" min="1" class="p_qty" name="p_qty">
          <input type="hidden" name="p_name" value="<?php echo $fetch_product['name'];?>">
          <input type="hidden" name="p_price" value="<?php echo $fetch_product['price'];?>">
          <input type="hidden" name="p_image" value="<?php echo $fetch_product['image'];?>">
          <input type="hidden" name="pid" value="<?php echo $fetch_product['id'];?>">
          <input type="submit" class="option-btn" name="add_to_wishlist" value="add to wishlist">
          <input type="submit" class="btn" name="add_to_cart" value="add to cart">
         </form>
      <?php 
          }
        }else{
          echo '<p class="empty">no products has been added yet!</p>';
        }
      ?>
   </div>
</section>






<?php include 'footer.php'; ?>
</body>
</html>