<?php 
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if($_GET['action']='restore') {
        $postid=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE community_topic 
                                      set Is_Active=1
                                    where id='$postid'
                                 ");
        if($query) {
            $msg="กู้คืนโพสต์สำเร็จ";
        } else{
            $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง.";    
        } 
    }

    if($_GET['presid']) { // Forever deletionparmdel
        $id=intval($_GET['presid']);
        $query=mysqli_query($conn,"DELETE from community_topic 
                                         where id='$id'
                                        ");
        $delmsg="ลบโพสต์สำเร็จ";
    }
?>
<link href="../../assets/css/defaultDashboard.css" rel="stylesheet" >

<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">คอมมูนิตี้</a> >
            <a href="community_topic_manage.php">จัดการคอมมูนิตี้</a> >
            <a href="#">คอมมูนิตี้ที่ถูกลบ</a> 
        </div>
        <div class="pt-2 d-flex justify-content-between">
		    <div><strong style="font-size: 40px;">คอมมูนิตี้ที่ถูกลบ</strong></div>
            <div><a class="btn btn-primary py-2 align-items-center" href="community_topic_manage.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/></svg> 
                    ย้อนกลับ
                </a>
            </div>
	    </div>
    
        <div class="row">
            <div class="col-sm-6">  
                <?php if($delmsg){ ?>
                    <div class="alert alert-danger" role="alert">
                        <strong></strong> <?php echo htmlentities($delmsg);?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12">          
                <div class="table-responsive">
                    <table class="table table-colored table-centered table-inverse m-0">
                        <thead>
                            <tr> 
                            <th>#</th>                                        
                            <th>โพสต์</th>
                            <th>หมวดหมู่</th>
                            <th>วันที่สร้าง</th>
                            <th>อัปเดตเมื่อ</th>
                            <th>ผู้โพสต์</th>
                            <th>แอ็คชั่น</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                $query=mysqli_query($conn,"SELECT community_topic.id                   as postid,
                                                  community_topic.PostTitle            as title,
                                                  community_topic.PostingDate          as PostDate,
                                                  community_topic.UpdationDate         as UpdationDate,
                                                  community_category.CategoryName      as category,
                                                  user.id,
                                                  user.username
                                             from community_topic
                                       inner join user on user.id = community_topic.user_id 
                                        left join community_category on community_category.id=community_topic.CategoryId
                                            where community_topic.Is_Active=0
                                            ");
                $rowcount=mysqli_num_rows($query);
                if($rowcount==0) { ?>
                    <tr><td colspan="4" class="text-center"><h3>ไม่พบข้อมูลในระบบ</h3></td><tr>
                <?php } else {
                    while($row=mysqli_fetch_array($query)) { 
                        $num++;
                        $Date = $row['PostDate'];  
                        $newdateFormat = date('d M Y', strtotime($Date));
                        $newDate = date("d", strtotime($Date));  
                        $newMonth = date("n", strtotime($Date));
                        $newYear = date("Y", strtotime($Date)); 
    
                        $upDate = $row['UpdationDate'];  
                        $upnewdateFormat = date('d M Y', strtotime($upDate));
                        $upnewDate = date("d", strtotime($upDate));  
                        $upnewMonth = date("n", strtotime($upDate));
                        $upnewYear = date("Y", strtotime($upDate)); 
    
                        if($row['UpdationDate'] == NULL) {
                             $updation_date = '-';
                         } else {
                             $updation_date = date("$upnewDate")." ".$month_arr[date("$upnewMonth")]." ".(date("$upnewYear")+543);
                         }     
                ?>
                    <tr>
                        <td><?php echo ($step_num*$e_page)+$num; ?></td>
                        <td><b><?php echo htmlentities($row['title']);?></b></td>
                        <td><?php echo htmlentities($row['category'])?></td>
                        <td><?php echo date("$newDate")." ".$month_arr[date("$newMonth")]." ".(date("$newYear")+543);?></td>
                        <td><?php echo $updation_date; ?></td>
                        <td><?php echo htmlentities($row['username'])?></td>
                        <td><a href="community_topic_deleted.php?pid=<?php echo htmlentities($row['postid']);?>
                                &&action=restore" onclick="return confirm('คุณต้องการจะกู้คืนข้อมูลนี้หรือไม่ ?')">
                                <i class="fa fa-reply" title="Restore this Post"></i>
                            </a> &nbsp;
                            <a href="community_topic_deleted.php?presid=<?php echo htmlentities($row['postid']);?>
                                &&action=perdel" onclick="return confirm('คุณต้องการจะลบข้อมูลนี้หรือไม่ ?')">
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
    <?php include('DashboardScript.php') ?>
</body>
<?php } ?>