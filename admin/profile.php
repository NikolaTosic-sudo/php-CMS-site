<?php

include "includes/admin_header.php";

if (isset($_SESSION['username'])) {

        $username = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE username = '{$username}' ";

        $select_user_profile = mysqli_query($connection, $query);

        confirmQuery($select_user_profile);

        while ($row = mysqli_fetch_assoc($select_user_profile)){

            $the_user_id = $row['user_id'];
            $user_firstname    = $row['user_firstname'];
            $user_lastname     = $row['user_lastname'];
            $user_role         = $row['user_role'];
            $username          = $row['username'];
            $user_email        = $row['user_email'];
            $user_password     = $row['user_password'];

        }

}

$new_user_password = '';

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

        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$user_password}' ";
        $query .= "WHERE user_id = {$the_user_id}";


        $edit_user_query = mysqli_query($connection, $query);

        confirmQuery($edit_user_query);


        echo "Profile Updated";


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
