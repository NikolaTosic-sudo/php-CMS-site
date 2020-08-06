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

                $the_post_author = escape($_GET['author']);

            }

            ?>

            <h1 class="page-header">
                All posts by
                <small><?php echo $the_post_author?></small>
            </h1>


            <?php

            $stmt = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_author = ?");

            mysqli_stmt_bind_param($stmt, 's', $the_post_author);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

            while(mysqli_stmt_fetch($stmt)):

                ?>

                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>

                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>

                <hr>


                <?php

                endwhile;

            ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"  ?>

    </div>
    <!-- /.row -->

    <hr>

<?php  include "includes/footer.php" ?>