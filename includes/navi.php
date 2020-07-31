<?php include "includes/db.php"  ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./index.php">Blog Front</a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="nav-item"><a class="nav-link" href="admin">Admin</a></li>

                <li class="nav-item"><a class="nav-link" href="registration.php">Registration</a></li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Me</a>
                </li>

                <?php

                        if (isset($_SESSION['username'])) {

                ?>

                <li class="nav-item-">
                    <a href="admin/posts.php?source=add_post">Add Post</a>
                </li>

                <?php
                    }
                ?>

                <?php

//                if (isset($_SESSION['user_role'])) {
//
//                    echo "<li><a href='admin/posts.php?source=edit_post&p_id=5'>Edit Post</a></li>";
//
//
                    if (isset($_GET['p_id'])) {

                        $the_post_id = escape($_GET['p_id']);

                        echo "<li><a href='admin/posts.php?source=edit_post&p_id=$the_post_id'>Edit Post</a></li>";

                    }
//
//                }

                ?>



            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>