<?php include "../layouts/header.php";?>
<?php include "../../config/config.php";?>
<?php
if(!isset($_SESSION['admin_name'])) {
    header('location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}

$select_categories = $conn->query("select * from categories" );
$select_categories->execute();
$categories = $select_categories->fetchAll(PDO::FETCH_OBJ);
?>

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Categories</h5>
             <a  href="http://localhost/clean-blog/admin-panel/categories-admins/create-category.php" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">update</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>

                <?php foreach ($categories as $category):?>
                    <tr>
                        <th scope="row"><?php echo $category->id;?></th>
                        <td><?php echo $category->name;?></td>
                        <td><a href="http://localhost/clean-blog/admin-panel/categories-admins/update-category.php?upd_id=<?php echo $category->id;?>" class="btn btn-warning text-white text-center ">Update Categories</a></td>
                        <td><a href="http://localhost/clean-blog/admin-panel/categories-admins/delete-category.php?del_id=<?php echo $category->id;?>" class="btn btn-danger  text-center ">Delete Categories</a></td>
                    </tr>
                <?php endforeach;?>

                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



<?php include "../layouts/footer.php";?>