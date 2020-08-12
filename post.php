<?php  include "includes/header.php"?>

    <body>

    <!-- Navigation -->
<?php  include "includes/navi.php" ?>

    <!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if(isset($_GET['p_id'])) {

                $the_post_id = escape($_GET['p_id']);

                $views_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";

                $send_query = mysqli_query($connection, $views_query);


                if ($_SESSION['username'] == null){

                    $stmt = mysqli_prepare($connection, "SELECT post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_id = ? AND post_status = ?");

                    $published = 'published';

                    mysqli_stmt_bind_param($stmt, 'is', $the_post_id, $published);

                    mysqli_stmt_execute($stmt);

                }

                else if (is_admin($_SESSION['username'])) {

                    $stmt = mysqli_prepare($connection, "SELECT post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_id = ?");

                    mysqli_stmt_bind_param($stmt, 'i', $the_post_id);

                    mysqli_stmt_execute($stmt);

                } else {

                    $stmt = mysqli_prepare($connection, "SELECT post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_id = ? AND post_status = ?");

                    $published = 'published';

                    mysqli_stmt_bind_param($stmt, 'is', $the_post_id, $published);

                    mysqli_stmt_execute($stmt);

                }

                mysqli_stmt_store_result($stmt);

                $count = mysqli_stmt_num_rows($stmt);

                if ($count < 1) {

                    echo "<h2 class='text-center text-danger'>This post is not published yet, sorry</h2>";

                } else {

                    mysqli_stmt_bind_result($stmt, $post_title, $post_author, $post_date, $post_image, $post_content);

                while(mysqli_stmt_fetch($stmt)):

                ?>


                    <h1 class="page-header">
                        <?php echo $post_title ?>
                        <small>by <?php echo $post_author?></small>
                    </h1>

                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>

                <hr>


                <?php endwhile;


            }} else {

                header("Location: index.php");

            }


            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"  ?>

    </div>

    <?php

        if ($count >= 1){

     ?>

    <div class="text-center">

        <h4>Do you like this content ?</h4>
        <p>To see all posts by <?php echo $post_author?> click <a href="author_post.php?author=<?php echo $post_author ?>&p_id=<?php echo $the_post_id ?>">here.</a></p>

    </div>

   <?php } ?>

    <hr>
    <!-- /.row -->
    <?php

    if ($count >= 1) {

        include "comments.php";

    }

    ?>

    <hr>

<?php  include "includes/footer.php" ?>