<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "admin/functions.php" ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>

</head>
    <!-- Navigation -->
    
    <?php  include "includes/navi.php"; ?>

 <?php

 if (isset($_POST['submit'])) {

     $username = escape($_POST['username']);
     $email = escape($_POST['email']);
     $password = escape($_POST['password']);
     $repeated_password = escape($_POST['repeated_password']);

     if ($password !== $repeated_password) {

         echo "<script>alert('Passwords have to be equal')</script>";

     } else {


         if (strlen($username) < 4) {

             echo "<script>alert('Username has to be longer than 4 characters')</script>";

         } else {


             if (alreadyExists('username', $username)) {

                 echo "<script>alert('Username already exists')</script>";

             } else if (alreadyExists('user_email', $email)) {

                 echo "<script>alert('Email already exists')</script>";

             } else {

                 if (!empty($username) && !empty($email) && !empty($password)) {

                     $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

                     $stmt = mysqli_prepare($connection, "INSERT INTO users (username, user_email, user_password, user_role, user_firstname, user_lastname, user_image) VALUES (?, ?, ?, ?, '', '', '')");

                     $sub = 'subscriber';

                     mysqli_stmt_bind_param($stmt, 'ssss',$username, $email, $password, $sub);

                     $execute = mysqli_stmt_execute($stmt);

                     if (!$execute) {

                         die("QUERY FAILED" . mysqli_stmt_error($stmt));

                     } else {

                         echo "<script>alert('Successfully Registered')</script>";

                     }

                 } else {

                     echo "<script> alert('FIELDS CAN NOT BE EMPTY')</script>";

                 }





 }}}}


 ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1 class="text-center" style="margin-bottom: 30px; border-bottom: black 1px solid; padding-bottom: 20px">Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" style="font-size: 17px">Enter Desired Username:</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                         <div class="form-group">
                             <label for="email" style="font-size: 17px">Enter Your Email:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                             <label for="password" style="font-size: 17px">Enter Your Password:</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="repeated_password" style="font-size: 17px">Repeat Your Password:</label>
                            <input type="password" name="repeated_password" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
