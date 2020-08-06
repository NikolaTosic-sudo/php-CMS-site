<?php


$new_user_password = '';

if(isset($_POST['create_user'])) {


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

    $stmt = mysqli_prepare($connection, "INSERT INTO users(user_firstname, user_lastname, user_role,username,user_email,user_password, user_image) VALUES (?, ?, ?, ?, ?, ?, '')");

    mysqli_stmt_bind_param($stmt, 'ssssss',$user_firstname, $user_lastname, $user_role, $username, $user_email, $user_password);

    mysqli_stmt_execute($stmt);

    echo "User Created: " . " " . "<a href='users.php'>View Users</a> ";

}}




?>

<form action="" method="post" enctype="multipart/form-data">



    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>




    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>


    <div class="form-group">

        <select name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>

    </div>


    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
        <?php echo "<p style='color: red'>$new_user_password<p>" ?>
    </div>



    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>


</form>
    