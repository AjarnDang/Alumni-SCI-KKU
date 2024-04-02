<?php 
include('header_dashboard.php');
error_reporting(0);
$postid=intval($_GET['id']);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
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

<link href="../plugins/summernote/summernote.css" rel="stylesheet" />
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
<link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
<link href="assets/css/components.css" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
<script src="assets/js/modernizr.min.js"></script>
<style> a {text-decoration: none;}</style>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<body>

<div class="container-fluid">
    <div class="bread-crump pt-2">
        <a href="adminDashboard.php">แดชบอร์ด</a> >
        <a href="#">คอมมูนิตี้</a> >
        <a href="news_news_manage.php">จัดการคอมมูนิตี้</a> >
        <a href="#">แก้ใขคอมมูนิตี้</a> >
        <a href="#">แก้ใขรูปภาพคอมมูนิตี้</a> 
    </div>
    <div class="pt-2 header-product">
		<strong>แก้ใขรูปภาพคอมมูนิตี้</strong>
	</div>
    <hr />

    <div class="row justify-content-center">
        <div class="col-lg-10"> 

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
            <div class="row justify-content-center">
                <div class="col-md-10 col-md-offset-1">
                    <div class="p-6">
                        <div class="form-group m-b-20">
                            <label for="exampleInputEmail1">หัวข้อ/โพสต์</label>
                            <input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['PostTitle']);?>" name="posttitle"  readonly>
                        </div>

                        <form method="POST" enctype="multipart/form-data"> 
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <div class="card-box">
                                <h4 class="m-b-30 m-t-0 header-title"><b>รูปภาพปัจจุบัน</b></h4>
                                <?php if($row['PostImage'] == "") {
                                    echo "หัวข้อ/โพสต์นี้ไม่มีรูปภาพ";
                                } else { ?>
                                    <img src="postimages/<?php echo htmlentities($row['PostImage']);?>" width="600" class="rounded"/>
                                <?php } ?>
                                <br />
                                </div>
                            </div>
                        </div>
                        
                                          
                        <div class="row mt-5">
                            <div class="col-sm-12">
                                <div class="card-box">
                                <h4 class="m-b-30 m-t-0 header-title"><b>รูปภาพใหม่</b></h4>
                                <input type="file" class="form-control" id="postimage" name="postimage" required>
                                </div>
                            </div>
                        </div>
                        <?php } ?>  
                        <div class="mb-4">              
                            <button type="submit" name="submit" class="btn btn-warning text-black border-0 mt-3">อัปเดต</button>
                            <button type="submit" name="delete" class="btn btn-danger text-black border-0 mt-3">ลบรูปภาพ</button> 
                        </div>
                        </form>            
                    </div>
                </div>
            </div>       
                                    
    </div>
    <script> var resizefunc = []; </script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>
        <script src="../plugins/summernote/summernote.min.js"></script>
        <script src="../plugins/select2/js/select2.min.js"></script>
        <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>
        <script src="assets/pages/jquery.blog-add.init.js"></script>
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            jQuery(document).ready(function(){

                $('.summernote').summernote({
                    height: 240,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });
                // Select2
                $(".select2").select2();

                $(".select2-limiting").select2({
                    maximumSelectionLength: 2
                });
            });
        </script>

    <script src="../plugins/switchery/switchery.min.js"></script>
    <script src="../plugins/summernote/summernote.min.js"></script>

    <?php include('DashboardScript.php') ?>
</body>
<?php } ?>