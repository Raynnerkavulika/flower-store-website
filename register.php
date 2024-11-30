<?php 
include 'config.php';

if(isset($_POST['submit'])){
    $filter_name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn,$filter_name);
    $filter_email =filter_var($_POST['email'],FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn,$filter_email);
    $filter_pass = filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn,$filter_pass);
    $filter_cpass = filter_var($_POST['cpass'],FILTER_SANITIZE_STRING);
    $cpass = mysqli_real_escape_string($conn,$filter_cpass);

    $select_user = mysqli_query($conn,"SELECT * FROM `users` WHERE email = '$email'");
     
    if(mysqli_num_rows($select_user) > 0){
        $message[] = 'user already exist';
    }else{
        if($pass != $cpass){
            $message[] = 'confirm password does match';
        }else{
           mysqli_query($conn,"INSERT INTO `users`(name,email,password) VALUES('$name','$email','$pass')");
           $message[] = 'You have been registered successfully';
           header('location:login.php');
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

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
            <h3>register on flower store</h3>
            <input type="text" name="name" class="box" required placeholder="enter your name">
            <input type="email" name="email" class="box" required placeholder="enter your email">
            <input type="password" name="pass" class="box" required placeholder="enter your password">
            <input type="password" name="cpass" class="box" required placeholder="confirm your password">
            <input type="submit" name="submit" class="btn" value="register now">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </section>
</body>
</html>