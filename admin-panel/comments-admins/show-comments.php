<?php
include "../layouts/header.php";
include "../../config/config.php";
if(!isset($_SESSION['admin_name'])) {
    header('location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}
// Fetch posts with necessary information using a JOIN query
$comments = $conn->query("SELECT posts.id AS id, posts.title AS title, comments.id AS comment_id,
     comments.id_post_comment AS id_post_comment, comments.username_comment AS
     user_name_comment, comments.comment AS comment, comments.status_comment
     AS status_comment		
     FROM comments 
    JOIN posts ON posts.id = comments.id_post_comment");
$comments->execute();
$rows = $comments->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Posts</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Comment</th>
                        <th scope="col">User</th>
                        <th scope="col">Status</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($rows as $row) : ?>
                        <tr>
                            <th scope="row"><?php echo $row->comment_id; ?></th>
                            <td><?php echo $row->title; ?></td>
                            <td><?php echo $row->comment; ?></td>
                            <td><?php echo $row->user_name_comment; ?></td>
                            <?php if($row->status_comment == 0) : ?>
                                <td><a href="http://localhost/clean-blog/admin-panel/comments-admins/status-comments.php?comment_id=<?php echo $row->comment_id; ?>&status_comment=<?php echo $row->status_comment; ?>" class="btn btn-danger  text-center ">deactivated</a></td>
                            <?php else : ?>
                                <td><a href="http://localhost/clean-blog/admin-panel/comments-admins/status-comments.php?comment_id=<?php echo $row->comment_id; ?>&status_comment=<?php echo $row->status_comment; ?>" class="btn btn-success  text-center ">activated</a></td>
                            <?php endif; ?>
                            <td><a href="http://localhost/clean-blog/admin-panel/comments-admins/delete-comments.php?comment_id=<?php echo $row->comment_id; ?>" class="btn btn-danger  text-center ">delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "../layouts/footer.php"; ?>
