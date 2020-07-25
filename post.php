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

                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published'";

                }

                else if (is_admin($_SESSION['username'])) {

                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";

                } else {

                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published'";

                }

                $select_all_posts = mysqli_query($connection, $query);


                if (mysqli_num_rows($select_all_posts) < 1) {

                    echo "<h2 class='text-center text-danger'>This post is not published yet, sorry</h2>";

                } else {




                while($row = mysqli_fetch_assoc($select_all_posts)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];


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
    <?php

    if (mysqli_num_rows($select_all_posts) >= 1) {

        include "comments.php";

    }

    ?>

    <hr>

<?php  include "includes/footer.php" ?>