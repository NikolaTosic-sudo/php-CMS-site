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

                $query = "SELECT * FROM categories WHERE cat_id = $category_id";

                $select_category = mysqli_query($connection, $query);

                $row = mysqli_fetch_assoc($select_category);

                $category_title = $row['cat_title'];


                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {

                    $query = "SELECT * FROM posts WHERE post_category_id = $category_id";

                } else {

                    $query = "SELECT * FROM posts WHERE post_category_id = $category_id AND post_status = 'published'";

                }


            $select_all_posts = mysqli_query($connection, $query);

            if (mysqli_num_rows($select_all_posts) < 1) {

                echo "<h2 class='text-center text-danger'>NO POSTS IN THIS CATEGORY AVAILABLE</h2>";

            } else  {

            while($row = mysqli_fetch_assoc($select_all_posts)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 100);

                ?>

                <h1 class="page-header">
                    All posts
                    <small>in <?php echo $category_title ?></small>
                </h1>


                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


                <?php


            }}} else {

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