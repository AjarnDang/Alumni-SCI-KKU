<?php 
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if($_GET['action']='restore') {
        $postid=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE tblposts 
                                      set Is_Active=1
                                    where id='$postid'
                                 ");
        if($query) {
            $msg="ลบข้อมูลเสร็จสิ้น";
        } else{
            $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
        } 
    }

    if($_GET['presid']) { // Forever deletionparmdel
        $id=intval($_GET['presid']);
        $query=mysqli_query($conn,"DELETE from tblposts 
                                         where id='$id'
                                        ");
        $delmsg="ลบข้อมูลเสร็จสิ้นforever";
    }
?>
<link href="../../assets/css/defaultDashboard.css" rel="stylesheet" >
<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ข่าวสาร</a> >
            <a href="news_news_manage.php">จัดการข่าวสาร</a> >
            <a href="#">ข่าวสารที่ถูกลบ</a> 
        </div>
        <div class="pt-2 d-flex justify-content-between">
		    <div><strong style="font-size: 40px;">เพิ่มข่าวสาร</strong></div>
            <div><a class="btn btn-primary py-2 align-items-center" href="news_news_manage.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/></svg> 
                    ย้อนกลับ
                </a>
            </div>
	    </div>
    
        <div class="row">
            <div class="col-sm-6">  
                <?php if($delmsg){ ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>ขออภัย</strong> <?php echo htmlentities($delmsg);?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="table-responsive">
                    <table class="table table-colored table-centered table-inverse m-0">
                        <thead>
                            <tr>                                         
                            <th>ชื่อข่าว</th>
                            <th>หมวดหมู่</th>
                            <th>หมวดหมู่ย่อย</th>
                            <th>แอ็คชั่น</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                $query=mysqli_query($conn,"SELECT tblposts.id                   as postid,
                                                  tblposts.PostTitle            as title,
                                                  tblcategory.CategoryName      as category,
                                                  tblsubcategory.Subcategory    as subcategory 
                                             from tblposts
                                        left join tblcategory       on tblcategory.id=tblposts.CategoryId
                                        left join tblsubcategory    on tblsubcategory.SubCategoryId=tblposts.SubCategoryId
                                            where tblposts.Is_Active=0
                                            ");
                $rowcount=mysqli_num_rows($query);
                if($rowcount==0) { ?>
                    <tr><td colspan="4" class="text-center"><h3>ขณะนี้ยังไม่มีข่าวที่ถูกลบ</h3></td><tr>
                <?php } else {
                    while($row=mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td><b><?php echo htmlentities($row['title']);?></b></td>
                        <td><?php echo htmlentities($row['category'])?></td>
                        <td><?php echo htmlentities($row['subcategory'])?></td>
                        <td><a href="news_news_trash_post.php?pid=<?php echo htmlentities($row['postid']);?>
                                &&action=restore" onclick="return confirm('คุณต้องการจะกู้คืนข่าวนี้ใช่หรือไม่ ?')">
                                <i class="fa fa-reply" title="Restore this Post"></i>
                            </a> &nbsp;
                            <a href="news_news_trash_post.php?presid=<?php echo htmlentities($row['postid']);?>
                                &&action=perdel" onclick="return confirm('คุณต้องการจะลบข่าวนี้ใช่หรือไม่ ?')">
                                <i class="fa fa-trash-o" style="color: #f05050" title="Permanently delete this post"></i>
                            </a> 
                        </td>
                    </tr>

                    <?php } }?>
                                               
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
</body>
    <?php include('DashboardScript.php') ?>
<?php } ?>