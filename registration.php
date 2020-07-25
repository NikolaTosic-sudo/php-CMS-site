 <?php  include "includes/header.php"; ?>
    <!-- Navigation -->
    
    <?php  include "includes/navi.php"; ?>

 <?php

 if (isset($_POST['submit'])) {

     $username = escape($_POST['username']);
     $email = escape($_POST['email']);
     $password = escape($_POST['password']);

     if (alreadyExists('username', $username)) {

         echo "<script>alert('Username already exists')</script>";

     } else if (alreadyExists('user_email', $email)) {

         echo "<script>alert('Email already exists')</script>";

     } else {

     if (!empty($username) && !empty($email) && !empty($password)) {

         $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

         $query = "INSERT INTO users (username, user_email, user_password, user_role, user_firstname, user_lastname, user_image) ";
         $query .= "VALUES ('{$username}', '{$email}', '{$password}', 'subscriber', '', '', '')";

         $registrationQuery = mysqli_query($connection, $query);

         if (!$registrationQuery) {

             die("QUERY FAILED" . mysqli_error($connection));

         } else {

             echo "<script>alert('Successfully Registered')</script>";

         }

     } else {

         echo "<script> alert('FIELDS CAN NOT BE EMPTY')</script>";

     }





 }}


 ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
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
