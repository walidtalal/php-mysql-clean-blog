<?php require "../layouts/header.php"?>
<?php
require "../../config/config.php";
if(!isset($_SESSION['admin_name'])) {
    header('location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}
if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];



        $select = $conn->prepare("delete FROM categories WHERE id = :id");
        $select->execute([":id" => $id]);

        header("location: http://localhost/clean-blog/admin-panel/categories-admins/show-categories.php");
        exit();
    } else{


    header("location: http://localhost/clean-blog/404.php");
}

