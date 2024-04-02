<?php
include('header_dashboard.php');
require_once('../../template/pagination_function.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else { 
    if($_GET['action']='del') {
        $postid=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE events
                                      set status=0
                                    where id='$postid'
                                   ");
        if($query) {
            $msg="ลบกิจกรรมเสร็จสิ้น";
        } else{
            $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
        } 
    }
?>
<link href="../../assets/css/defaultDashboard.css" rel="stylesheet" >
<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">กิจกรรม</a> >
            <a href=" ">จัดการกิจกรรม</a> 
        </div>
        <div class="pt-2 d-flex justify-content-between">
		    <div><strong style="font-size: 40px;">จัดการกิจกรรม</strong></div>
            <div>
                <a class="btn btn-primary py-2 align-items-center" href="./activity_add.php">เพิ่มกิจกรรม</a>
                <a class="btn btn-danger py-2 align-items-center" href="./activity_trashpost.php">กิจกรรมที่ถูกลบ</a>
            </div>
	    </div>
   

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="table-responsive">
                    <table class="table table-colored table-centered table-inverse m-0">
                            <thead>
                                <tr> 
                                <th>#</th>                                         
                                <th>ชื่อกิจกรรม</th>
                                <th>วันเริ่มต้น</th>
                                <th>วันสิ้นสุด</th>
                                <th>เวลาเริ่มต้น</th>
                                <th>เวลาสิ้นสุด</th>
                                <th>สถานะ</th>
                                <th>แอ็คชั่น</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $num = 0;
                                $status = '';
                                $sql = "SELECT * from events
                                                where status = 1
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
                                $sql.="ORDER BY PostingDate ASC LIMIT ".$s_page.",$e_page";
                                $result=$conn->query($sql);
                                if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
                                    while($row = $result->fetch_assoc()) { // วนลูปแสดงรายการ
                                        $num++;
                                        $presentDay = date("d")." ".$month_arr[date("n")]." ".(date("Y")+543);

                                        $newDate = $row['PostingDate'];  
                                        $newdateFormat = date('d M Y', strtotime($newDate));
                                        $newDate = date("d", strtotime($newDate));  
                                        $newMonth = date("n", strtotime($newDate));
                                        $newYear = date("Y", strtotime($newDate));
                                        
                                        if($newDate = $row['PostingDate'] < $presentDay) {
                                            $status = "<span class='text-secondary'>สิ้นสุดแล้ว</span>";     
                                        }
                                        elseif($row['status'] == 1) {
                                            $status = "<span class='text-success'>ดำเนินการได้</span>"; 
                                        } 
                                       
                                        $beginDate = $row['start_date'];                                         
                                        $startdateFormat = date('d M Y', strtotime($beginDate));
                                        $startDate = date("d", strtotime($beginDate));  
                                        $startMonth = date("n", strtotime($beginDate));
                                        $startYear = date("Y", strtotime($beginDate));
                                        
                                        $endDate = $row['end_date'];
                                        $enddateFormat = date('d M Y', strtotime($endDate));
                                        $lastDate = date("d", strtotime($endDate));  
                                        $lastMonth = date("n", strtotime($endDate));
                                        $lastYear = date("Y", strtotime($endDate));
                            ?>
                                <tr><td><?php echo ($step_num*$e_page)+$num; ?></td>
                                    <td class="td-title"><?php echo ($row['PostTitle']);?></td>
                                    <td><?php echo date("$startDate")." ".$month_arr[date("$startMonth")]." ".(date("$startYear")+543);?></td>
                                    <td><?php echo date("$lastDate")." ".$month_arr[date("$lastMonth")]." ".(date("$lastYear")+543);?></td>
                                    <td><?php echo date('H:i', strtotime($row['start_time'])); ?> น.</td>
                                    <td><?php echo date('H:i', strtotime($row['end_time'])); ?> น.</td>
                                    <td><?php echo ($status)?></td>
                                    <td><a href="activity_edit.php?pid=<?php echo ($row['id']);?>">
                                        <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                                        </a>&nbsp; 
                                        <a href="activity_manage.php?pid=<?php echo ($row['id']);?>
                                            &&action=del" onclick="return confirm('คุณต้องการจะลบข้อมูลนี้หรือไม่ ?')">
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
    
    <?php include('DashboardScript.php') ?>
</body>
<?php } ?>