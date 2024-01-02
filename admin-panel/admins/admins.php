<?php include "../layouts/header.php";?>
<?php include "../../config/config.php";?>

<?php
if(!isset($_SESSION['admin_name'])) {
    header('location: http://localhost/clean-blog/admin-panel/admins/login-admins.php');
}
$select_admins = $conn->query("select * from admins" );
$select_admins->execute();
$admins = $select_admins->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a href="http://localhost/clean-blog/admin-panel/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                <tbody>

                <?php foreach ($admins as $admin): ?>
                  <tr>
                    <th scope="row"><?php echo $admin->id ?></th>
                    <td><?php echo $admin->admin_name ?></td>
                    <td><?php echo $admin->email ?></td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



  </div>
<script type="text/javascript">

</script>
</body>
</html>