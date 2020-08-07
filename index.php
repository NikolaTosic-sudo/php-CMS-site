<?php  include "includes/header.php"?>

<body>

    <!-- Navigation -->
    <?php  include "includes/navi.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    All posts
                    <small>Read the one you think is the best</small>
                </h1>

                <?php

                if (isset($_GET['page'])) {

                    $page = escape($_GET['page']);

                } else {
                    $page = '';
                }

                if ($page == "" || $page == 1) {

                    $page_1 = 0;

                } else {

                    $page_1 = ($page * 5) - 5;

                }

                $count = showAllPosts($_SESSION['username'], $page_1);
                

                ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"  ?>

        </div>
        <!-- /.row -->

        <hr>

    <ul class="pager">

        <?php

        for ($i = 1; $i <= $count; $i++) {

            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";

        }

        ?>


    </ul>



<?php  include "includes/footer.php" ?>