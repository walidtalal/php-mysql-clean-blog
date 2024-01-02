<?php require '../includes/header.php'; ?>
<?php require '../config/config.php'; ?>

<?php

if(isset($_SESSION['username'])) {
    header("location: http://localhost/clean-blog/index.php");
    exit();
}

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

        $insert_query = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
        $stmt = $conn->prepare($insert_query);
        $stmt->execute([
            ':email' => $email,
            ':username' => $username,
            ':password' => $hashed_password,
        ]);

        if($stmt) {
            echo "<script>alert('Registration successful')</script>";
            // Redirect to a success page or any other desired location
            header("Location: login.php");
//            exit();
        } else {
            echo "<script>alert('Registration failed')</script>";
        }
    }
}
?>

            <form method="POST" action="register.php">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="username" id="form2Example1" class="form-control" placeholder="Username" />
               
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                
              </div>



              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>

              <!-- Register buttons -->
              <div class="text-center">
                <p>Aleardy a member? <a href="login.php">Login</a></p>
                

               
              </div>
            </form>
<?php require '../includes/footer.php'; ?>
