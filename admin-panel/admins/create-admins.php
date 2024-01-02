
<?php include "../layouts/header.php";?>
<?php include "../../config/config.php";?>

<?php
if(isset($_POST['submit'])) {
    if(empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])) {
        echo '
                <div class="alert alert-danger text-center" role="alert">
                    enter data please
                </div>';
    } else {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = "INSERT INTO admins (email, admin_name, password) VALUES (:email, :username, :password)";
        $stmt = $conn->prepare($insert_query);
        $stmt->execute([
            ':email' => $email,
            ':username' => $username,
            ':password' => $hashed_password,
        ]);

        if($stmt) {
            echo "<script>alert('Registration successful')</script>";
            // Redirect to a success page or any other desired location
            header("Location: http://localhost/clean-blog/admin-panel/admins/admins.php");
//            exit();
        } else {
            echo "<script>alert('Registration failed')</script>";
        }
    }
}
?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php include "../layouts/footer.php";?>
