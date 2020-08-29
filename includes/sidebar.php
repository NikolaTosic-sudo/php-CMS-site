<div class="col-md-4">


    <?php

    if (isset($_SESSION['username'])){

        include "addpostWell.php" ;

    }

    ?>


    <!-- Blog Search Well -->
    <?php  include "searchbar.php" ?>

    <!--  Login  -->


    <?php

    if (!isset($_SESSION['username'])) {


        ?>

        <div class="well">
            <h4>Login</h4>

            <form action="includes/login.php" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Enter Username">
                </div>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Log In</button>
                </span>
                </div>
            </form>
            <!-- /.input-group -->
        </div>


        <?php

    } else {    ?>

        <div class="well">

            <h3>Logged in as:   <strong><?php echo $_SESSION['username']?></strong></h3>

            <a class="btn btn-primary" href="includes/logout.php">Log Out</a>


        </div>



    <?php
    }

    ?>


    <!-- Blog Categories Well -->
    <div class="well">

        <?php

        $stmt = mysqli_prepare($connection, "SELECT cat_title, cat_id FROM categories");

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $cat_title, $cat_id);

        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php
                    while(mysqli_stmt_fetch($stmt)):

                        echo "<li><a href='category.php?category_id={$cat_id}'>$cat_title</a></li>";

                    endwhile;
                    ?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->



    <?php

    if (!isset($_SESSION['username'])){

        include "widget.php" ;

    }

    include "contact_widget.php";


    ?>

</div>