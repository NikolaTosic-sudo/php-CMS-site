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

            if (isset($_GET['category_id'])) {

                $category_id = $_GET['category_id'];

                $stmt = mysqli_prepare($connection, "SELECT cat_title FROM categories WHERE cat_id = ?");

                mysqli_stmt_bind_param($stmt, 'i', $category_id);

                mysqli_stmt_execute($stmt);

                mysqli_stmt_bind_result($stmt, $category_title);

                mysqli_stmt_fetch($stmt);

            ?>

            <h1 class="page-header">
                All posts
                <small>in <?php echo $category_title ?></small>
            </h1>

            <?php

                mysqli_stmt_close($stmt);


            if ($_SESSION['username'] == null) {

                $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_date, post_author, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ?");

                $published = 'published';

            } else if (is_admin($_SESSION['username'])) {

                $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_date, post_author, post_image, post_content FROM posts WHERE post_category_id = ?");

            } else {

                $stmt3 = mysqli_prepare($connection, "SELECT post_id, post_title, post_date, post_author, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ?");

                $published = 'published';

            }


            if (isset($stmt1)) {

                mysqli_stmt_bind_param($stmt1, 'is', $category_id, $published);

                mysqli_stmt_execute($stmt1);

                mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_date, $post_author, $post_image, $post_content);

                $stmt = $stmt1;

            } else if (isset($stmt2)) {

                mysqli_stmt_bind_param($stmt2, 'i', $category_id);

                mysqli_stmt_execute($stmt2);

                mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_date, $post_author, $post_image, $post_content);

                $stmt = $stmt2;

            } else {

                mysqli_stmt_bind_param($stmt3, 'is', $category_id, $published);

                mysqli_stmt_execute($stmt3);

                mysqli_stmt_bind_result($stmt3, $post_id, $post_title, $post_date, $post_author, $post_image, $post_content);

                $stmt = $stmt3;

            }

            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 0) {

                echo "<h2 class='text-center text-danger'>NO POSTS IN THIS CATEGORY AVAILABLE</h2>";

            } else {

            while (mysqli_stmt_fetch($stmt)):

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
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
            </a>
            <hr>
            <p><?php echo substr($post_content, 0, 100) ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span
                        class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>


            <?php

            endwhile;

                    mysqli_stmt_close($stmt);

                }

            } else {

                header("Location: index.php");

            }


            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"  ?>

    </div>
    <!-- /.row -->

    <hr>

<?php  include "includes/footer.php" ?>