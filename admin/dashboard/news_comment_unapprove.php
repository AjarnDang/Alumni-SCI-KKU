<?php
include('header_dashboard.php');
require_once('../../template/pagination_function.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if( $_GET['disid']) {
	$id=intval($_GET['disid']);
	$query=mysqli_query($conn,"UPDATE tblcomments set status='0' where id='$id'");
	$msg="ไม่อนุมัติคอมเมนต์";
    }
    // restore
    if($_GET['appid']) {
        $id=intval($_GET['appid']);
        $query=mysqli_query($conn,"UPDATE tblcomments set status='1' where id='$id'");
        $msg="คอมเมนต์ถูกอนุมัติแล้ว";
    }
    // delete
    if($_GET['action']=='del' && $_GET['rid']) {
        $id=intval($_GET['rid']);
        $query=mysqli_query($conn,"DELETE from  tblcomments  where id='$id'");
        $delmsg="ลบคอมเมนต์เสร็จสิ้น";
    }
?>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ข่าวสาร</a> >
            <a href=" ">จัดการคอมเมนท์ที่ยังไม่อนุมัติ</a> 
        </div>
        <div class="pt-2 d-flex justify-content-between">
		    <div><strong style="font-size: 40px;">จัดการคอมเมนท์ที่ยังไม่อนุมัติ</strong></div>
            <div><a class="btn btn-success py-2 align-items-center" href="./news_comment_manage.php">คอมเมนท์ที่อนุมัติแล้ว</a></div>
	    </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">  

            <!---Success Message--->  
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

        <div class="row mt-3">
			<div class="col-md-12">
				<div class="demo-box m-t-20">
                    <div class="table-responsive">
                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>ชื่อ</th>
                        <th>อีเมล</th>
                        <th width="300">คอมเมนต์</th>
                        <th>สถานะ</th>
                        <th>ข่าว</th>
                        <th>วันที่</th>
                        <th>แอ็คชั่น</th>
                        </tr>
                        </thead>
                        <tbody>
                <?php 
                $num = 0;
                $sql="SELECT tblcomments.id,
                             tblcomments.name,
                             tblcomments.email,
                             tblcomments.postingDate,
                             tblcomments.comment,
                             tblposts.id as postid,
                                            tblposts.PostTitle
                        from tblcomments
                        join tblposts on tblposts.id = tblcomments.postId
                       where tblcomments.status=0
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
                        <th scope="row"><?php echo htmlentities($num);?></th>
                        <td><?php echo htmlentities($row['name']);?></td>
                        <td><?php echo htmlentities($row['email']);?></td>
                        <td><?php echo htmlentities($row['comment']);?></td>
                        <td><?php $st=$row['status'];
                                if($st=='0'):
                                    echo "รอการอนุมัติ";
                                else:
                                    echo "อนุมัติแล้ว";
                                endif;?>
                        </td>
                        <td>
                            <a href="news_news_edit.php?pid=<?php echo htmlentities($row['postid']);?>">
                                <?php echo htmlentities($row['PostTitle']);?>
                            </a>
                        </td>
                        <td><?php echo date("$newDate")." ".$month_arr[date("$newMonth")]." ".(date("$newYear")+543);?></td>
                        <td><?php if($st=='0'):?>
                            <a href="news_comment_unapprove.php?disid=<?php echo htmlentities($row['id']);?>" title="Disapprove this comment">
                                <i class="fa fa-check" style="color: #29b6f6;"></i></a>
                                <?php else :?>

                            <a href="news_comment_unapprove.php?appid=<?php echo htmlentities($row['id']);?>" title="Approve this comment">
                                <i class="fa fa-check" style="color: #29b6f6;"></i></a>
                                <?php endif;?>&nbsp;

                            <a href="news_comment_unapprove.php?rid=<?php echo htmlentities($row['id']);?>&&action=del">
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