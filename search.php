<?php include "includes/header.php" ?>

    <body>

    <!-- Navigation -->
<?php include "includes/navi.php" ?>

    <!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                All posts
                <small>in <?php

                    if (isset($_POST['search'])) {
                        echo $_POST['search'];
                        }

                        ?>
                    </small>
            </h1>

            <?php


            if (isset($_POST['submit'])) {

                $search = escape($_POST['search']);

                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";

                $search_query = mysqli_query($connection, $query);

                confirmQuery($search_query);

                $count = mysqli_num_rows($search_query);

                if ($count == 0) {

                    if (isset($_SESSION['username'])) {

                        echo "<h2 style='color: red'>Sorry, no posts found in your search</h2>" . "<a href='admin/posts.php?source=add_post'>Add post here</a>";

                    } else {

                        echo "<h2 style='color: red'>Sorry, no posts found in your search</h2>";

                    }
                } else {

                    while($row = mysqli_fetch_assoc($search_query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];

                        ?>


                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                        <hr>
                        <p><?php echo $post_content?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>


                        <?php }
                }

            }
            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php" ?>