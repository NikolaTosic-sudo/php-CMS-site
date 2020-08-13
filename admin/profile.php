<?php

include "includes/admin_header.php";

if (!is_admin($_SESSION['username'])) {

    header("Location: index.php");

}

if (isset($_SESSION['username'])) {

        $username = $_SESSION['username'];

        $stmt = mysqli_prepare($connection, "SELECT user_id, user_firstname, user_lastname, user_role, username, user_email, user_password FROM users WHERE username = ? ");

        mysqli_stmt_bind_param($stmt, 's', $username);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $the_user_id, $user_firstname, $user_lastname, $user_role, $username, $user_email, $user_password);

        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);

}

$new_user_password = '';

$msg = '';

if(isset($_POST['edit_user'])) {


    $user_firstname    = escape($_POST['user_firstname']);
    $user_lastname     = escape($_POST['user_lastname']);
    $user_role         = escape($_POST['user_role']);
    $username          = escape($_POST['username']);
    $user_email        = escape($_POST['user_email']);
    $user_password     = escape($_POST['user_password']);

    if ($user_password == '') {

        $new_user_password = 'Try again, password cannot be empty';

    } else {

        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

        $stmt = mysqli_prepare($connection, "UPDATE users SET user_firstname = ?, user_lastname = ?, user_role = ?, username = ?, user_email = ?, user_password = ? WHERE user_id = ?");

        mysqli_stmt_bind_param($stmt, 'ssssssi', $user_firstname, $user_lastname, $user_role, $username, $user_email, $user_password, $the_user_id);

        mysqli_stmt_execute($stmt);

        $msg = "Your Profile Has Been Updated. Click to " . " " . "<a href='users.php'>View Users</a> ";


    }

}


?>

<body>

<div id="wrapper">

    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php echo $_SESSION['firstname'] ?></small>
                    </h1>

                    <?php echo $msg ?>

                    <form action="" method="post" enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="title">Firstname</label>
                            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
                        </div>




                        <div class="form-group">
                            <label for="post_status">Lastname</label>
                            <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
                        </div>


                        <div class="form-group">

                            <select name="user_role" id="">
                                <option value='<?php echo $user_role ?>'><?php echo $user_role; ?></option>

                                <?php

                                if($user_role == 'admin' ) {

                                    echo "<option value='subscriber'>Subscriber</option>";

                                } else {

                                    echo "<option value='admin'>Admin</option>";

                                }

                                ?>

                            </select>

                        </div>


                        <div class="form-group">
                            <label for="post_tags">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username?>">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Email</label>
                            <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Password</label>
                            <input type="password" class="form-control" name="user_password" value="">
                            <?php echo "<p style='color: red'>$new_user_password<p>" ?>
                        </div>




                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                        </div>


                    </form>

                </div>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php  include  "includes/admin_footer.php"  ?>
