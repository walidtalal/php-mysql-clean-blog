<?php require "../includes/navbar.php"?>
<?php
require "../config/config.php";

if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];

    // Fetch post data to get the image filename
    $select = $conn->prepare("SELECT * FROM posts WHERE id = :id");
    $select->execute([":id" => $id]);
    $post = $select->fetch(PDO::FETCH_OBJ);

    if($_SESSION['user_id'] != $post->user_id) {
        header("location: http://localhost/clean-blog/index.php");
        exit();
    } else {
        unlink("images/" . $post->img ."");

        $select = $conn->prepare("delete FROM posts WHERE id = :id");
        $select->execute([":id" => $id]);

        header("location: http://localhost/clean-blog/index.php");
        exit();
    }
} else {
    header("location: http://localhost/clean-blog/404.php");
}
