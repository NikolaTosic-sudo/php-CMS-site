<?php include "delete_modal.php"; ?>

<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Disapprove</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>

    <tbody>

    <?php

    $query = "SELECT * FROM comments";

    $select_comments = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        echo "<tr>";
        echo "<td>$comment_id</td>";
        echo "<td>$comment_author</td>";
        echo "<td>$comment_content</td>";
        echo "<td>$comment_email</td>";
        echo "<td>$comment_status</td>";

        $stmt = mysqli_prepare($connection, "SELECT post_id, post_title FROM posts WHERE post_id = ?");

        mysqli_stmt_bind_param($stmt, 'i', $comment_post_id);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $post_id, $post_title);

        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);

        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        echo "<td>$comment_date</td>";
        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
        echo "<td><a href='comments.php?disapprove=$comment_id'>Disapprove</a></td>";
        echo "<td><a href='comments.php?source=edit_comment&c_id=$comment_id'>EDIT</a></td>";
        echo "<td><a rel='$comment_id' href='javascript:void(0)' class='delete_link'>DELETE</a></td>";
        echo "</tr>";

    }



    ?>

    </tbody>
</table>

<?php

if (isset($_GET['approve'])) {

    $the_comment_id = escape($_GET['approve']);

    $stmt = mysqli_prepare($connection, "UPDATE comments SET comment_status = ? WHERE comment_id = ?");

    $approved = 'approved';

    mysqli_stmt_bind_param($stmt, 'si', $approved, $the_comment_id);

    mysqli_stmt_execute($stmt);

    header("Location: comments.php");


}

if (isset($_GET['disapprove'])) {

    $the_comment_id = escape($_GET['disapprove']);

    $stmt = mysqli_prepare($connection, "UPDATE comments SET comment_status = ? WHERE comment_id = ?");

    $unapproved = 'unapproved';

    mysqli_stmt_bind_param($stmt, 'si', $unapproved, $the_comment_id);

    mysqli_stmt_execute($stmt);

    header("Location: comments.php");

}

if (isset($_GET['delete'])) {

    $the_comment_id = escape($_GET['delete']);

    $stmt = mysqli_prepare($connection, "DELETE FROM comments WHERE comment_id = ?");

    mysqli_stmt_bind_param($stmt, 'i', $the_comment_id);

    mysqli_stmt_execute($stmt);

    header("Location: comments.php");

}


?>

<script src="js/jquery.js"></script>

<script>

    $(document).ready(function () {

        $(".delete_link").on('click', function () {

            var id = $(this).attr("rel");

            var delete_url = "comments.php?delete="+ id +" ";

            $(".modal_delete").attr("href", delete_url);

            $("#myModal").modal('show');

        })

    })

</script>

