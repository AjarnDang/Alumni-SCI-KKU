<?php
include('header_dashboard.php');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/css/calendar.css">
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
<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">ยอดเงินบริจาคทั้งหมด</div>
                                    <div class="stat-text"><span class="count">2000</span> บาท</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">ยอดขายสินค้าที่ระลึก</div>
                                    <div class="stat-text"><span class="count">3435</span> บาท</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="pe-7s-browser"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <?php $year = date("Y") + 543; ?>
                                    <div class="stat-heading">ศิษย์เก่าสำเร็จการศึกษาปี <?php echo $year; ?></div>
                                    <?php
                                    $sql = "SELECT * FROM user WHERE end_year = '$year'";
                                    if ($result = mysqli_query($conn, $sql)) {
                                        $rowcount = mysqli_num_rows($result);
                                    }
                                    ?>
                                    <div class="stat-text"><span class="count"><?php echo $rowcount; ?></span> คน</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="pe-7s-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">ศิษย์เก่าทั้งหมด</div>
                                    <?php
                                    $sql = "SELECT * FROM user";
                                    if ($result = mysqli_query($conn, $sql)) {
                                        $rowcount = mysqli_num_rows($result);
                                    }
                                    ?>
                                    <div class="stat-text"><span class="count"><?php echo $rowcount; ?></span> คน</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Widgets -->
        <!--  Traffic  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <div class="h3">ยอดเงินบริจาค</div>
                        <div><a href="./donation_chart.php" class="btn btn-primary">ดูเพิ่มเติม</a></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <div class="card-body">
                                <!-- <canvas id="TrafficChart"></canvas>   -->
                                <?php
                                $query = "
                                    SELECT full_name,
                                        phone_number,
                                        detail,
                                        amount, SUM(amount) AS totol,
                                        DATE_FORMAT(datesave, '%d-%M-%Y') AS datesave
                                    FROM donation
                                    GROUP BY DATE_FORMAT(datesave, '%d%')
                                    ORDER BY DATE_FORMAT(datesave, '%Y-%m-%d') DESC
                                    ";
                                $result = mysqli_query($conn, $query);
                                $resultchart = mysqli_query($conn, $query);
                                //for chart
                                $datesave = array();
                                $totol = array();
                                while ($rs = mysqli_fetch_array($resultchart)) {
                                    $datesave[] = "\"" . $rs['datesave'] . "\"";
                                    $totol[] = "\"" . $rs['totol'] . "\"";
                                }
                                $datesave = implode(",", $datesave);
                                $totol = implode(",", $totol);
                                ?>
                                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
                                <hr>
                                <p align="center">
                                    <!--devbanban.com-->
                                    <canvas id="myChart" width="800px" height="300px"></canvas>
                                    <script>
                                        var ctx = document.getElementById("myChart").getContext('2d');
                                        var myChart = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: [<?php echo $datesave; ?>

                                                ],
                                                datasets: [{
                                                    label: 'รายงานรายได้ แยกตามวัน (บาท)',
                                                    data: [<?php echo $totol; ?>],
                                                    backgroundColor: [
                                                        'rgba(255, 99, 132, 0.2)',
                                                        'rgba(54, 162, 235, 0.2)',
                                                        'rgba(255, 206, 86, 0.2)',
                                                        'rgba(75, 192, 192, 0.2)',
                                                        'rgba(153, 102, 255, 0.2)',
                                                        'rgba(255, 159, 64, 0.2)'
                                                    ],
                                                    borderColor: [
                                                        'rgba(255,99,132,1)',
                                                        'rgba(54, 162, 235, 1)',
                                                        'rgba(255, 206, 86, 1)',
                                                        'rgba(75, 192, 192, 1)',
                                                        'rgba(153, 102, 255, 1)',
                                                        'rgba(255, 159, 64, 1)'
                                                    ],
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="card-body">
                                <table class="table table-borderless" cellpadding="0" cellspacing="0" align="center">
                                    <thead>
                                        <tr>
                                            <th>ผู้บริจาค</th>
                                            <th>บริจาคเมื่อ</th>
                                            <th class="text-right">ยอดบริจาค</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $sql = "SELECT * FROM donation
                                            ORDER BY datesave DESC
                                            LIMIT 0, 5
                                            ";
                                    $result2 = mysqli_query($conn, $sql);
                                    while ($row2 = mysqli_fetch_array($result2)) {
                                        $Date = $row2['datesave'];  
                                        $newdateFormat = date('d M Y', strtotime($Date));
                                        $newDate = date("d", strtotime($Date));  
                                        $newMonth = date("n", strtotime($Date));
                                        $newYear = date("Y", strtotime($Date));     
                                        ?>
                                        <tr>
                                            <td><?php echo $row2['full_name']; ?></td>
                                            <td><?php echo date("$newDate")." ".$month_arr[date("$newMonth")]." ".(date("$newYear")+543);?></td>
                                            <td align="right"><?php echo number_format($row2['amount'], 2); ?></td>
                                        </tr>
                                        <?php
                                        @$amount_total += $row2['amount'];
                                    }
                                    ?>
                                    <tr>
                                        <td align="center"></td>
                                        <td align="center"></td>
                                        <td align="right"><b>รวม : <?php echo number_format($amount_total, 2); ?></b></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-lg-12">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="justify-content-between d-flex">
                        <div class="h3">ตารางกิจกรรม</div>
                        <div><a href="./activity_calender.php" class="btn btn-primary">ดูเพิ่มเติม</a></div>                                      
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="card-body">
                        <table class="table table-borderless p-0" cellpadding="0" cellspacing="0" align="center">
                            <thead>
                            <tr>
                            <th>ชื่อกิจกรรม</th>
                            <th>วันที่</th>
                            <th>สถานะ</th>
                            </tr>
                            </thead>
                            <?php
                                $sql = "SELECT * FROM events
                                        ORDER BY start_date DESC
                                        LIMIT 0, 8
                                        ";
                                $result3 = mysqli_query($conn, $sql);
                                while ($row3 = mysqli_fetch_array($result3)) {
                                    $presentDay = date("d")." ".$month_arr[date("n")]." ".(date("Y")+543);

                                    $Date = $row3['PostingDate'];  
                                    $newdateFormat = date('d M Y', strtotime($Date));
                                    $newDate = date("d", strtotime($Date));  
                                    $newMonth = date("n", strtotime($Date));
                                    $newYear = date("Y", strtotime($Date));
                                    
                                    if($newDate = $row3['PostingDate'] < $presentDay) {
                                        $status = "<span class='text-danger'>สิ้นสุดแล้ว</span>";     
                                    }
                                    elseif($row3['status'] == 1) {
                                        $status = "<span class='text-success'>ดำเนินการได้</span>"; 
                                    }                                     
                                    $beginDate = $row3['start_date'];                                         
                                    $startdateFormat = date('d M Y', strtotime($beginDate));
                                    $startDate = date("d", strtotime($beginDate));  
                                    $startMonth = date("n", strtotime($beginDate));
                                    $startYear = date("Y", strtotime($beginDate));
                                    
                                    $endDate = $row3['end_date'];
                                    $enddateFormat = date('d M Y', strtotime($endDate));
                                    $lastDate = date("d", strtotime($endDate));  
                                    $lastMonth = date("n", strtotime($endDate));
                                    $lastYear = date("Y", strtotime($endDate));     
                                ?>
                            <tr>
                                <td style="width: 40%;"><?php echo $row3['PostTitle']; ?></td>
                                <td style="width: 30%;"><?php echo date("$startDate")." ".$month_arr[date("$startMonth")]." ".(date("$startYear")+543);?></td>
                                <td style="width: 30%;"><?php echo $status; ?></td>
                            </tr>
                            <?php } ?>
                        </table>               
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="card-body">                            
                            <div class="mt-3 border-1" id="showEventCalendar"></div> 
                            <!--<div class="px-5 py-2" id='calendar'></div>-->          
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        </div>

        

        <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="justify-content-between d-flex">
                        <?php $year = date("Y") + 543; ?>
                        <div class="h3">ศิษย์เก่าสำเร็จการศึกษาปี <?php echo $year ?></div>
                        <div><a href="./alumni_manage.php" class="btn btn-primary">ดูเพิ่มเติม</a></div>                                      
                    </div> 
                    <table class="table table-borderless p-0" cellpadding="0" cellspacing="0" align="center">
                        <thead>
                            <tr>
                            <th>รหัสนักศึกษา</th>    
                            <th>ชื่อ-สกุล</th>
                            <th>สาขาวิชา</th>
                            </tr>
                        </thead>
                        <tbody>        
                        <?php
                            $sql4 = "SELECT user.student_id,
                                            user.firstname,
                                            user.lastname,
                                            user.fos_id,
                                            field_of_study.fos_name
                                     FROM user 
                                     JOIN field_of_study on field_of_study.fos_id = user.fos_id
                                     WHERE end_year = '$year'";
                            $result4 = mysqli_query($conn, $sql4);
                            while ($row4 = mysqli_fetch_array($result4)) { ?>
                            <tr>
                            <td><?php echo $row4['student_id']; ?></td>    
                            <td><?php echo $row4['firstname']." ".$row4['lastname']; ?></td>
                            <td><?php echo $row4['fos_name']; ?></td>
                            </tr>
                        <?php } ?>   
                        </tbody> 
                    </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="justify-content-between d-flex">
                        <?php $year = date("Y") + 543; ?>
                        <div class="h3">ศิษย์ดีเด่นประจำปี <?php echo $year ?></div>
                        <div><a href="./hof_dashboard.php" class="btn btn-primary">ดูเพิ่มเติม</a></div>                                      
                    </div> 
                    <table class="table table-borderless p-0" cellpadding="0" cellspacing="0" align="center">
                        <thead>
                            <tr>  
                            <th>ชื่อ-สกุล</th>
                            <th>รางวัลที่ได้รับ</th>
                            </tr>
                        </thead>
                        <tbody>        
                        <?php
                            $sql5 = "SELECT * FROM hall_of_fame 
                                     WHERE hof_year = '$year'";
                            $result5 = mysqli_query($conn, $sql5);
                            while ($row5 = mysqli_fetch_array($result5)) { ?>
                            <tr>  
                            <td style="width: 30%;"><?php echo $row5['hof_prefix']." ".$row5['hof_firstname']." ".$row5['hof_lastname']; ?></td>
                            <td style="width: 70%;"><?php echo $row5['hof_reward']; ?></td>
                            </tr>
                        <?php } ?>   
                        </tbody> 
                    </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
            <div class="card h-100 d-flex flex-column min-vh-100 justify-content-center align-items-center bg-secondary rounded">
                <a href="https://www.facebook.com/AlumniRelationsKKU" target="_blank">
               <div class="card-body py-4">              
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook text-white" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
                        <p class="text-white mt-2">ศิษย์เก่าสัมพันธ์ มหาวิทยาลัยขอนแก่น</p></li>           
                    </div>                                       
                </div>
                </a>
            </div>                 
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
            <div class="card h-100 d-flex flex-column min-vh-100 justify-content-center align-items-center rounded" style="background-color: #4267B2">
                <a href="https://www.facebook.com/profile.php?id=100022212763369" target="_blank">
               <div class="card-body py-4">              
                    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook text-white" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
                        <p class="text-white mt-2">คณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น</p></li>           
                    </div>                                       
                </div>
                </a>
            </div>                 
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
            <div class="card h-100 d-flex flex-column min-vh-100 justify-content-center align-items-center rounded" style="background-color: #A73B24">
                <a href="https://kkuoaa.kku.ac.th/" target="_blank">
               <div class="card-body py-4">              
                    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
                        <img src="http://cad.kku.ac.th/wp-content/uploads/2018/05/Th_color.png" width="14" alt="เว็บไซต์ศิษย์เก่ามหาวิทยาลัยขอนแก่น" class="d-inline-block">  
                        <p class="text-white mt-2">เว็บไซต์ศิษย์เก่าสัมพันธ์</p>         
                    </div>                                       
                </div>
                </a>
            </div>                    
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
            <div class="card h-100 d-flex flex-column min-vh-100 justify-content-center align-items-center rounded" style="background-color: #FFD000">
                <a href="https://sc.kku.ac.th/sciweb/" target="_blank">
               <div class="card-body py-4">              
                    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
                        <img src="https://upload.wikimedia.org/wikipedia/th/thumb/4/47/Science_KKU.svg/1200px-Science_KKU.svg.png" width="25" alt="เว็บไซต์ศิษย์เก่ามหาวิทยาลัยขอนแก่น" class="d-inline-block">  
                        <p class="text-dark mt-2">เว็บไซต์คณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น</p>         
                    </div>                                       
                </div>
                </a>
            </div>                    
            </div>
        </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script type="text/javascript" src="assets/js/calendar.js"></script>
    <script type="text/javascript" src="assets/js/events.js"></script>
<?php include('DashboardScript.php') ?>
</body>

</html>