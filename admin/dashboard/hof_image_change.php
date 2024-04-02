<?php 
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {   
    if(isset($_POST['update'])) {
        $imgfile            =$_FILES["hof_image"]["name"];
        $imgfile_3          =$_FILES["hof_image_cover"]["name"];
        $imgfile_2          =$_FILES["hof_image_2"]["name"];
        
        $extension   = substr($imgfile,  strlen($imgfile)  -4,strlen($imgfile));
        $extension_2 = substr($imgfile_2,strlen($imgfile_2)-4,strlen($imgfile_2));
        $extension_3 = substr($imgfile_3,strlen($imgfile_3)-4,strlen($imgfile_3));

        $allowed_extensions = array(".jpg","jpeg",".png",".gif");

        if ($_FILES[$extension]['size'] == 0 && $_FILES[$extension]['error'] == 0){
            if(!in_array($extension,$allowed_extensions)) {
                echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            } 
        }
        if ($_FILES[$extension_2]['size'] == 0 && $_FILES[$extension_2]['error'] == 0){
            if(!in_array($extension_2,$allowed_extensions)) {
                echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            } 
        }
        if ($_FILES[$extension_3]['size'] == 0 && $_FILES[$extension_3]['error'] == 0){
            if(!in_array($extension_3,$allowed_extensions)) {
                echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            } 
        }
        else {
            $imgnewfile=md5($imgfile).$extension;
            move_uploaded_file($_FILES["hof_image"]["tmp_name"],"postimages/".$imgnewfile);

            $imgnewfile_3=md5($imgfile_3).$extension;
            move_uploaded_file($_FILES["hof_image_cover"]["tmp_name"],"postimages/".$imgnewfile_3);

            $imgnewfile_2=md5($imgfile_2).$extension;
            move_uploaded_file($_FILES["hof_image_2"]["tmp_name"],"postimages/".$imgnewfile_2);
           

            $postid=intval($_GET['pid']);
            $query=mysqli_query($conn,"UPDATE hall_of_fame 
                                          set hof_image         ='$imgnewfile',
                                              hof_image_cover   ='$imgnewfile_3',
                                              hof_image_2       ='$imgnewfile_2'
                                        where id='$postid'
                                        ");
                if($query) {
                    $msg="Image updated";
                } else{
                    $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
                } 
            }
        }
    ?>
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
<link href="../plugins/summernote/summernote.css" rel="stylesheet" />
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
<link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
<link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
<script src="assets/js/modernizr.min.js"></script>
<style> a {text-decoration: none;}</style>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<body>
<div class="container-fluid">
    <div class="bread-crump pt-2">
        <a href="adminDashboard.php">แดชบอร์ด</a> >
        <a href="#">ศิษย์เก่าดีเด่น</a> >
        <a href="hof_dashboard.php">จัดการศิษย์เก่าดีเด่น</a> >
        <a href="#">แก้ใขศิษย์เก่าดีเด่น</a> >
        <a href="#">แก้ใขรูปภาพศิษย์เก่าดีเด่น</a> 
    </div>
    <div class="pt-2 header-product">
		<strong>แก้ใขรูปภาพศิษย์เก่าดีเด่น</strong>
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

    <form name="addpost" method="post" enctype="multipart/form-data">
        <?php
        $postid=intval($_GET['pid']);
        $query=mysqli_query($conn,"SELECT *
                                     from hall_of_fame
                                    where id='$postid'
                                      and Is_Active=1
                                      ");
        while($row=mysqli_fetch_array($query)) { ?>
            <div class="row justify-content-center">
                <div class="col-md-10 col-md-offset-1">
                    <div class="p-6">
                    
                    <form name="addpost" method="post">
                        <div class="form-group m-b-20">
                            <label for="exampleInputEmail1">ศิษย์เก่าดีเด่น</label>
                            <input type="text" class="form-control" id="posttitle" 
                                    value="<?php echo htmlentities($row['hof_prefix'].' '.$row['hof_firstname'].' '.$row['hof_lastname']);?>" 
                                    name="posttitle"  readonly>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-4">
                                <div class="card-box"><label for="header-title">รูปภาพประจำตัว</label><br>                             
                                <img src="postimages/<?php echo htmlentities($row['hof_image']);?>" class="hof-image img-fluid img-thumbnail rounded"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card-box"><label for="header-title">รูปภาพพื้นหลัง</label><br>                           
                                <img src="postimages/<?php echo htmlentities($row['hof_image_cover']);?>" class="hof-image img-fluid img-thumbnail rounded"/>
                                </div>
                            </div>
                            <div class="col-sm-4">                           
                                <div class="card-box"><label for="header-title">รูปภาพเพิ่มเติม</label><br>                             
                                <img src="postimages/<?php echo htmlentities($row['hof_image_2']);?>" class="hof-image img-fluid img-thumbnail rounded"/>
                                </div>
                            </div>                         
                        </div>

        <?php } ?>

                        <div class="row mt-3">
                            <div class="col-sm-4">
                                <div class="card-box">
                                <input type="file" class="form-control" name="hof_image">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card-box">
                                <input type="file" class="form-control" name="hof_image_cover">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card-box">
                                <input type="file" class="form-control" name="hof_image_2">
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="update" class="btn btn-success waves-effect waves-light my-4">
                            Update
                        </button>
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