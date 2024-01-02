<?php
include "../layouts/header.php";
include "../../config/config.php";
if(!isset($_SESSION['admin_name'])) {
    header('location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}
// Fetch posts with necessary information using a JOIN query
$postsQuery = $conn->query("SELECT posts.id AS id, posts.title AS title, 
    posts.username AS user_name, categories.name AS name, posts.status AS status 
    FROM categories 
    JOIN posts ON categories.id = posts.category_id");
$postsQuery->execute();
$rows = $postsQuery->fetchAll(PDO::FETCH_OBJ);
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
                        <th scope="col">Category</th>
                        <th scope="col">User</th>
                        <th scope="col">Status</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rows as $post): ?>
                        <tr>
                            <th scope="row"><?php echo $post->id; ?></th>
                            <td><?php echo $post->title; ?></td>
                            <td><?php echo $post->name; ?></td>
                            <td><?php echo $post->user_name; ?></td>
                            <?php if ($post->status == 0): ?>
                                <td><a href="status-posts.php?status=<?php echo $post->status; ?>&id=<?php echo $post->id; ?>" class="btn btn-danger text-center">Deactivated</a></td>
                            <?php else: ?>
                                <td><a href="status-posts.php?status=<?php echo $post->status; ?>&id=<?php echo $post->id; ?>" class="btn btn-primary text-center">Activated</a></td>
                            <?php endif; ?>
                            <td><a href="delete-posts.php?po_id=<?php echo $post->id; ?>" class="btn btn-danger text-center">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "../layouts/footer.php"; ?>
