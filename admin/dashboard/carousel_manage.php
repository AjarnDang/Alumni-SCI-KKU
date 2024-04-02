<?php
include('header_dashboard.php');
require_once('../../template/pagination_function.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
  header('location:../../login-system/login_form.php');
} else {

if (isset($_POST['submit'])) {
  $imgfile = $_FILES["postimage"]["name"];
  $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
  $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

  if (!in_array($extension, $allowed_extensions)) {
    echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
  } else {
    $imgnewfile = md5($imgfile) . $extension;
    move_uploaded_file($_FILES["postimage"]["tmp_name"], "../../assets/img/slider/" . $imgnewfile);

    $query = mysqli_query($conn, "INSERT into tb_slider(slider) values('$imgnewfile')");

    if ($query) {
      $msg = "เพิ่มรูปภาพเสร็จสิ้น";
    } else {
      $error = "มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";
    }
  }
}
if(isset($_POST['update_image'])) {
  $id = $_POST['id'];
  $imgfile = $_FILES["postimage"]["name"];
  $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
  $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

  if (!in_array($extension, $allowed_extensions)) {
      echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
  } else {
      $imgnewfile = md5($imgfile) . $extension;
      move_uploaded_file($_FILES["postimage"]["tmp_name"], "../../assets/img/slider/" . $imgnewfile);    
      $query=mysqli_query($conn,"UPDATE tb_slider 
                                    SET slider = '$imgnewfile'
                                  where id='$id'
                                  "); 
  if ($query) {
    $msg = "อัปเดตรูปภาพเสร็จสิ้น";
  } else {
    $error = "มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";
  }                                                     
  } 
}
if(isset($_POST['delete_image'])) {
  $id = $_POST['id'];
  $query = mysqli_query($conn,"DELETE from tb_slider
                               where id='$id'
                            "); 
  if ($query) {
    $msg = "ลบรูปภาพเสร็จสิ้น";
  } else {
    $error = "มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";
  }                                                   
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<link href="../../assets/css/defaultDashboard.css" rel="stylesheet">
<style> a {text-decoration: none;}</style>
<body>
  <div class="container-fluid">
    <div class="bread-crump pt-2">
      <a href="adminDashboard.php">แดชบอร์ด</a> >
      <a href="#">จัดการหน้าเว็บไซต์</a> 
    </div>
    <div class="pt-2 d-flex justify-content-between">
		    <div><strong style="font-size: 40px;">จัดการหน้าเว็บไซต์</strong></div>

	    </div>
      <hr>
    <div class="row"> 

      <div class="col-lg-12">  
          <!---Success Message---> <?php if($msg){ ?>
          <div class="alert alert-success" role="alert">
            <strong>สำเร็จ!</strong> <?php echo htmlentities($msg);?>
          </div> <?php } ?>

          <!---Error Message---> <?php if($error){ ?>
          <div class="alert alert-danger" role="alert">
            <strong>ขออภัย</strong> <?php echo htmlentities($error);?>
          </div> <?php } ?>
      </div>

      <div class="col-md-12 col-xs-12 mt-2">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <?php
            $query = "SELECT * FROM tb_slider ORDER BY id DESC";
            $result = mysqli_query($conn, $query);

            $i = 0;
            foreach ($result as $row) {
              $actives = '';
              if ($i == 0) {
                $actives = 'active';
              } ?>
              <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php echo $actives; ?>"></li>
            <?php $i++;
            } ?>
          </ol>
          <div class="carousel-inner">
            <?php
            $i = 0;
            foreach ($result as $row) {
              $actives = '';
              if ($i == 0) {
                $actives = 'active';
              } ?>
              <div class="carousel-item <?php echo $actives; ?>">
                <a href="https://www.youtube.com/c/devbanban" target="_blank">
                  <img class="d-block w-100 rounded" src="../../assets/img/slider/<?php echo $row['slider']; ?>" alt="devbanban">
                </a>
              </div>
            <?php $i++; } ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </div>

      <div class="col-12 mt-4">
        <div class="card">
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <input type="file" class="form-control" id="postimage" name="postimage" required>
              <button type="submit" name="submit" class="btn btn-success mt-2">
                ยืนยัน
              </button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <p><a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                คำแนะนำ
            </a></p>
              <div class="collapse" id="collapseExample">
                <div class="card card-body p-0 pt-3">
                  <ol class="list-group-numbered">
                    <li class="list-group-item">ขนาดรูปภาพแนะนำ สูง:1888px กว้าง:5212px</li>
                    <li class="list-group-item">หากความสูงรูปภาพเกิน ข้อ 1. ความสูงที่เกินจะไม่แสดงผล</li>
                  </ol>
                </div>
              </div>
            <table class="table table-borderless">
              <thead class="thead-light">
                <tr>
                  <td>รูปภาพ</td>
                  <td>ชื่อไฟล์</td>
                  <td>แอ็คชั่น</td>
                </tr>
              </thead>
              <tbody>
                <?php 
                $query = "SELECT * FROM tb_slider ORDER BY id DESC";
                $result = mysqli_query($conn, $query);
                while($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td style="width: 30%;"><img src="../../assets/img/slider/<?php echo $row['slider'] ?>" alt="image" width="400" class="rounded"></td>
                  <td style="width: 50%;"><?php echo htmlentities($row['slider']) ?></td>
                  <td style="width: 20%;">
                    <!-- แก้ใข -->
                    <button type="button" class="btn btn-warning" data-toggle="modal" 
                      data-target="#exampleModalCenter<?php echo $row['id'] ?>">
                      แก้ใข
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle<?php echo ($row['id']);?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="exampleModalLongTitle">
                                        แก้ใขรูปภาพ
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" enctype="multipart/form-data">  
                                  <div class="modal-body">                                 
                                      <?php
                                      $edit=mysqli_query($conn,"SELECT * from tb_slider 
                                                                where id='".$row['id']."'");
                                      $erow=mysqli_fetch_array($edit); ?>               
                                    <div class="row">
                                      <div class="col-lg-12">
                                        <input type="hidden" name="id" value="<?php echo $erow['id']; ?>">
                                        <img src="../../assets/img/slider/<?php echo $row['slider']; ?>" alt="image" class="rounded" width="100%">
                                        <input type="file" name="postimage" class="from-control-file mt-2">
                                      </div>
                                    </div>                                                       
                                  </div>
                                  <div class="modal-footer">                   
                                    <button type="button" class="btn btn-secondary border-0" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" name="update_image" class="btn btn-success border-0">ยืนยัน</button>
                                  </div>
                                </form>    
                            </div>
                        </div>
                    </div>

                    <!-- ลบ -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" 
                      data-target="#exampleModalCenter2<?php echo $row['id'] ?>">
                      ลบ
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter2<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle<?php echo ($row['id']);?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="exampleModalLongTitle">
                                        ลบรูปภาพ
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" enctype="multipart/form-data">  
                                  <div class="modal-body">                                 
                                      <?php
                                      $delete=mysqli_query($conn,"SELECT * from tb_slider 
                                                                where id='".$row['id']."'");
                                      $drow=mysqli_fetch_array($delete); ?>               
                                    <div class="row">
                                      <div class="col-lg-12">
                                        <input type="hidden" name="id" value="<?php echo $drow['id']; ?>">
                                        <h5 class="text-center">ยืนยันการลบข้อมูล</h5>
                                      </div>
                                    </div>                                                       
                                  </div>
                                  <div class="modal-footer d-flex justify-content-between">
                                      <div class="float-left text-muted text-smaller">อ้างอิงไอดี : [<?php echo $drow['id']; ?>]</div>
                                      <div>
                                        <button type="button" class="btn btn-secondary border-0" data-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" name="delete_image" class="btn btn-success border-0">ยืนยัน</button>
                                      </div>
                                  </div>
                                </form>    
                            </div>
                        </div>
                    </div>
                  </td>
                </tr>
            <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div><!-- row -->
  </div><!-- container -->

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <?php include('DashboardScript.php') ?>                
</body>
</html>
<?php } ?>