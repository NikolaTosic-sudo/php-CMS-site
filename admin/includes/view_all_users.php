<?php include "delete_modal.php"; ?>

<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Change to Admin</th>
        <th>Change to Sub</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>

    <tbody>

    <?php

    $query = "SELECT * FROM users";

    $select_users = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users)) {

    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];


    echo "<tr>";
    echo "<td>$user_id</td>";
    echo "<td>$username</td>";
    echo "<td>$user_firstname</td>";
    echo "<td>$user_lastname</td>";
    echo "<td>$user_email</td>";
    echo "<td>$user_role</td>";


    echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
    echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
    echo "<td><a href='users.php?source=edit_user&u_id=$user_id'>EDIT</a></td>";
    echo "<td><a rel='$user_id' href='javascript:void(0)' class='delete_link'>DELETE</a></td>";


      }


    ?>

    </tbody>
</table>

<?php

if (isset($_GET['change_to_admin'])) {

    $the_user_id = escape($_GET['change_to_admin']);

    $stmt = mysqli_prepare($connection, "UPDATE users SET user_role = ? WHERE user_id = ?");

    $admin = 'admin';

    mysqli_stmt_bind_param($stmt, 'si', $admin, $the_user_id);

    mysqli_stmt_execute($stmt);

    header("Location: users.php");


}

if (isset($_GET['change_to_sub'])) {

    $the_user_id = escape($_GET['change_to_sub']);

    $stmt = mysqli_prepare($connection, "UPDATE users SET user_role = ? WHERE user_id = ?");

    $sub = 'subscriber';

    mysqli_stmt_bind_param($stmt, 'si', $sub, $the_user_id);

    mysqli_stmt_execute($stmt);

    header("Location: users.php");


}

if (isset($_GET['delete'])) {

    if (isset($_SESSION['user_role'])) {

        if ($_SESSION['user_role'] == 'admin') {

            $the_user_id = mysqli_real_escape_string($connection, escape($_GET['delete']));

            $stmt = mysqli_prepare($connection, "DELETE FROM users WHERE user_id = ?");

            mysqli_stmt_bind_param($stmt, 'i', $the_user_id);

            mysqli_stmt_execute($stmt);

            header("Location: users.php");

        }

    }

}


?>

<script src="js/jquery.js"></script>

<script>

    $(document).ready(function () {

        $(".delete_link").on('click', function () {

            var id = $(this).attr("rel");

            var delete_url = "users.php?delete="+ id +" ";

            $(".modal_delete").attr("href", delete_url);

            $("#myModal").modal('show');

        })

    })


</script>

