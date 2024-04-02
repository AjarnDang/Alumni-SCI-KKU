<?php 
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if(isset($_POST['update'])) {
        $posttitle=$_POST['posttitle'];
        $catid=$_POST['category'];
        $subcatid=$_POST['subcategory'];
        $postdetails=$_POST['postdescription'];
        $arr = explode(" ",$posttitle);
        $url=implode("-",$arr);
        $status=1;
        $postid=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE tblposts set PostTitle='$posttitle',
                                                       CategoryId='$catid',
                                                       SubCategoryId='$subcatid',
                                                       PostDetails='$postdetails',
                                                       PostUrl='$url',
                                                       Is_Active='$status'
                                                 where id='$postid'
                                                 ");
            if($query) {
                $msg="อัปเดตข้อมูลเสร็จสิ้น";
            } else {
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
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ข่าวสาร</a> >
            <a href="news_news_manage.php">จัดการข่าวสาร</a> >
            <a href="#">แก้ใขข่าวสาร</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>แก้ใขข่าวสาร</strong>
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
            $postid=intval($_GET['pid']);
            $query=mysqli_query($conn,"SELECT tblposts.id as postid,
                                              tblposts.PostImage,tblposts.PostTitle as title,
                                              tblposts.PostDetails,tblcategory.CategoryName as category,
                                              tblcategory.id as catid,
                                              tblsubcategory.SubCategoryId as subcatid,
                                              tblsubcategory.Subcategory as subcategory
                                         from tblposts
                                    left join tblcategory on tblcategory.id=tblposts.CategoryId
                                    left join tblsubcategory on tblsubcategory.SubCategoryId=tblposts.SubCategoryId
                                        where tblposts.id='$postid'
                                          and tblposts.Is_Active=1
                                        ");
            while($row=mysqli_fetch_array($query)) { ?>
            
            <div class="row justify-content-center">
                <div class="col-md-10 col-md-offset-1">
                    <div class="p-6">

                    <form name="addpost" method="post">
                        <div class="form-group m-b-20">
                            <label for="exampleInputEmail1">ชื่อข่าว</label>
                            <input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['title']);?>" name="posttitle" placeholder="Enter title" required>
                        </div>

                        <div class="form-group m-b-20">
                            <label for="exampleInputEmail1">หมวดหมู่</label>
                            <select class="form-control" name="category" id="category" onChange="getSubCat(this.value);" required>
                                
                                <option value="<?php echo htmlentities($row['catid']);?>">
                                    <?php echo htmlentities($row['category']);?>
                                </option>
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
                            
                        <div class="form-group m-b-20">
                            <label for="exampleInputEmail1">หมวดหมู่ย่อย</label>
                            <select class="form-control" name="subcategory" id="subcategory">
                                <option value="<?php echo htmlentities($row['subcatid']);?>">
                                    <?php echo htmlentities($row['subcategory']);?>
                                </option>
                            </select> 
                        </div>
                                

                        <p><a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        คำแนะนำ
                    </a></p>
                    <div class="collapse" id="collapseExample">
                    <div class="card card-body p-0 pt-3">
                        <ol class="list-group-numbered">
                            <li class="list-group-item">หลีกเลี่ยงการใช้เครื่องหมาย "" และ ''</li>
                            <li class="list-group-item">สามารถแทรกรูปภาพลงใน Post Deatil ได้</li>
                            <li class="list-group-item">รูปภาพใน Post Deatil สามารถปรับขนาดได้</li>
                            <li class="list-group-item">สามารถแทรกลิงก์ได้ที่ปุ่มลิงก์ (ด้ายซ้ายปุ่มแทรกรูปภาพ)</li>
                        </ol>
                    </div>
                    </div>
                    
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                <h4 class="m-b-30 m-t-0 header-title"><b>เนื้อหาข่าว</b></h4>
                                <textarea class="summernote" name="postdescription" required>
                                    <?php echo htmlentities($row['PostDetails']);?>
                                </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row border-light">
                            <div class="col-sm-12">
                                <div class="card-box">
                                <h4 class="m-b-30 m-t-0 header-title"><b>ภาพปกข่าว</b></h4>
                                <img src="postimages/<?php echo htmlentities($row['PostImage']);?>" width="250"/>
                                <br/>
                                <a class="btn btn-default my-2" href="news_news_change_image.php?pid=<?php echo htmlentities($row['postid']);?>">
                                    อัปเดตภาพปกข่าว
                                </a>
                                </div>
                            </div>
                        </div>

                        <?php } ?>
                    </div>
                </div>

                    <div class="container-fluid">
                        <hr/>
                    </div>     

                    <div class="col-md-10 col-md-offset-1">
                        <button type="submit" name="update" class="btn btn-success waves-effect waves-light mt-3 mb-5">
                            อัปเดต
                        </button> 
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