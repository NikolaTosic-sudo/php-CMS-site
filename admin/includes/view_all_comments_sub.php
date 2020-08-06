

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
        echo "</tr>";

    }



    ?>

    </tbody>
</table>
