<?php
include('header_dashboard.php');
require_once('../../template/pagination_function.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if( $_GET['disid']) {
	$id=intval($_GET['disid']);
	$query=mysqli_query($conn,"UPDATE community_comment set status='0' where id='$id'");
	$msg="Comment unapprove ";
    }
    // restore
    if($_GET['appid']) {
        $id=intval($_GET['appid']);
        $query=mysqli_query($conn,"UPDATE community_comment set status='1' where id='$id'");
        $msg="Comment approved";
    }
    // delete
    if($_GET['action']=='del' && $_GET['rid']){
        $id=intval($_GET['rid']);
        $query=mysqli_query($conn,"DELETE from  community_comment  where id='$id'");
        $delmsg="ลบข้อมูลเสร็จสิ้น";
    }
?>
<link href="../../assets/css/defaultDashboard.css" rel="stylesheet" >
<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">คอมมูนิตี้</a> >
            <a href="#">จัดการคอมเมนท์คอมมูนิตี้</a> 
        </div>
        <div class="pt-2 d-flex justify-content-between">
		    <div><strong style="font-size: 40px;">จัดการคอมเมนท์คอมมูนิตี้</strong></div>
            
	    </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">  

            <?php if($msg){ ?>
            <div class="alert alert-success" role="alert">
            <strong>สำเร็จ!</strong> <?php echo htmlentities($msg);?>
            </div>
            <?php } ?>

            <?php if($delmsg){ ?>
            <div class="alert alert-danger" role="alert">
            <strong>ขออภัย</strong> <?php echo htmlentities($delmsg);?></div>
            <?php } ?>

            </div>
        </div>

        <div class="row mt-4">
			<div class="col-md-12">
				<div class="demo-box m-t-20">
                    <div class="table-responsive">
                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                        <thead>
                            <tr>
                            <th>ผู้ใช้งาน</th>
                            <th>อีเมล</th>
                            <th width="300">ความคิดเห็น</th>
                            <th>หัวข้อ/โพสต์</th>
                            <th>วันที่</th>
                            <th>แอ็คชั่น</th>
                            </tr>
                        </thead>
                        <tbody>

                    <?php 
                    $num = 0;
                    $sql= "SELECT   community_comment.id, 
                                    community_comment.name,
                                    community_comment.email,
                                    community_comment.postingDate,
                                    community_comment.comment,
                                    community_topic.id as postid,
                                    community_topic.PostTitle
                                from community_comment
                                join community_topic on community_topic.id=community_comment.postId
                                where community_comment.status=1
                                ";
                   $result=$conn->query($sql);
                   $total=$result->num_rows;
                   
                   $e_page = 12; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
                   $step_num=0;
                   if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page']==1)){   
                       $_GET['page']=1;   
                       $step_num=0;
                       $s_page = 0;    
                   }else{   
                       $s_page = $_GET['page']-1;
                       $step_num=$_GET['page']-1;  
                       $s_page = $s_page*$e_page;
                   }   
                   $sql.="ORDER BY postingDate DESC LIMIT ".$s_page.",$e_page";
                   $result=$conn->query($sql);
                   if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
                       
                    while($row = $result->fetch_assoc()) { // วนลูปแสดงรายการ
                        $num++; 
                        $Date = $row['postingDate'];  
                        $newdateFormat = date('d M Y', strtotime($Date));
                        $newDate = date("d", strtotime($Date));  
                        $newMonth = date("n", strtotime($Date));
                        $newYear = date("Y", strtotime($Date));    
                    ?>

                            <tr>
                            <td><?php echo htmlentities($row['name']);?></td>
                            <td><?php echo htmlentities($row['email']);?></td>
                            <td><?php echo htmlentities($row['comment']);?></td>
                            <td>
                                <a href="community_topic_edit.php?pid=<?php echo htmlentities($row['postid']);?>">
                                <?php echo htmlentities($row['PostTitle']);?></a>
                            </td>
                            <td><?php echo date("$newDate")." ".$month_arr[date("$newMonth")]." ".(date("$newYear")+543);?></td>
                            <td><a href="community_comment_manage.php?rid=<?php echo htmlentities($row['id']);?>&&action=del">
                                <i class="fa fa-trash-o" style="color: #f05050"></i>
                                </a>
                            </td>
                            </tr>

                    <?php } } ?>

                        </tbody>                          
                    </table>
                <div class="mt-5">
                <?php page_navi($total,(isset($_GET['page']))?$_GET['page']:1,$e_page);?>
                </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include('DashboardScript.php'); ?>
</body>
<?php } ?>