<?php include "../layouts/header.php";?>
<?php include "../../config/config.php";?>

<?php

if(!isset($_SESSION['admin_name'])) {
    header('location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}

    if(isset($_GET['upd_id'])) {
        $id = $_GET['upd_id'];

        //        First query
            $select = $conn->prepare("select * from categories where id = :id");
            $select->execute([
                ':id'=> $id,
            ]);
            $rows = $select->fetch(PDO::FETCH_OBJ);
    } else {
        header("location: http://localhost/clean-blog/404.php");
    }

    //        Second query
//    if(isset($_POST['submit'])) {
//    if(empty($_POST['name'])) {
//        echo '<div class="alert alert-danger text-center" role="alert">
//                        enter data please
//                    </div>';
//    } else {
//        $name = $_POST['name'];
//        $update = "UPDATE categories SET name = :name WHERE id = :id";
//        $stmt = $conn->prepare($update);
//        $stmt->execute([
//            ':name'=> $name,
//            ':id'=> $id,
//        ]);
//        header("location: http://localhost/clean-blog/admin-panel/categories-admins/show-categories.php");
//        }
//    } else {
//        header("location: http://localhost/clean-blog/404.php");
//    }





// second query

if(isset($_POST['submit'])) {
    if(empty($_POST['name'])) {
        echo '<div class="alert alert-danger text-center" role="alert">
                    Enter data, please.
                </div>';
    } else {
        $name = $_POST['name'];
        $update = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $conn->prepare($update);
        $stmt->execute([
            ':name'=> $name,
            ':id'=> $id,
        ]);
        header("Location: http://localhost/clean-blog/admin-panel/categories-admins/show-categories.php");
        exit();
    }
}
?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="update-category.php?upd_id=<?php echo $rows->id;?>" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" value="<?php echo $rows->name;?>" class="form-control" placeholder="name" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php include "../layouts/footer.php";?>
