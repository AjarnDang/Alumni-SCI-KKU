<?php 
require('header_user.php');
error_reporting(0); 

?>
<!--Summernote-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

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
        <div class="nav-point mt-4">
            <a class="text-black" href="user/user_home.php">หน้าหลัก</a> >
            <a class="text-black" href="user/community.php">คอมมูนิตี้</a> >
            <a class="text-black" href="#">โพสต์หัวข้อ</a>
        </div>       
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
        </div>
        <div class="row mt-3">
            <h1 class="mb-3 font-weight-bold">โพสต์หัวข้อ</h1>
            <div class="col-lg-9 col-sm-12">                          
                    <form action="community_add.php" name="addpost" method="post" enctype="multipart/form-data">
                    <div class="col-12 form-group mb-4 px-0">  
                        <select class="form-select category" name="category" onChange="getSubCat(this.value);" required>
                            <option selected>เลือกหมวดหมู่ </option>
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
                    <div class="col-12 form-group mb-4 px-0">
                        <input type="text" class="form-control" id="posttitle" name="posttitle" placeholder="กรอกชื่อหัวข้อ (จำเป็นต้องกรอก)" required>
                    </div>
                    <div class="col-12 form-group mb-4 px-0">
                        <input id="f02" name="postimage" type="file"/>
                        <label for="f02">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16"><path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/><path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/></svg>
                            รูปภาพ
                        </label>
                    </div>
                    <textarea name="postdescription" id="summernote" require></textarea>

                    <?php $userid = mysqli_query($conn,"SELECT * from user where id=".$_SESSION['userid']." ");
                            while($row = mysqli_fetch_array($userid)) { 
                            //echo $row['id'];
                        ?>
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <?php } ?>

                    <div class="mt-4 text-right">                 
                        <button type="submit" name="submit" class="btn user-btn submit-btn mb-4">
                            ยืนยัน
                        </button>
                    </div>  
                    </form>       
              
            </div>  
            <div class="col-lg-3 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4>คำแนะนำในการโพสต์</h4>
                        <p>การโพสต์ควรมีเนื้อหาที่เหมาะสม ไม่เสียดสี ล่อแหล่ม และเคารพต่อผู้อื่น</p>
                        <p>การโปรโมตสินค้าและการสแปมจะถูกลบออกจากคอมมูนิตี้โดยปราศจากการแจ้งเตือน</p>
                        <p>ให้เกียรติผู้อื่นด้วยความจริงใจและห้ามใช้คำพูดหยาบคาย</p>
                        <p>การประพฤติตนที่ไม่เป็นที่น่าพึงพอใจต่อผู้อื่นและผู้ดูแลระบบจะถูกระงับการใช้งานบัญชี</p>
                    </div>
                </div>
            </div>       
        </div> 
        <script>
        $('#summernote').summernote({
            placeholder: 'เนื่้อหา (จำเป็นต้องกรอก)',
            tabsize: 2,
            height: 250
        });


        $("[type=file]").on("change", function(){
        // Name of file and placeholder
        var file = this.files[0].name;
        var dflt = $(this).attr("placeholder");
        if($(this).val()!=""){
            $(this).next().text(file);
        } else {
            $(this).next().text(dflt);
        }
        });
        </script>
    </div>
</body>
<?php 
require('../template/footer_users.php');
?>