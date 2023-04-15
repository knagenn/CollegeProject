<?php
require 'header.inc.php';

if(isset($_GET['type'])){
  $id=$_GET['id'];
  if($_GET['operation'] == "Delete"){
      $sql=mysqli_query($con,"DELETE FROM `users` WHERE id='$id'");
      redirect('users.php');
  }elseif($_GET['operation']=="Deactive"){
      $sql=mysqli_query($con,"update users set status='0' WHERE id='$id'");
      redirect('users.php');
  }elseif($_GET['operation']=="Active"){
      $sql=mysqli_query($con,"update users set status='1' WHERE id='$id'");
      redirect('users.php');
  }else{

  }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User Manager</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- /.row -->
      <div class="row">
        <div class="col-12 show_div">
          <div class="card">
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query=mysqli_query($con,"select * from users");
                    $i=1;
                    while($list=mysqli_fetch_assoc($query)){
                  ?>
                  <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $list['name'] ?></td>
                    <td><?php echo $list['email'] ?></td>
                    <td><?php echo $list['phone'] ?></td>
                    <td>
                      <?php
                       if($list['status']==1){
                        ?>
                      <a href="?type=status&operation=Deactive&id=<?php echo $list['id'] ?>"
                        class="badge bg-success">Active</a>
                      <?php
                       }elseif($list['status']==0){
                        ?>
                      <a href="?type=status&operation=Active&id=<?php echo $list['id'] ?>"
                        class="badge bg-danger">Deactive</a>
                      <?php
                       }else{

                       }
                      ?>
                      <a href="?type=status&operation=Delete&id=<?php echo $list['id'] ?>" class="badge bg-danger">Delete</a>
                    </td>
                  </tr>
                  <?php
                      }
                    ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
    </div>
</div>
</section>
</div>

<?php
  require 'footer.inc.php';
?>