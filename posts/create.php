<?php include "../includes/header.php";?>
<?php include "../config/config.php";?>

<?php
global $conn;

$categories = $conn->query("select * from categories");
$categories->execute();
$category = $categories->fetchAll(PDO::FETCH_OBJ);

    if(isset($_POST['submit'])) {
        if(empty($_POST['title']) || empty($_POST['category_id']) || empty($_POST['subtitle']) || empty($_POST['body']) || empty($_FILES['img'])) {
            echo '
                <div class="alert alert-danger text-center" role="alert">
                    enter data please
                </div>';
        } else {
            $title = $_POST['title'];
            $subtitle = $_POST['subtitle'];
            $body = $_POST['body'];
            $category_id = $_POST['category_id'];
            $img = $_FILES['img']['name'];

            $id = $_SESSION['user_id'];
            $user_name = $_SESSION['username'];

            $dir = 'images/' . basename($img);
            $insert = "insert into posts (title, subtitle, body, img, user_id, category_id, username) values (:title, :subtitle, :body, :img, :category_id, :user_id, :username)";
            $stmt = $conn->prepare($insert);
            $stmt->execute([
                    ':title'=> $title,
                    ':subtitle'=> $subtitle,
                    ':body'=> $body,
                    ':category_id'=> $category_id,
                    ':img'=> $img,
                    ':user_id'=> $id,
                    ':username'=> $user_name,
            ]);
            if(move_uploaded_file($_FILES['img']['tmp_name'],$dir)) {
                header("location: http://localhost/clean-blog/index.php");
            }
        }
    }

?>

            <form method="POST" action="create.php" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" id="form2Example1" class="form-control" placeholder="subtitle" />
            </div>

              <div class="form-outline mb-4">
                <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"></textarea>
            </div>
                <div class="form-outline mb-4">
                    <select name="category_id" class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <?php foreach ($category as $cat):?>
                        <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>

             <div class="form-outline mb-4">
                <input type="file" name="img" id="form2Example1" class="form-control" placeholder="image" />
            </div>


              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
            </form>



<?php include "../includes/footer.php";?>
