<?php require '../includes/navbar.php'?>
<?php require '../config/config.php'?>
<?php

if(isset($_GET['post_id'])) {
    $id = $_GET['post_id'];


    $select = $conn->query("SELECT * FROM posts WHERE id = '$id'");

    $select->execute();

    $post = $select->fetch(PDO::FETCH_OBJ);
} else {
    header("location: http://localhost/clean-blog/404.php");
}


if(isset($_POST['submit']) && isset($_GET['post_id'])) {
//    Id of post and username for who posted

    if($_POST['comment'] == '') {
        echo "<script>alert('Write a comment'); </script>";

    } else {
        $id = $_GET['post_id'];
        $username = $_SESSION['username'];
        $comment = $_POST['comment'];


        $insert_comment = $conn->prepare("insert into comments (id_post_comment, username_comment,comment) values (:id_post_comment, :username_comment, :comment)");
        $insert_comment->execute([
            ":id_post_comment" =>$id,
            ":username_comment" =>$username,
            ":comment" =>$comment,
        ]);
//        header("location: http://localhost/clean-blog/posts/post.php?post_id=". $id ."");
        echo "<script>alert('Comment added and it will be fowarded to the admins'); </script>";

    }

}


//selecting the comments

$comments = $conn->query("SELECT posts.id AS id, 
    comments.id_post_comment AS id_post_comment, comments.username_comment 
    AS user_name_comment, comments.comment AS comment, 
    comments.created_at AS created_at, 
    comments.status_comment AS status_comment FROM posts JOIN comments ON posts.id =  comments.id_post_comment 
    WHERE posts.id = '$id' AND comments.status_comment = 1");

$comments->execute();

$allComments =$comments->fetchAll(PDO::FETCH_OBJ);
?>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('images/<?php echo $post->img;?>')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1><?php echo $post->title;?></h1>
                            <h2 class="subheading"><?php echo $post->subtitle;?></h2>
                            <span class="meta">
                                Posted by
                                <a href="#!"><?php echo $post->username;?></a>
                                on <?php echo date('M', strtotime($post->created_at)).','. date('d', strtotime($post->created_at)) ." " .  date('Y', strtotime($post->created_at)) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">

                        <p><?php echo $post->body; ?></p>
                        <!-- <p>
                            Placeholder text by
                            <a href="http://spaceipsum.com/">Space Ipsum</a>
                            &middot; Images by
                            <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>
                        </p> -->
                        <?php if(isset($_SESSION['user_id']) AND $_SESSION['user_id'] == $post->user_id) : ?>
                            <a  href="http://localhost/clean-blog/posts/delete.php?del_id=<?php echo $post->id; ?>" class="btn btn-danger text-center float-end">Delete</a>

                            <a href="update.php?upd_id=<?php echo $post->id; ?>" class="btn btn-warning text-center">Update</a>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </article>

<section>
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <h3 class="mb-5">Comments</h3>

                <div class="card">
                    <div class="card-body">
                        <?php foreach ($allComments as $comment) :?>

                        <div class="d-flex flex-start align-items-center">

                            <div>
                                <h6 class="fw-bold text-primary"><?php echo $comment->user_name_comment;?><h8 class="p-3 text-black"><?php echo date('M', strtotime($comment->created_at)).','. date('d', strtotime($comment->created_at)) ." " .  date('Y', strtotime($comment->created_at)) ?></h8></h6>

                            </div>
                        </div>

                        <p class="mt-3 mb-4 pb-2">
                            <?php echo $comment->comment;?>
                        </p>


                        <hr class="my-4">
                        <?php endforeach;?>
<!---->
<!--                        <div class="d-flex flex-start align-items-center">-->
<!--                            <div>-->
<!--                                <h6 class="fw-bold text-primary">Lily Coleman<h8 class="p-3 text-black">(Jun 2020)</h8></h6>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <p class="mt-3 mb-4 pb-2">-->
<!--                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod-->
<!--                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,-->
<!--                            quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.-->
<!--                        </p>-->


                    </div>
                    <?php if (isset($_SESSION['username'])): ?>
                    <form method="post" action="post.php?post_id=<?php echo $id;?>">

                        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">

                            <div class="d-flex flex-start w-100">

                                <div class="form-outline w-100">
                                    <textarea class="form-control" id="" placeholder="write message" rows="4" name="comment"></textarea>

                                </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm mb-3">Post comment</button>
                            </div>
                        </div>
                    </form>
                    <?php else:?>
                    <div class="bg-danger alert alert-danger text-white">
                        Login to comment
                    </div>
                    <?php endif;?>

                </div>
            </div>
        </div>
    </div>
</section>
<?php require '../includes/footer.php'?>