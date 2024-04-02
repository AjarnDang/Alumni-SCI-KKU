<?php 
require('header_user.php');
error_reporting(0); 
if(isset($_POST['submit'])) {
    $posttitle=$_POST['posttitle'];
    $catid=($_POST['category']);
    $postdetails=$_POST['postdescription'];
    $arr = explode(" ",$posttitle);
    $url=implode("-",$arr);
    $user_id=$_POST['user_id'];

    $status=1;
    $postid=intval($_GET['id']);
    $query=mysqli_query($conn,"UPDATE community_topic SET PostTitle     ='$posttitle',
                                                          CategoryId    ='$catid',                                                                 
                                                          PostDetails   ='$postdetails',
                                                          PostUrl       ='$url',
                                                          UpdationDate  =now(),
                                                          Is_Active     ='$status',
                                                          user_id       ='$user_id'
                                                    where id='$postid'
                                                    ");                                        
        if($query) {
            $msg="แก้ใขข้อสำเร็จ!";
        } else {
            $error="มีบางอย่างผิดพลาด! ไม่สามารถแก้ใขข้อได้.";    
        } 
    }
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
            <a class="text-black" href="user_home.php">หน้าหลัก</a> >
            <a class="text-black" href="community.php">คอมมูนิตี้</a> >
            <a class="text-black" href="#">แก้ใขหัวข้อ</a>
        </div>       
        <div class="row mt-3 mb-0">
            <div class="col-lg-9">  
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
        <?php
            $postid=intval($_GET['id']);
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
            while($row=mysqli_fetch_array($query)) {
            ?>
        <div class="row mt-3">
            <h1 class="mb-3 font-weight-bold">แก้ใขหัวข้อ</h1>
            <div class="col-lg-9 col-sm-12">                          
                    <form name="addpost" method="post" enctype="multipart/form-data">
                    <div class="col-12 form-group mb-4 px-0">  
                        <select class="form-select category" name="category" onChange="getSubCat(this.value);" required>
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
                    <div class="col-12 form-group mb-4 px-0">
                        <input type="text" class="form-control" id="posttitle" name="posttitle" 
                            placeholder="<?php echo htmlentities($row['PostTitle']);?>" 
                            value="<?php echo htmlentities($row['PostTitle']);?>"
                            required>
                    </div>
                    <div class="col-12 form-group mb-4 px-0">
                        <?php if ($row['PostImage'] != '') { ?>
                            <img src="../../admin/dashboard/postimages/<?php echo($row['PostImage']);?>" class="w-75 rounded mb-2" alt="">
                        <?php } else { echo ''; } ?>

                        <br>
                        <p class="lead mb-2 bg-secondary text-white p-2 w-75 rounded"><?php echo($row['PostImage']);?></p> 
                        
                        
                        <a href="community_edit_image.php?id=<?php echo $row['postid'];?>" class="button btn btn-warning">
						    แก้ใขรูปภาพ
					    </a> 
                       
                    </div>
                    <textarea name="postdescription" id="summernote" require><?php echo htmlentities($row['PostDetails']);?></textarea>

                    <?php $userid = mysqli_query($conn,"SELECT * from user where id=".$_SESSION['userid']." ");
                            while($row = mysqli_fetch_array($userid)) {  ?>
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <?php } } ?>


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
                            placeholder: 'กรุณากรอกเนื้อหา (จำเป็นต้องกรอก)',
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
<?php require('../template/footer_users.php');?>