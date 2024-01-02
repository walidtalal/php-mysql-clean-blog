<?php require "../includes/header.php"?>
<?php require "../config/config.php"?>
<?php
global $conn;
// first query
if(isset($_GET['prof_id'])) {

    $id = $_GET['prof_id'];

//        First query
    $select = $conn->prepare("select * from users where id = :id");
    $select->execute([
        ':id'=> $id,
    ]);
    $rows = $select->fetch(PDO::FETCH_OBJ);

    if($_SESSION['user_id'] != $rows->id) {
        header("location: http://localhost/clean-blog/index.php");
    }
} else {
    header("location: http://localhost/clean-blog/404.php");
}
// second query

if(isset($_POST['submit'])) {

    if(empty($_POST['email']) || empty($_POST['username'])) {
        echo "<script>alert('one or more input s empty')</script>";
    } else {
        $email = $_POST['email'];
        $username = $_POST['username'];


        $update = "UPDATE users SET email = :email, username = :username WHERE id = :id";
        $stmt = $conn->prepare($update);
        $stmt->execute([
            ':email'=> $email,
            ':username'=> $username,
            ':id'=> $id,
        ]);
        header("location: http://localhost/clean-blog/users/profile.php?prof_id=".$_SESSION['user_id']);
        exit();
    }

}
?>
<form method="POST" action="profile.php?prof_id=<?php echo $rows->id;?>" enctype="multipart/form-data">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" value="<?php echo $rows->email;?>" id="form2Example1" class="form-control" placeholder="email" />

    </div>

    <div class="form-outline mb-4">
        <input type="text" name="username" value="<?php echo $rows->username;?>" id="form2Example1" class="form-control" placeholder="username" />
    </div>

    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>


</form>



<?php require "../includes/footer.php"?>

