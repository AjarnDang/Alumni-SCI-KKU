<?php  
  include('header_dashboard.php'); 
  require_once('../../template/pagination_function.php');
?>
<link href="assets/css/components.css" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="assets/css/pages.css" rel="stylesheet" type="text/css" />		
<link rel="stylesheet" href="../../assets/css/news_ac_dashboard.css">
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<body>
	<div class="container-fluid">
		<div class="bread-crump pt-2">
			<a href="adminDashboard.php">แดชบอร์ด</a> >
			<a href="#">บริจาค</a> >
			<a href="product_dashboard.php">ภาพรวมระบบบริจาค</a> 
		</div>
		<div class="pt-2 header-product">
			<strong>ภาพรวมระบบบริจาค</strong>
		</div>	
        <hr>

        <div class="row">



                                    
                               

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<a href="alumni_manage.php">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="fa fa-th-list"></i>
                                    </div>
									
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                        <div class="stat-heading">ยอดบริจาครวมทั้งหมด</div>
										
										<?php
                                    $sql = "SELECT * FROM donation
                                            ORDER BY datesave DESC
                                            LIMIT 0, 5
                                            ";
                                    $result2 = mysqli_query($conn, $sql);
                                    while ($row2 = mysqli_fetch_array($result2)) {    
                                        @$amount_total += $row2['amount'];
                                    }
                                     echo "<div class='stat-text'><span>";
                                     echo number_format($amount_total, 2)."</span> บาท"; 
                                     echo "</div>";
                                            ?>                                                                                                                    
                                        </div>
                                    </div>
									
                                </div>
                            </div>
                        </div>
						</a>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<a href="alumni_manage.php">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="fa fa-list"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">ยอดบริจาคล่าสุด</div>

											<?php 
                                            $sql = "SELECT * FROM donation
                                                    ORDER BY datesave DESC
                                                    LIMIT 0, 1
                                                    ";
                                            $result3 = mysqli_query($conn, $sql);
                                                  while ($row3 = mysqli_fetch_array($result3)) {                           
											?>
                                            <div class="stat-text"><span>
                                                <?php echo number_format($row3['amount'], 2); ?></span> บาท</div> 
                                            <?php } ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</a>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						<a href="alumni_manage.php"> 
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <?php $year = date("Y") + 543; ?>
                                            <div class="stat-heading">รายการบริจาคสิ่งของทั้งหมด</div>
                                            <?php
                                                $sql = "SELECT * FROM donate_stuff WHERE Is_Active = 1";
                                                if ($result = mysqli_query($conn, $sql)) {
                                                    $rowcount = mysqli_num_rows($result);
                                                }
                                            ?>
                                            <div class="stat-text"><span class="count"><?php echo $rowcount; ?> </span> รายการ</div>                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</a>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						<a href="alumni_deleted.php">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="fa fa-trash-o"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">จำนวนสิ่งของที่บริจาคแล้ว</div>
                                            <?php $query=mysqli_query($conn,"SELECT * FROM donate_stuff WHERE Is_Active = 0");
											$countposts=mysqli_num_rows($query);?>
                                            <div class="stat-text"><span class="count">
                                                <?php echo htmlentities($countposts);?></span> รายการ</div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</a>
                    </div>
					
                </div>
    </div>
</body>
<?php include('DashboardScript.php') ?>