<?php	
include('header_user.php'); 
error_reporting(0);
if(strlen($_SESSION['username'])=='member') { 
  header('location:../login-system/login_form.php');
} else {   
 if(isset($_POST['submit'])) {
  $imgfile=$_FILES["postimage"]["name"];
        
  // get the image extension
  $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
  
  // allowed extensions
  $allowed_extensions = array(".jpg","jpeg",".png",".gif");
  
  // Validation for allowed extensions .in_array() function searches an array for a specific value.
  if(!in_array($extension,$allowed_extensions)) {
      echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
  } else {

      //rename the image file
      $imgnewfile=md5($imgfile).$extension;

      // Code for move image into directory
      move_uploaded_file($_FILES["postimage"]["tmp_name"],"../admin/dashbaord/postimages/".$imgnewfile);

      $postid=intval($_GET['id']);
      $query=mysqli_query($conn,"UPDATE community_topic 
                                    set PostImage='$imgnewfile',
                                        UpdationDate=now()
                                  where id='$postid'
                                ");
      if($query) {
          $msg="อัปเดตรูปภาพเสร็จสิ้น";
      } else{
          $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
      } 
  }
 } 
 if(isset($_POST['delete'])) {
    $postid=intval($_GET['id']);
    $imgfile="";
    $query=mysqli_query($conn,"UPDATE community_topic 
                                  set PostImage='$imgfile',
                                      UpdationDate=now()
                                where id='$postid'
                                ");
      if($query) {
          $msg="ลบรูปภาพเสร็จสิ้น";
      } else{
          $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
      } 
 }
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../assets/css/community.css">
<body>
<div class="new-background">
<div id="banner" style="background-image: url('../assets/img/decoration-img/kku-darker.jpg');">
        <div class="container">
            <div class="topic">
                <!--<h1>&lt;GTCoding/&gt;</h1>-->    
                <h1 style="color:white;"><b>คอมมูนิตี้</b></h1>               
            </div>
        </div>
    </div>
  </div>
<div class="container">
  <div class="nav-point my-4">
    <a class="text-black" href="user_home.php">หน้าหลัก</a> >
    <a class="text-black" href="community.php">คอมมูนิตี้</a> >
    <a class="text-black" href="#">แก้ใขหัวข้อ</a> >
    <a class="text-black" href="#">แก้ใขรูปภาพ</a> 
  </div>  

  <div class="row mt-4">
        <div class="col-lg-6"> 

        <!---Success Message--->  
        <?php if($msg){ ?>
            <div class="alert alert-success" role="alert">
            <strong>สำเร็จ!</strong> <?php echo htmlentities($msg);?>
            </div>
        <?php } ?>

        <!---Error Message--->
        <?php if($error){ ?>
            <div class="alert alert-danger" role="alert">
            <strong>ขออภัย</strong> <?php echo htmlentities($error);?>
            </div>
        <?php } ?>

        </div>
    </div>
     <?php 
     $postid=intval($_GET['id']);
     $edit=mysqli_query($conn,"SELECT * from community_topic 
                               where id ='$postid'
                               and Is_Active = 1
                               ");
					 while($row = mysqli_fetch_array($edit)){ ?>
    <div class="row">
      <div class="col-6">       
      <div class="card">
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">       
            <img src="../admin/dashboard/postimages/<?php echo $row['PostImage']; ?>" alt="" width="100%" class="rounded">   
              <div class="mt-2">  
                <input id="f02" name="postimage" type="file" require/>
                        
                        <label for="f02">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16"><path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/><path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/></svg>
                            <span name="old" value="<?php echo($row['PostImage']);?>">เปลี่ยนรูปภาพ</span> 
                        </label>             
              </div>
              <?php } ?>
              <button type="submit" name="submit" class="btn btn-warning text-black border-0 mt-3">อัปเดต</button>
              <button type="submit" name="delete" class="btn btn-danger text-black border-0 mt-3">ลบรูปภาพ</button>       
          </form> 
        </div>     
      </div>    
      </div>
    </div>
      
  
</div>
</body>
<?php require('../template/footer_users.php'); ?>
<?php } ?>