<?php 
include 'config.php';

session_start();

if(isset($_POST['submit'])){
   
    $filter_email =filter_var($_POST['email'],FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn,$filter_email);
    $filter_pass = filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn,$filter_pass);


    $select_user = mysqli_query($conn,"SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'");
     
    if(mysqli_num_rows($select_user) > 0){
        
        $row = mysqli_fetch_assoc( $select_user);

        if($row['user_type'] == 'admin'){

            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            header('location:admin_page.php');

        }elseif($row['user_type'] == 'user'){

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            header('location:home.php');

        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- custom css file -->
    <link rel="stylesheet" href="style.css">

<!-- font awesome cdn link -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
<?php 
      if(isset($message)){
        foreach($message as $message){
            echo'
            <div class="message">
                <span>'.$message.'</span>
            </div>
            ';
        }
      }
    ?>
    <section class="form-container">
        <form action="" method="post">
            <h3>login to flower store</h3>
            <input type="email" name="email" class="box" required placeholder="enter your email">
            <input type="password" name="pass" class="box" required placeholder="enter your password">
            <input type="submit" name="submit" class="btn" value="login now">
            <p>don't have an account? <a href="register.php">register now</a></p>
        </form>
    </section>
</body>
</html>