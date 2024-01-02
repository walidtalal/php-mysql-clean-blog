<?php require "../includes/header.php";?>
<?php require "../config/config.php";?>

<?php

global $conn;
if(isset($_GET['cat_id'])) {

    $id= $_GET['cat_id'];
    $posts = $conn->query("select
       posts.id as id,
       posts.title as title,
       posts.subtitle as subtitle,
       posts.username as username,
       posts.created_at as created_at,
       posts.category_id as category_id
       posts.status as status
       from categories inner join posts 
           on categories.id = posts.category_id 
       where posts.category_id ='$id' and status = 1");

    $posts->execute();
    $rows = $posts->fetchAll(PDO::FETCH_OBJ);
} else {
    header("location: http://localhost/clean-blog/404.php");
}



?>
<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">

        <?php foreach ($rows as $row): ?>
            <!-- Post preview-->
            <div class="post-preview">
                <a href="http://localhost/clean-blog/posts/post.php?post_id=<?php echo $row->id;?>">
                    <h2 class="post-title"><?php echo $row->title; ?></h2>
                    <h3 class="post-subtitle"><?php echo $row->subtitle; ?></h3>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="#"><?php echo $row->username; ?></a>
                    on <?php echo date('M', strtotime($row->created_at)).','. date('d', strtotime($row->created_at)) ." " .  date('Y', strtotime($row->created_at)) ?>
                </p>
            </div>
            <!-- Divider-->
            <hr class="my-4" />
        <?php endforeach;  ?>
        <!-- Pagerr-->
    </div>
</div>

<?php require "../includes/footer.php";?>
