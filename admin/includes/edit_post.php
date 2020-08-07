<?php

if(isset($_GET['p_id'])){

    $the_post_id =  $_GET['p_id'];

}


$stmt = mysqli_prepare($connection, "SELECT post_id, post_title, post_category_id, post_status, post_image, post_content, post_tags, post_comment_count, post_date FROM posts WHERE post_id = ? ");

mysqli_stmt_bind_param($stmt, 'i', $the_post_id);

mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_category_id, $post_status, $post_image, $post_content, $post_tags, $post_comment_count, $post_date);

mysqli_stmt_fetch($stmt);

mysqli_stmt_close($stmt);


if (isset($_POST['views'])) {

    $stmt = mysqli_prepare($connection, "UPDATE posts SET post_views_count = ? WHERE post_id = ?");

    $count = 0;

    mysqli_stmt_bind_param($stmt, 'is', $count, $post_id);

    $reset_views = mysqli_stmt_execute($stmt);

}


if(isset($_POST['update_post'])) {


    $post_title          =  escape($_POST['post_title']);
    $post_category_id    =  escape($_POST['post_category']);
    $post_status         =  escape($_POST['post_status']);
    $post_image          =  escape($_FILES['image']['name']);
    $post_image_temp     =  escape($_FILES['image']['tmp_name']);
    $post_content        =  escape($_POST['post_content']);
    $post_tags           =  escape($_POST['post_tags']);

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)) {

        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($connection,$query);

        while($row = mysqli_fetch_array($select_image)) {

            $post_image = $row['post_image'];

        }


    }

    $stmt = mysqli_prepare($connection, "UPDATE posts SET post_title  = ?, post_category_id = ?, post_date = now(), post_status = ?, post_tags = ?, post_content = ?, post_image = ? WHERE post_id = ?");

    mysqli_stmt_bind_param($stmt, 'ssssssi', $post_title, $post_category_id, $post_status, $post_tags, $post_content, $post_image, $the_post_id);

    mysqli_stmt_execute($stmt);

    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";

}



?>






<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo htmlspecialchars(stripslashes($post_title)); ?>"  type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="categories">Categories</label>
        <select name="post_category" id="">

            <?php

            $query = "SELECT * FROM categories ";
            $select_categories = mysqli_query($connection,$query);

            confirmQuery($select_categories);


            while($row = mysqli_fetch_assoc($select_categories )) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];


                if($cat_id == $post_category_id) {


                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";


                } else {

                    echo "<option value='{$cat_id}'>{$cat_title}</option>";


                }


            }

            ?>


        </select>

    </div>



    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="post_status" id="">

            <option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>

            <?php

            if($post_status == 'published' ) {


                echo "<option value='draft'>Draft</option>";


            } else {


                echo "<option value='published'>Publish</option>";


            }



            ?>


        </select>
    </div>



    <div class="form-group">

        <input type="submit" class="btn btn-danger" name="views" value="Reset Views">

    </div>




    <div class="form-group">

        <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
        <input  type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>"  type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea  class="form-control "name="post_content" id="body" cols="30" rows="10"><?php echo $post_content; ?>


         </textarea>
    </div>



    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>


</form>