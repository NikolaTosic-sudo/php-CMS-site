 <!-- Blog Comments -->

 <?php


                if (isset($_POST['create_comment'])) {

                    $the_post_id = escape($_GET['p_id']);

                    $comment_author = escape($_POST['comment_author']);
                    $comment_email = escape($_POST['comment_email']);
                    $comment_content = escape($_POST['comment_content']);

                    if (!empty($comment_author) && !empty($comment_content) && !empty($comment_email)) {

                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query .= "VALUES ($the_post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";

                        $create_comment_query = mysqli_query($connection, $query);

                        if (!$create_comment_query){
                            die('QUERY FAILED' . mysqli_error($connection));
                        }



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


                     $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
                     $query .= "AND comment_status = 'approved' ";
                     $query .= "ORDER BY comment_id DESC ";
                     $select_comment_query = mysqli_query($connection, $query);

                     confirmQuery($select_comment_query);

                     while ($row = mysqli_fetch_array($select_comment_query)) {
                         $comment_date   = $row['comment_date'];
                         $comment_content= $row['comment_content'];
                         $comment_author = $row['comment_author'];

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

        <?php  } ?>