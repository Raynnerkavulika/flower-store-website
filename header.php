<header class="user-header">
    <div class="user-flex">

        <a href="home.php" class="logo">Rays<span>flowerstore</span></a>

         <nav class="user-navbar">
            <ul>
                <li><a href="home.php">home</a></li>
                <li><a href="#">pages +</a>
                  <ul>
                     <li><a href="about.php">about</a></li>
                     <li><a href="messages.php">contact</a></li>
                  </ul>
                </li>
                <li><a href="shop.php">shop</a></li>
                <li><a href="orders.php">orders</a></li>
                <li><a href="#">accounts +</a>
                  <ul>
                     <li><a href="login.php">login</a></li>
                     <li><a href="register.php">register</a></li>
                  </ul>
                </li>
            </ul>
         </nav>  
         
         <div class="user-icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
              $select_wihlist_count = mysqli_query($conn,"SELECT * FROM `wishlist` WHERE user_id = '$user_id'");
              $fetch_wishlist_count = mysqli_num_rows($select_wihlist_count);
            ?>
            <a href="wishlist.php"><i class="fas fa-heart"></i>(<?php echo $fetch_wishlist_count; ?>)</a>
            <?php
              $select_cart_count = mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id = '$user_id'");
              $fetch_cart_count = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i>(<?php echo $fetch_cart_count; ?>)</a>
         </div>

         <div class="account-box">
            <p>username: <span><?= $_SESSION['user_name']; ?></span></p>
            <p>email: <span><?= $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
        
    </div>
</header>