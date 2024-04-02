<?php 
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login-form.php');
}else{ 
    // adding post  
     if(isset($_POST['submit'])) {
        $posttitle=$_POST['posttitle'];
        $catid=$_POST['category'];
        $subcatid=$_POST['subcategory'];
        $postdetails=$_POST['postdescription'];
        $arr = explode(" ",$posttitle);
        $url=implode("-",$arr);
        
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
            move_uploaded_file($_FILES["postimage"]["tmp_name"],"postimages/".$imgnewfile);

            $status=1;
            $query=mysqli_query($conn,"INSERT into tblposts(PostTitle,
                                                            CategoryId,
                                                            SubCategoryId,
                                                            PostDetails,
                                                            PostUrl,
                                                            Is_Active,
                                                            PostImage
                                                            )
                                                    values('$posttitle',
                                                        '$catid',
                                                        '$subcatid',
                                                        '$postdetails',
                                                        '$url',
                                                        '$status',
                                                        '$imgnewfile'
                                                        )");
            if($query) {
                $msg="เพิ่มข่าวสารเสร็จสิ้น";
            } else {
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

<link href="../../assets/css/defaultDashboard.css" rel="stylesheet" >
<style> a {text-decoration: none;}</style>
<script>
    function getSubCat(val) {
    $.ajax({
        type: "POST",
        url: "news_subcategory_get.php",
        data:'catid='+val,
        success: function(data){
            $("#subcategory").html(data);
            }
        });
    }
</script>
<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ข่าวสาร</a> >
            <a href=" ">เพิ่มข่าวสาร</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>เพิ่มข่าวสาร</strong>
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

            <div class="col-md-10 col-md-offset-1">
                <div class="p-6">   
                <form name="addpost" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1">ชื่อข่าว</label>
                        <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="กรอกชื่อข่าว" required>
                    </div>


                    <div class="row">
                        <div class="col-6 form-group mb-3">
                        <label for="exampleInputEmail1">หมวดหมู่</label>
                        <select class="form-control" name="category" id="category" onChange="getSubCat(this.value);" required>
                            <option value="">เลือกหมวดหมู่</option>
                            <?php // Feching active categories
                            $ret=mysqli_query($conn,"SELECT id,
                                                            CategoryName
                                                       from tblcategory
                                                      where Is_Active=1
                                                    ");
                            while($result=mysqli_fetch_array($ret)) { ?>
                            <option value="<?php echo htmlentities($result['id']);?>">
                                <?php echo htmlentities($result['CategoryName']);?>
                            </option>
                            <?php } ?>
                        </select> 
                        </div>
                    
                        <div class="col-6 form-group mb-3">
                            <label for="exampleInputEmail1">หมวดหมู่ย่อย</label>
                            <select class="form-control" name="subcategory" id="subcategory"></select> 
                        </div>
                    </div>

                    <p><a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        คำแนะนำ
                    </a></p>
                    <div class="collapse" id="collapseExample">
                    <div class="card card-body p-0 pt-3">
                        <ol class="list-group-numbered">
                            <li class="list-group-item">หลีกเลี่ยงการใช้เครื่องหมาย "" หรือ '' หรือ ; หรือ : </li>
                            <li class="list-group-item">สามารถแทรกรูปภาพลงใน Post Deatil ได้</li>
                            <li class="list-group-item">รูปภาพใน Post Deatil สามารถปรับขนาดได้</li>
                            <li class="list-group-item">สามารถแทรกลิงก์ได้ที่ปุ่มลิงก์ (ด้ายซ้ายปุ่มแทรกรูปภาพ)</li>
                        </ol>
                    </div>
                    </div>           

                    <div class="form-group">
                        <label for="header-title">เนื้อหาข่าว</label>
                        <textarea class="summernote" rows="5" name="postdescription" required></textarea>
                    </div>
    
                    <div class="form-group mt-2">
                        <label for="header-title">ภาพปกข่าว</label>
                        <input type="file" class="form-control" id="postimage" name="postimage" required>
                    </div>
                      
                <div class="my-4">                 
                    <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">
                        ยืนยัน
                    </button>
                    <a href="news_news_add.php" class="btn btn-danger waves-effect waves-light">
                        ยกเลิก
                    </a>
                </div>                      
                </form>
                
            </div> 
            
        </div>
                        
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