<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>

        <?php  // Find exact category

        if (isset($_GET['edit'])){

            $cat_id = escape($_GET['edit']);


            $stmt = mysqli_prepare($connection, "SELECT cat_id, cat_title FROM categories WHERE cat_id = ?");

            mysqli_stmt_bind_param($stmt, 'i', $cat_id);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);

            while(mysqli_stmt_fetch($stmt)) {

                ?>
                <input value="<?php if (isset($cat_title)) echo $cat_title?>" type="text" class="form-control" name="cat_title">

            <?php }} ?>

        <?php  // Update Category

        if (isset($_POST['update_category'])){

            $get_cat_title = escape($_POST['cat_title']);

            $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id= ?");

            mysqli_stmt_bind_param($stmt, 'si', $get_cat_title, $cat_id);

            mysqli_stmt_execute($stmt);

            header("Location: categories.php");

            if (!$stmt){
                die("QUERY FAILED" . mysqli_error());
            }

            mysqli_stmt_close($stmt);
        }

        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update">
    </div>
</form>