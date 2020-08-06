<?php session_start() ; ?>
<?php include "db.php"; ?>
<?php include "../admin/functions.php" ; ?>
<?php ob_start() ?>


<?php

    if (isset($_POST['login'])) {

         $username = escape($_POST['username']);
         $password = escape($_POST['password']);

         $stmt = mysqli_prepare($connection, "SELECT user_id, username, user_password, user_firstname, user_lastname, user_role FROM users WHERE username = ?");

         mysqli_stmt_bind_param($stmt, 's', $username);

         mysqli_stmt_execute($stmt);

         mysqli_stmt_bind_result($stmt, $db_user_id, $db_username, $db_password, $db_user_firstname, $db_user_lastname, $db_user_role);

         mysqli_stmt_fetch($stmt);

             if (password_verify($password, $db_password)) {

                 $_SESSION['username'] = $db_username;
                 $_SESSION['firstname'] = $db_user_firstname;
                 $_SESSION['lastname'] = $db_user_lastname;
                 $_SESSION['user_role'] = $db_user_role;

                 header("Location: ../admin/index.php");

             } else {
                 header("Location: ../index.php");
             }
    }


?>
