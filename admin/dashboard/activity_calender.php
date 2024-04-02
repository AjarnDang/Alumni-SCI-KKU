<?php  
include ('header_dashboard.php'); 
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
<link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
<script src="fullcalendar/lib/jquery.min.js"></script>
<script src="fullcalendar/lib/moment.min.js"></script>
<script src="fullcalendar/fullcalendar.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/css/calendar.css">
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">

<script>
$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "activity_event.php",
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,        
        editable: true,
    });
});
</script>
<body>
	<div class="container-fluid my-4">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">กิจกรรม</a> >
            <a href=" ">จัดการกิจกรรม</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>จัดการกิจกรรม</strong>
	    </div>
        <hr />

        <div class="row px-0 pt-2">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
            <div class="card-body">  
            <div class="page-header">
                <div class="justify-content-between d-flex">
                    <div><h2 class="current-date p-1"></h2></div>
                    <div>	                            
                        <div class="btn-group p-1">
                            <button class="btn btn-primary" data-calendar-nav="prev"><< ย้อนกลับ</button>
                            <button class="btn btn-default" data-calendar-nav="today">ปัจจุบัน</button>
                            <button class="btn btn-primary" data-calendar-nav="next">ถัดไป >></button>
                        </div>
                        <div class="btn-group p-1">
                            <button class="btn btn-warning" data-calendar-view="year">ปี</button>
                            <button class="btn btn-warning active" data-calendar-view="month">เดือน</button>
                            <button class="btn btn-warning" data-calendar-view="week">สัปดาห์</button>
                            <button class="btn btn-warning" data-calendar-view="day">วัน</button>
                        </div>  
                    </div>                                      
                </div>
            </div>
            </div>
            </div>
        </div>
        </div>

            <div class="row px-0"> 
				<div class="col-xl-7 col-lg-12">  
                    <div class="card">
                        <div class="card-body">              
                            <div class="px-5 py-2" id="showEventCalendar"></div>
                            <!--<div class="px-5 py-2" id='calendar'></div>-->
                        </div>
                    </div>
				</div>
				<div class="col-xl-5 col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-3">       
                                <h4>ปฏิทินกิจรรมทั้งหมด</h4>
                                <!--<ul id="eventlist" class="nav nav-list"></ul>-->
                                <div class="btn btn-primary">
                                    <a class="text-white" href="activity_manage.php">จัดการกิจกรรม</a>
                                </div>
                            </div>         
                            <table class="table table-colored table-centered table-inverse m-0">
                            <thead>
                                <tr>                                         
                                <th>กิจกรรม</th>
                                <th>วันเริ่มต้น</th>
                                <th>วันสิ้นสุด</th>
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
                                
                                $e_page = 6; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
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
                                $sql.="ORDER BY PostingDate DESC LIMIT ".$s_page.",$e_page";
                                $result=$conn->query($sql);
                                if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
                                    while($row = $result->fetch_assoc()) { // วนลูปแสดงรายการ
                                        $num++;
                                        $presentDay = date("d")." ".$month_arr[date("n")]." ".(date("Y")+543);

                                        $Date = $row['PostingDate'];  
                                        $newdateFormat = date('d M Y', strtotime($Date));
                                        $newDate = date("d", strtotime($Date));  
                                        $newMonth = date("n", strtotime($Date));
                                        $newYear = date("Y", strtotime($Date));
                                        
                                        if($newDate = $row['PostingDate'] < $presentDay) {
                                            $status = "<span class='text-danger'>สิ้นสุดแล้ว</span>";     
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
                                <tr>
                                    <td class="td-title"><?php echo ($row['PostTitle']);?></td>
                                    <td><?php echo date("$startDate")." ".$month_arr[date("$startMonth")]." ".(date("$startYear")+543);?></td>
                                    <td><?php echo date("$lastDate")." ".$month_arr[date("$lastMonth")]." ".(date("$lastYear")+543);?></td>
                                    <td><?php echo $status ?></td>
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

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script type="text/javascript" src="assets/js/calendar.js"></script>
    <script type="text/javascript" src="assets/js/events.js"></script>
<?php 
    include('DashboardScript.php');
}
?>
</body>