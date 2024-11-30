<?php 
include 'config.php';

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin update products</title>

  <!-- custom css file -->
  <link rel="stylesheet" href="style.css">

<!-- font awesome cdn link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
     
<!-- admin header -->

<?php include 'admin_header.php'; ?>

<section class="update-products">
  <h3 class="title">update products</h3>

    <?php  
     $update_id = $_GET['update'];
       $select_product = mysqli_query($conn,"SELECT * FROM `products` WHERE id = '$update_id'");
       if(mysqli_num_rows($select_product)>0){
          while($fetch_product = mysqli_fetch_assoc($select_product)){     
    ?>
        <form action="" method="post" enctype="multipart/form-data">
              <img src="uploaded_img/<?php echo $fetch_product['image'];?>" alt="">
              <input type="name" value="<?php echo $fetch_product['name'];?>" name="name" class="box" required>
              <input type="number" value="<?php echo $fetch_product['price'];?>" name="price" class="box" required>
              <textarea name="details" class="box"><?php echo $fetch_product['details'];?></textarea>
              <input type="file" name="image" class="box" accept="image/jpg,image/jpeg,image/png">
              <div class="flex-btn">
                 <input type="submit" class="btn" name="update" value="update">
                 <a href="admin_products.php" class="option-btn">go back</a>
              </div>
          </form>
    <?php 
    }
  }else{
   echo'<p class="empty">no product added yet</p>';
  }    
    ?>
 
</section>

</body>
</html>