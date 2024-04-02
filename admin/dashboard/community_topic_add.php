<?php 
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login-form.php');
}else{    
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
            <a href="community_topic_add.php">เพิ่มหัวข้อคอมมูนิตี้</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>เพิ่มหัวข้อคอมมูนิตี้</strong>
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
                <form name="addpost" action="community_db_ajax.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6 form-group mb-3">
                            <label for="exampleInputEmail1">ชื่อหัวข้อ</label>
                            <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="กรอกชื่อหัวข้อ" required>
                        </div>
                        <div class="col-6 form-group mb-3">
                        <label for="exampleInputEmail1">หมวดหมู่</label>
                        <select class="form-select" name="category" required>
                            <option value="" disabled>เลือกหมวดหมู่ </option>
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

                    <div class="form-group">
                        <label for="header-title">รายละเอียดหัวข้อ</label>
                        <textarea class="summernote" rows="5" name="postdescription" required></textarea>
                    </div>
    
                    <div class="form-group mt-2">
                        <label for="header-title">รูปภาพ</label>
                        <input type="file" class="form-control" id="postimage" name="postimage">
                    </div>
                      
                    <?php $userid = mysqli_query($conn,"SELECT * from user where id=".$_SESSION['userid']." ");
                            while($row = mysqli_fetch_array($userid)) { 
                            //echo $row['id'];
                        ?>
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <?php } ?>

                <div class="my-4">                 
                    <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">
                        ยืนยัน
                    </button>
                </div>                      
                </form>
                
            </div> 
            
        </div>
                        
    </div>
 
    <script type="text/javascript">
        $(document).ready(function () {
            $('.category').select2();
        });
        $('body').on('click', '.add-data', function (event) {
            event.preventDefault();
            var category = $('.category').val();
            $.ajax({
                method: 'POST',
                url: 'community_db_ajax.php',
                data: {
                    category: category,
                },
                success: function (data) {
                    console.log(data);
                    $('.res-msg').css('display', 'block');
                    $('.alert-success').text(data).show();
                    $(".category").val('').trigger('change');
                    setTimeout(function () {
                        $('.alert-success').hide();
                    }, 3500);

                }
            });
        });
    </script>

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




