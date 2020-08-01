<?php

function confirmQuery($result) {

    global $connection;

    if(!$result ) {

        die("QUERY FAILED ." . mysqli_error($connection));


    }


}

function addCategory() {

    global $connection;

    if (isset($_POST['submit'])){
        $cat_title = escape($_POST['cat_title']);

        if ($cat_title == "" || empty($cat_title)){
            echo "<p style='color: red'>This field should not be empty</p>";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";

            $create_category = mysqli_query($connection, $query);

            if (!$create_category){
                die("QUERY FAILED" . mysqli_error($connection));
            }
        }
    }
}

function findCategories() {

    global $connection;

    $query = "SELECT * FROM categories";

    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";

    }
}

function deleteCategory() {

    global $connection;

    if (isset($_GET['delete'])){

        $get_cat_id = escape($_GET['delete']);

        $query = "DELETE FROM categories WHERE cat_id={$get_cat_id}";

        $delete_query = mysqli_query($connection, $query);

        header("Location: categories.php");

        if (!$delete_query){
            die("QUERY FAILED" . mysqli_error());
        }
    }
}


function usersOnline() {

    global $connection;

    $session = session_id();
    $time = time();
    $timeout_seconds = 60;
    $time_out = $time - $timeout_seconds;

    $query = "SELECT * FROM users_online WHERE session = '$session'";

    $send_query = mysqli_query($connection, $query);

    $count = mysqli_num_rows($send_query);

    if ($count == 0) {

        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");

    } else {

        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

    }

    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");


    return $count_user = mysqli_num_rows($users_online_query);

}

function escape($string) {

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));

}


function recordCount($table) {

    global $connection;

    $query = "SELECT * FROM $table";
    $select_all_from_table = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_all_from_table);

    confirmQuery($select_all_from_table);

    return $result;
}

function is_admin($username) {

    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";

    $result = mysqli_query($connection, $query);

    confirmQuery($result);

    $row = mysqli_fetch_assoc($result);

    if($row['user_role'] == 'admin') {

        return true;

    } else {

        return false;

    }

}

function alreadyExists($row, $object) {

    global $connection;

    $query = "SELECT $row FROM users WHERE $row = '$object'";

    $result = mysqli_query($connection, $query);

    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false;

    }

}



