<?php 
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if(isset($_POST['update'])) {
        $posttitle=$_POST['posttitle'];
        $catid=$_POST['category'];        
        $postdetails=$_POST['postdescription'];
        $arr = explode(" ",$posttitle);
        $url=implode("-",$arr);
        $status=1;
        $postid=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE community_topic set PostTitle='$posttitle',
                                                       CategoryId='$catid',
                                                       PostDetails='$postdetails',
                                                       PostUrl='$url',
                                                       UpdationDate=now(),
                                                       Is_Active='$status'
                                                 where id='$postid'
                                                 ");
            if($query) {
                $msg="อัปเดตหัวข้อเสร็จสิ้น";
            } else {
                $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
            }      
        }
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
            <a href="community_dashboard.php">จัดการคอมมูนิตี้</a> >
            <a href="#">แก้ใขหัวข้อคอมมูนิตี้</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>แก้ใขหัวข้อคอมมูนิตี้</strong>
	    </div>
        <hr />

        <div class="row justify-content-center">
            <div class="col-lg-10">  

            <!---Success Message--->  
            <?php if($msg){ ?>
                <div class="alert alert-success" role="alert">
                    <strong class="text-black">สำเร็จ!</strong> <?php echo htmlentities($msg);?>
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
            $query=mysqli_query($conn,"SELECT community_topic.id                as postid,
                                              community_topic.PostImage         as PostImage,
                                              community_topic.PostTitle         as PostTitle,
                                              community_topic.PostDetails       as PostDetails,
                                              community_category.CategoryName   as category,
                                              community_category.id             as catid,
                                              user.id
                                         from community_topic
                                   inner join user on user.id = community_topic.user_id 
                                    left join community_category on community_category.id=community_topic.CategoryId
                                        where community_topic.id='$postid'
                                          and community_topic.Is_Active=1
                                        ");
            while($row=mysqli_fetch_array($query)) { ?>
            
            <div class="row justify-content-center">
                <div class="col-md-10 col-md-offset-1">
                    <div class="p-6">

                    <form name="addpost" method="post">
                        <div class="row p-0">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">หัวข้อโพสต์</label>
                                    <input type="text" class="form-control" id="posttitle" value="<?php echo htmlentities($row['PostTitle']);?>" name="posttitle" placeholder="Enter title" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label for="exampleInputEmail1">หมวดหมู่</label>
                                <select class="form-select" name="category" id="category" required>
                                    
                                    <option value="<?php echo htmlentities($row['catid']);?>">
                                        <?php echo htmlentities($row['category']);?>
                                    </option>
                                    <?php // Feching active categories
                                    $ret=mysqli_query($conn,"SELECT id,
                                                                    CategoryName
                                                            from community_category
                                                            where Is_Active=1
                                                            ");
                                    while($result=mysqli_fetch_array($ret)) { ?>
                                        <option value="<?php echo htmlentities($result['id']);?>">
                                            <?php echo htmlentities($result['CategoryName']);?>
                                        </option>
                                    <?php } ?>

                                </select> 
                                </div>
                            </div>
                        </div>                                               

                    <p><a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        คำแนะนำ
                    </a></p>
                    <div class="collapse" id="collapseExample">
                    <div class="card card-body">                       
                        <p class="text-black">1.หลีกเลี่ยงการใช้เครื่องหมาย "" และ ''</p>
                        <p class="text-black">2.สามารถแทรกรูปภาพลงใน Post Deatil ได้</p>
                        <p class="text-black">3.รูปภาพใน Post Deatil สามารถปรับขนาดได้</p>
                        <p class="text-black">4.สามารถแทรกลิงก์ได้ที่ปุ่มลิงก์ (ด้ายซ้ายปุ่มแทรกรูปภาพ)</p>              
                    </div>
                    </div>
                    
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                <h5 class="m-b-30 m-t-0 header-title"><b>รายละเอียดหัวข้อ</b></h5>
                                <textarea class="summernote" name="postdescription" required>
                                    <?php echo htmlentities($row['PostDetails']);?>
                                </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row border-light">
                            <div class="col-sm-12">
                                <div class="card-box">
                                <h5 class="m-b-30 m-t-0 header-title"><b>รูปภาพ</b></h5>
                                <?php if($row['PostImage'] == ""){
                                    echo "";
                                } else {?>
                                <img src="postimages/<?php echo htmlentities($row['PostImage']);?>" width="500" class="rounded"/>
                                <?php } ?>
                                <br/>
                                <a href="community_edit_image.php?id=<?php echo $row['postid'];?>" class="button btn btn-secondary mt-2">
						            แก้ใขรูปภาพ
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
                        <button type="submit" name="update" class="btn btn-success mt-3 mb-5 text-black">
                            ยืนยันการเปลี่ยนแปลง
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