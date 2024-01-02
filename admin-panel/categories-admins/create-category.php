    <?php include "../layouts/header.php";?>
    <?php include "../../config/config.php";?>
    <?php
    if(!isset($_SESSION['admin_name'])) {
        header('location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
    }
        if(isset($_POST['submit'])) {
            if(empty($_POST['name'])) {
                echo '
                    <div class="alert alert-danger text-center" role="alert">
                        enter data please
                    </div>';
            } else {
                $name = $_POST['name'];

                $insert = "insert into categories (name) values (:name)";
                $stmt = $conn->prepare($insert);
                $stmt->execute([
                    ':name'=> $name
                ]);

                header("location: http://localhost/clean-blog/admin-panel/categories-admins/show-categories.php");

            }
        }
    ?>
           <div class="row">
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-5 d-inline">Create Categories</h5>
              <form method="POST" action="create-category.php" enctype="multipart/form-data">
                    <!-- Email input -->
                    <div class="form-outline mb-4 mt-4">
                      <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />

                    </div>


                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


                  </form>

                </div>
              </div>
            </div>
          </div>
    <?php include "../layouts/footer.php";?>