<?php require "../includes/header.php"?>
<?php require "../config/config.php"?>
<?php
global $conn;
// first query
if(isset($_GET['upd_id'])) {

        $id = $_GET['upd_id'];

//        First query
        $select = $conn->prepare("select * from posts where id = :id");
        $select->execute([
            ':id'=> $id,
        ]);
        $rows = $select->fetch(PDO::FETCH_OBJ);

    if($_SESSION['user_id'] != $rows->user_id) {
        header("location: http://localhost/clean-blog/index.php");
    }
} else {
    header("location: http://localhost/clean-blog/404.php");
}
// second query

if(isset($_POST['submit'])) {

        if(empty($_POST['title']) || empty($_POST['subtitle']) || empty($_POST['body'])) {
            echo '
                <div class="alert alert-danger text-center" role="alert">
                    enter data please
                </div>';
        } else {

            unlink("images/". $rows->img. "");

            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $body = $_POST['body'];
            $img = $_FILES['img']['name'];
            $dir = 'images/' . basename($img);


            $update = "UPDATE posts SET title = :title, subtitle = :subtitle, body = :body, img = :img WHERE id = :id";
            $stmt = $conn->prepare($update);
            $stmt->execute([
                ':title'=> $title,
                ':subtitle'=> $subtitle,
                ':body'=> $body,
                ':img'=> $img,
                ':id'=> $id,
            ]);
            if(move_uploaded_file($_FILES['img']['tmp_name'],$dir)) {
                header("location: http://localhost/clean-blog/index.php");
            }
        }

} else {
    header("location: http://localhost/clean-blog/404.php");
}
?>
            <form method="POST" action="update.php?upd_id=<?php echo $rows->id?>" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" value="<?php echo $rows-> title;?>" id="form2Example1" class="form-control" placeholder="title" />

              </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" value="<?php echo $rows-> subtitle;?>" id="form2Example1" class="form-control" placeholder="subtitle" />
            </div>

              <div class="form-outline mb-4">
                <input type="text" name="body" value="<?php echo $rows-> body;?>" id="form2Example1" class="form-control" placeholder="body" />
            </div>

                <?php
                echo "<img src='images/".$rows->img."' width=900px height=300px>";
                ?>

                <div class="form-outline mb-4">
                <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>


            </form>



<?php require "../includes/footer.php"?>

