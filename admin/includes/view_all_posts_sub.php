<form action="" method="post">

    <table class="table table-bordered table-hover">

        <thead>
        <tr>
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
            echo "<td>$post_views_count</td>";
            echo "</tr>";

        }



        ?>

        </tbody>
    </table>


</form>
