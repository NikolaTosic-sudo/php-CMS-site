<?php

function addCategory() {

    global $connection;

    if (isset($_POST['submit'])){
        $cat_title = escape($_POST['cat_title']);

        if ($cat_title == "" || empty($cat_title)){
            echo "<p style='color: red'>This field should not be empty</p>";
        } else {

            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUE(?)");

            mysqli_stmt_bind_param($stmt, 's', $cat_title);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);

        }
    }
}

function findCategories() {

    global $connection;

    $stmt = mysqli_prepare($connection, "SELECT cat_id, cat_title FROM categories");

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);

    while(mysqli_stmt_fetch($stmt)) {

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

        $stmt = mysqli_prepare($connection, "DELETE FROM categories WHERE cat_id= ?");

        mysqli_stmt_bind_param($stmt, 'i', $get_cat_id);

        mysqli_stmt_execute($stmt);

        header("Location: categories.php");

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

    $stmt = mysqli_prepare($connection, "SELECT * FROM $table");

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    $result = mysqli_stmt_num_rows($stmt);

    return $result;
}

function is_admin($username) {

    global $connection;

    $stmt = mysqli_prepare($connection, "SELECT user_role FROM users WHERE username = ?");

    mysqli_stmt_bind_param($stmt, 's', $username);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $user_role);

    mysqli_stmt_fetch($stmt);

    if($user_role == 'admin') {

        return true;

    } else {

        return false;

    }

}

function alreadyExists($row, $object) {

    global $connection;

    $stmt = mysqli_prepare($connection, "SELECT $row FROM users WHERE $row = ?");

    mysqli_stmt_bind_param($stmt, 's', $object);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {

        return true;

    } else {

        return false;

    }

}


function showAllPosts($username, $limit) {

    global $connection;

    if ($username == null){

        $stmt = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content, post_status FROM posts WHERE post_status = ?");

        $published = 'published';

        mysqli_stmt_bind_param($stmt, 's', $published);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_store_result($stmt);

        $count = mysqli_stmt_num_rows($stmt);

        if($count < 1) {

            echo "<h2 class='text-center text-danger'>NO POSTS AVAILABLE</h2>";

        } else {

            $count = ceil($count / 5);

            $stmt = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content, post_status FROM posts WHERE post_status = ? LIMIT $limit, 5");

            mysqli_stmt_bind_param($stmt, 's', $published);

            mysqli_stmt_execute($stmt);

        }

    }

    else if (is_admin($username)) {

        $stmt = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content, post_status FROM posts");

        mysqli_stmt_execute($stmt);

        mysqli_stmt_store_result($stmt);

        $count = mysqli_stmt_num_rows($stmt);

        if($count < 1) {

            echo "<h2 class='text-center text-danger'>NO POSTS AVAILABLE</h2>";

        } else {

            $count = ceil($count / 5);

            $stmt = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content, post_status FROM posts LIMIT $limit, 5");

            mysqli_stmt_execute($stmt);

        }

    } else {

        $stmt = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content, post_status FROM posts WHERE post_status = ?");

        $published = 'published';

        mysqli_stmt_bind_param($stmt, 's', $published);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_store_result($stmt);

        $count = mysqli_stmt_num_rows($stmt);

        if($count < 1) {

            echo "<h2 class='text-center text-danger'>NO POSTS AVAILABLE</h2>";

        } else {

            $count = ceil($count / 5);

            $stmt = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content, post_status FROM posts WHERE post_status = ? LIMIT $limit, 5");

            mysqli_stmt_bind_param($stmt, 's', $published);

            mysqli_stmt_execute($stmt);

        }

    }

        mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_status);

        while(mysqli_stmt_fetch($stmt)) {

            ?>


            <h2>
                <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a href="author_post.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
            <hr>
            <a href="post.php?p_id=<?php echo $post_id ?>">
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
            </a>
            <hr>
            <p><?php echo substr($post_content,0,100)?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>


            <?php



}

return $count;

}



