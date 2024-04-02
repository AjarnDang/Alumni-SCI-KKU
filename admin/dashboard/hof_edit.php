<?php 
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login-form.php');
}else{ 
    // adding post  
     if(isset($_POST['update'])) {
        $hof_prefix         =$_POST['hof_prefix'];
        $hof_firstname      =$_POST['hof_firstname'];
        $hof_lastname       =$_POST['hof_lastname'];
        $hof_position       =$_POST['hof_position'];
        $hof_date_of_birth  =date('Y-m-d', strtotime($_POST['hof_date_of_birth']));
        $hof_description    =$_POST['hof_description'];
        $hof_history        =$_POST['hof_history'];
        $hof_mastery        =$_POST['hof_mastery'];
        $hof_mastery_2      =$_POST['hof_mastery_2'];
        $hof_mastery_3      =$_POST['hof_mastery_3'];
        $hof_mastery_4      =$_POST['hof_mastery_4'];
        $hof_mastery_5      =$_POST['hof_mastery_5'];
        $hof_reward         =$_POST['hof_reward'];
        $hof_reward_2       =$_POST['hof_reward_2'];
        $hof_reward_3       =$_POST['hof_reward_3'];
        $hof_reward_4       =$_POST['hof_reward_4'];
        $hof_reward_5       =$_POST['hof_reward_5'];
        $hof_year           =$_POST["hof_year"];

        $status=1;
        $postid=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE hall_of_fame 
                                      set hof_prefix       ='$hof_prefix',
                                          hof_firstname       ='$hof_firstname',
                                          hof_lastname        ='$hof_lastname',
                                          hof_position        ='$hof_position',
                                          hof_date_of_birth   ='$hof_date_of_birth',
                                          hof_description     ='$hof_description',
                                          hof_history         ='$hof_history',
                                          hof_mastery         ='$hof_mastery',
                                          hof_mastery_2       ='$hof_mastery_2',
                                          hof_mastery_3       ='$hof_mastery_3',
                                          hof_mastery_4       ='$hof_mastery_4',
                                          hof_mastery_5       ='$hof_mastery_5',
                                          hof_reward          ='$hof_reward',
                                          hof_reward_2        ='$hof_reward_2',
                                          hof_reward_3        ='$hof_reward_3',
                                          hof_reward_4        ='$hof_reward_4',
                                          hof_reward_5        ='$hof_reward_5',
                                          hof_year            ='$hof_year',
                                          Is_Active           =1,
                                          hof_image,          ='$imgnewfile',
                                          hof_image_2         ='$imgnewfile_2',
                                          hof_image_cover     ='$imgnewfile_3',
                                          where  id                  ='$postid'
                                                            ");
            if($query) {
                $msg="Updated Successfully";
            } else {
                $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
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

<link href="../../assets/css/defaultDashboard.css" rel="stylesheet" >
<style> a {text-decoration: none;}</style>
<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ศิษย์เก่าดีเด่น</a> >
            <a href=" ">เพิ่มศิษย์เก่าดีเด่น</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>เพิ่มศิษย์เก่าดีเด่น</strong>
	    </div>
        <hr />      

        <div class="row justify-content-center">

            <div class="col-lg-10">  
                <!---Success Message---> <?php if($msg){ ?>
                <div class="alert alert-success" role="alert">
                    <strong>สำเร็จ!</strong> <?php echo htmlentities($msg);?>
                </div> <?php } ?>

                <!---Error Message---> <?php if($error){ ?>
                <div class="alert alert-danger" role="alert">
                    <strong>ขออภัย</strong> <?php echo htmlentities($error);?>
                </div> <?php } ?>
            </div>

            <?php
            $postid=intval($_GET['pid']);
            $query=mysqli_query($conn,"SELECT *
                                         from hall_of_fame
                                        where id='$postid'
                                          and Is_Active=1
                                        ");
            while($row=mysqli_fetch_array($query)) { ?>

            <div class="col-md-10 col-md-offset-1">
                <div class="p-6">   
                <form name="addpost" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-2 form-group mb-3">
                        <label for="exampleInputEmail1">คำนำหน้า</label>
                        <select name="hof_prefix" class="form-select">
                            <option value="<?php $row['hof_prefix']  ?>">
                                <?php echo $row['hof_prefix'] ?>
                            </option>
                            <option value="นาย">นาย</option>
                            <option value="นางสาว">นางสาว</option>
                            <option value="นาง">นาง</option>
                            <option value="ดร.">ดร.</option>
                            <option value="ผศ.ดร.">ผศ.ดร.</option>
                            <option value="อ.ดร.">อ.ดร.</option>
                            <option value="ศ.ดร">ศ.ดร</option>
                        </select>
                    </div>
                    <div class="col-5 form-group mb-3">
                        <label for="exampleInputEmail1">ชื่อจริง</label>
                        <input type="text" class="form-control" name="hof_firstname" value="<?php echo $row['hof_firstname'] ?>" placeholder="กรอกชื่อ">
                    </div>
                    <div class="col-5 form-group mb-3">
                        <label for="exampleInputEmail1">นามสกุล</label>
                        <input type="text" class="form-control" name="hof_lastname" value="<?php echo $row['hof_lastname'] ?>" placeholder="กรอกนามสกุล">
                    </div>
                    </div>                

                    <div class="row">     
                        <div class="col-6 form-group">
                            <label class="control-label">ตำแหน่ง/อาชีพปัจจุบัน</label>
                            <input type="text" class="form-control" name="hof_position" 
                                    placeholder="ex.อาจารย์มหาวิทยาลัย, ประธานบริษัท" 
                                    value="<?php echo $row['hof_position'] ?>">
                        </div>
                    
                        <div class="col-6 form-group mb-3">
                            <label class="control-label">วัน/เดือน/ปี เกิด</label>
                            <input type="date" class="form-control" name="hof_date_of_birth"
                                    value="<?php echo $row['hof_date_of_birth'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="header-title">ไบโอ (รายละเอียดแนะนำตัว)</label>
                        <input type="text" class="form-control" name="hof_description" 
                                placeholder="นายxxx ปัจจุบันประกอบอาชีพxxx เคยดำรงตำแหน่งxxx และสร้างชื่อเสียงในระดับสากล จากการเขียนงานวิจัยชื่อxxx"
                                value="<?php echo $row['hof_description'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="header-title">ประวัติส่วนตัว</label>
                        <textarea class="summernote" rows="5" name="hof_history">
                            <?php echo $row['hof_history'] ?>
                        </textarea>
                    </div>
    
                    <div class="row"> 
                    <label class="control-label col-12">ความเชี่ยวชาญ</label>    
                        <div class="col-6 form-group"><input type="text" class="form-control" name="hof_mastery" placeholder="ชีววิทยา" value="<?php echo $row['hof_mastery'] ?>"></div>               
                        <div class="col-6 form-group"><input type="text" class="form-control" name="hof_mastery_2" placeholder="คณิตศาสตร์" value="<?php echo $row['hof_mastery_2'] ?>"></div>
                        <div class="col-6 form-group"><input type="text" class="form-control" name="hof_mastery_3" placeholder="เคมี" value="<?php echo $row['hof_mastery_3'] ?>"></div>
                        <div class="col-6 form-group"><input type="text" class="form-control" name="hof_mastery_4" placeholder="ฟิสิกส์" value="<?php echo $row['hof_mastery_4'] ?>"></div>
                        <div class="col-6 form-group"><input type="text" class="form-control" name="hof_mastery_5" placeholder="สถิติ" value="<?php echo $row['hof_mastery_5'] ?>"></div>
                    </div>

                    <div class="row"> 
                    <label class="control-label col-12">รางวัลที่เคยได้รับ</label>    
                        <div class="col-6 form-group"><input type="text" class="form-control" name="hof_reward" placeholder="รางวัลxx" value="<?php echo $row['hof_reward'] ?>"></div>               
                        <div class="col-6 form-group"><input type="text" class="form-control" name="hof_reward_2" placeholder="รางวัลxx" value="<?php echo $row['hof_reward_2'] ?>"></div>
                        <div class="col-6 form-group"><input type="text" class="form-control" name="hof_reward_3" placeholder="รางวัลxx" value="<?php echo $row['hof_reward_3'] ?>"></div>
                        <div class="col-6 form-group"><input type="text" class="form-control" name="hof_reward_4" placeholder="รางวัลxx" value="<?php echo $row['hof_reward_4'] ?>"></div>
                        <div class="col-6 form-group"><input type="text" class="form-control" name="hof_reward_5" placeholder="รางวัลxx" value="<?php echo $row['hof_reward_5'] ?>"></div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="header-title">ศิษย์เก่าดีเด่นประจำปี</label>
                        <input type="text" class="form-control" name="hof_year" placeholder="2562">
                    </div>

                    <div class="row">
                        <div class="col-4 form-group mt-2">
                            <label for="header-title">รูปภาพประจำตัว</label><br>
                            <img class="mt-1 mb-3 hof-image img-fluid img-thumbnail rounded" src="postimages/<?php echo $row['hof_image'] ?>"  alt="">                         
                        </div>

                        <div class="col-4 form-group mt-2">
                            <label for="header-title">รูปภาพพื้นหลัง</label><br>
                            <img class="mt-1 mb-3 hof-image img-fluid img-thumbnail rounded" src="postimages/<?php echo $row['hof_image_cover'] ?>"  alt="">
                        </div>

                        <div class="col-4 form-group mt-2">
                            <label for="header-title">รูปภาพเพิ่มเติม</label><br>
                            <img class="mt-1 mb-3 hof-image img-fluid img-thumbnail rounded" src="postimages/<?php echo $row['hof_image_2'] ?>"  alt="">
                        </div>
                    </div>
                    <a href="hof_image_change.php?pid=<?php echo $row["id"]; ?>" class="btn btn-primary">แก้ใขรูปภาพ</a>
                    <hr>
                <div class="my-4">                 
                    <button type="update" name="update" class="btn btn-success waves-effect waves-light">
                        Save and Post
                    </button>
                </div>                      
                </form>
                
            </div> 
            
        </div>
        <?php } ?> 
                        
    </div>

    <script>var resizefunc = [];</script>
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