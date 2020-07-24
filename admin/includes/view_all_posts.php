<?php include "delete_modal.php";

if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $checkBoxValue) {

        $bulk_options = escape($_POST['bulkOptions']);

        switch ($bulk_options){

            case 'publish':

                $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $checkBoxValue";

                $update_to_publish = mysqli_query($connection, $query);

                confirmQuery($update_to_publish);

                break;

            case 'draft':

                $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $checkBoxValue";

                $update_to_draft = mysqli_query($connection, $query);

                confirmQuery($update_to_draft);

                break;

            case 'delete':

                $query = "DELETE FROM posts WHERE post_id = $checkBoxValue";

                $delete_post = mysqli_query($connection, $query);

                confirmQuery($delete_post);


        }

    }


}



?>


<form action="" method="post">

<table class="table table-bordered table-hover">
    
    <div id="bulkOptionsContainer" class="col-xs-4" style="margin-bottom: 10px; padding-left: 0px">

        <select class="form-control" name="bulkOptions" id="">

            <option value="">Select Options</option>
            <option value="publish">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>

        </select>

    </div>

    <div class="col-xs-4">

        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>

    </div>
    
    
    <thead>
    <tr>
        <th><input id="selectAllBoxes" type="checkbox">  Select All</th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Views</th>
    </tr>
    </thead>

    <tbody>

    <?php

    $query = "SELECT * FROM posts";

    $select_posts = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_views_count = $row['post_views_count'];

        echo "<tr>";
        ?>

        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>

        <?php
        echo "<td>$post_id</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title</td>";

        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
        $select_categories = mysqli_query($connection,$query);

        confirmQuery($select_categories);


            while($row = mysqli_fetch_assoc($select_categories )) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<td>$cat_title</td>";
            }

        echo "<td>$post_status</td>";
        echo "<td><img width='100px' height='70px' src='../images/$post_image' alt='image'></td>";
        echo "<td>$post_tags</td>";

        $comment_query = "SELECT * FROM comments WHERE comment_post_id =  $post_id";

        $send_comment_query = mysqli_query($connection, $comment_query);

        $count_comments = mysqli_num_rows($send_comment_query);



        echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";
        echo "<td>$post_date</td>";
        echo "<td><a href='../post.php?p_id=$post_id'>Post</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>EDIT</a></td>";
        echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>DELETE</a></td>";
        echo "<td>$post_views_count</td>";
        echo "</tr>";

    }



    ?>

    </tbody>
</table>

    
</form>

<?php

    if (isset($_GET['delete'])) {

        $the_post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = $post_id";

        $delete_query = mysqli_query($connection, $query);

        header("Location: posts.php");


    }


?>

<script src="js/jquery.js"></script>

<script>

    $(document).ready(function () {

        $(".delete_link").on('click', function () {

            var id = $(this).attr("rel");

            var delete_url = "posts.php?delete="+ id +" ";

            $(".modal_delete").attr("href", delete_url);

            $("#myModal").modal('show');

        })

    })

</script>
