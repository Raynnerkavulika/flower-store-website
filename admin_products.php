<?php 
include 'config.php';

session_start();

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];

    $select_delete_image = mysqli_query($conn,"SELECT image FROM `products` WHERE id = '$delete_id'");
    $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
    unlink('uploaded_img/'.$fetch_delete_image['image']);
    $delete_products = mysqli_query($conn,"DELETE FROM `products` WHERE id = '$delete_id'");
    $delete_wishlist = mysqli_query($conn,"DELETE FROM `wishlist` WHERE pid = '$delete_id'");
    $delete_cart = mysqli_query($conn,"DELETE FROM `cart` WHERE pid = '$delete_id'");
};

if(isset($_POST['add_product'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $details = mysqli_real_escape_string($conn,$_POST['details']);
    $price = mysqli_real_escape_string($conn,$_POST['price']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;

    $select_product = mysqli_query($conn,"SELECT * FROM `products` WHERE name = '$name'");

    if(mysqli_num_rows($select_product)>0){
        $message[] = 'product name already exist';
    }else{
        $insert_product = mysqli_query($conn,"INSERT INTO `products`(name,details,price,image) VALUES('$name','$details','$price','$image')");
        if($insert_product){
            if($image_size>2000000){
                $message[] = "image size is too large";
            }else{
                move_uploaded_file($image_tmp_name,$image_folder);
                $message[] = "new product has been added successfully";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin products</title>

  <!-- custom css file -->
  <link rel="stylesheet" href="style.css">

<!-- font awesome cdn link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
     
<!-- admin header -->

<?php include 'admin_header.php'; ?>


<section class="add-product">


    <form action="" method="post" enctype="multipart/form-data">
        <h3>add new product</h3>
        <input type="text" placeholder="enter product name" name="name" class="box" required>
        <input type="number" placeholder="enter product price" name="price" class="box" required>
        <textarea name="details" class="box" placeholder="enter product details"></textarea>
        <input type="file" name="image" class="box" accept="image/jpg,image/jpeg,image/png">
        <input type="submit" class="btn" name="add_product" value="add product">
    </form>
</section>

<section class="show-products">
      <h3 class="title">added products</h3>
  <div class="box-container">
    <?php 
        $show_product = mysqli_query($conn,"SELECT * FROM `products`");
        if(mysqli_num_rows($show_product)>0){
            while($fetch_product = mysqli_fetch_assoc($show_product)){
        ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="price">Sh <?php echo $fetch_product['price'];?></div>
                <img src="uploaded_img/<?php echo $fetch_product['image'];?>" alt="">
                <div class="name"><?php echo $fetch_product['name'];?></div>
                <div class="details"><?php echo $fetch_product['details'];?></div>
                <div class="flex-btn">
                    <a href="admin_update_product.php?update=<?php echo $fetch_product['id'];?>" class="option-btn">update</a>
                    <a href="admin_products.php?delete=<?php echo $fetch_product['id'];?>" onclick="return confirm('Are you sure you want to delete this product?');" class="delete-btn">delete</a>
                </div>
            </form>
        <?php 
            }
            }else{
            echo'<p class="empty">no product has been added yet!</p>';
            }
        ?>
  </div>
     
</section>
</body>
</html>