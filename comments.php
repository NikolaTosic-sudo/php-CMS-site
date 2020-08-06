 <!-- Blog Comments -->

 <?php


                if (isset($_POST['create_comment'])) {

                    $the_post_id = escape($_GET['p_id']);

                    $comment_author = escape($_POST['comment_author']);
                    $comment_email = escape($_POST['comment_email']);
                    $comment_content = escape($_POST['comment_content']);

                    if (!empty($comment_author) && !empty($comment_content) && !empty($comment_email)) {

                        $stmt = mysqli_prepare($connection, "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES (?, ?, ?, ?, ?, now())");

                        $unapproved = 'unapproved';

                        mysqli_stmt_bind_param($stmt, 'issss', $the_post_id, $comment_author, $comment_email, $comment_content, $unapproved);

                        mysqli_stmt_execute($stmt);


                    } else {

                        echo "<script>alert('Comment Fields Cannot Be Empty')</script>";

                    }

                }


                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">

                        <div class="form-group">
                            <label for="Author">Comment Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>

                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content" id="body"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                     <?php


                     $stmt = mysqli_prepare($connection, "SELECT comment_date, comment_content, comment_author FROM comments WHERE comment_post_id = ? AND comment_status = ? ORDER BY comment_id DESC");

                     $approved = 'approved';

                     mysqli_stmt_bind_param($stmt, 'is', $the_post_id, $approved);

                     mysqli_stmt_execute($stmt);

                     mysqli_stmt_bind_result($stmt, $comment_date, $comment_content, $comment_author);

                     while (mysqli_stmt_fetch($stmt)):

                     ?>


                     <!-- Comment -->
                     <div class="media">

                         <a class="pull-left" href="#">
                             <img class="media-object" src="http://placehold.it/64x64" alt="">
                         </a>
                         <div class="media-body">
                             <h4 class="media-heading"><?php echo $comment_author;   ?>
                                 <small><?php echo $comment_date;   ?></small>
                             </h4>

                             <?php echo $comment_content;   ?>

                         </div>
                     </div>

        <?php  endwhile; ?>