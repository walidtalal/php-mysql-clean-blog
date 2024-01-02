<?php include "../layouts/header.php";?>
<?php include "../../config/config.php";?>

<?php


//check for the submit

//take the data

//write our query

//execute and then fetch

//do our rowCount

//to do our password_verify + redirect to the index page

if(isset($_SESSION['admin_name'])) {
    header('location: http://localhost/clean-blog/admin-panel/index.php');
}

if(isset($_POST['submit'])) {
    if($_POST['email'] == '' OR $_POST['password'] == '') {
        echo "<div class='alert alert-danger text-center  role='alert'>
                  enter data into the inputs
              </div>";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $conn->query("SELECT * FROM admins WHERE email = '$email'");

        $login->execute();

        $row = $login->FETCH(PDO::FETCH_ASSOC);

        if($login->rowCount() > 0) {

            if(password_verify($password, $row['password'])){
//            if($password == $row['password']){


                $_SESSION['admin_name'] = $row['admin_name'];
                $_SESSION['admin_id'] = $row['id'];


                header('location: http://localhost/clean-blog/admin-panel/index.php');
            } else {

                echo "<div class='alert alert-danger  text-center text-white role='alert'>
                            the email or password is wrong
                        </div>";
            }


        } else {

            echo "<div class='alert alert-danger  text-center  role='alert'>
                        the email or password is wrong
                    </div>";
        }
    }
}




?>

<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5">Login</h5>
              <form method="POST" class="p-auto" action="login-admins.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                 
                </form>

            </div>
       </div>
     </div>
    </div>
<?php include "../layouts/footer.php";?>
