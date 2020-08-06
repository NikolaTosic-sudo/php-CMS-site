<?php

if (isset($_GET['u_id'])) {

    $the_user_id = $_GET['u_id'];
}

$stmt = mysqli_prepare($connection, "SELECT user_firstname, user_lastname, user_role, username, user_email, user_password FROM users WHERE user_id = ?");

mysqli_stmt_bind_param($stmt, 'i', $the_user_id);

mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $user_firstname, $user_lastname, $user_role, $username, $user_email, $user_password);

mysqli_stmt_fetch($stmt);

mysqli_stmt_close($stmt);

$new_user_password = '';


if(isset($_POST['edit_user'])) {


    $user_firstname    = escape($_POST['user_firstname']);
    $user_lastname     = escape($_POST['user_lastname']);
    $user_role         = escape($_POST['user_role']);
    $username          = escape($_POST['username']);
    $user_email        = escape($_POST['user_email']);
    $user_password     = escape($_POST['user_password']);


    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

    if ($user_password == '') {

        $new_user_password = 'Try again, password cannot be empty';

    } else {

        $stmt = mysqli_prepare($connection, "UPDATE users SET user_firstname = ?, user_lastname = ?, user_role = ?, username = ?, user_email = ?, user_password = ? WHERE user_id = ?");

        mysqli_stmt_bind_param($stmt, 'ssssssi', $user_firstname, $user_lastname, $user_role, $username, $user_email, $hashed_password, $the_user_id);

        mysqli_stmt_execute($stmt);

        echo "User Updated: " . " " . "<a href='users.php'>View Users</a> ";

    }

}




?>

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
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>


</form>
