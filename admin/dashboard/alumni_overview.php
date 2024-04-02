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
			<a href="#">ศิษย์เก่า</a> >
			<a href="product_dashboard.php">ภาพรวมระบบศิษย์เก่า</a> 
		</div>
		<div class="pt-2 header-product">
			<strong>ภาพรวมระบบศิษย์เก่า</strong>
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
                                        <div class="stat-heading">ศิษย์เก่าทั้งหมด</div>
										
										<?php $query=mysqli_query($conn,"SELECT * from user where Is_Active=1");
					 					$countcat=mysqli_num_rows($query);	?>
                                        <div class="stat-text"><span class="count">
                                            <?php echo htmlentities($countcat);?></span> คน</div>                                     
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
                                            <div class="stat-heading">ยืนยันอีเมลแล้ว</div>

											<?php $query=mysqli_query($conn,"SELECT * from user where status=1");
											$countsubcat=mysqli_num_rows($query); ?>
                                            <div class="stat-text"><span class="count">
                                                <?php echo htmlentities($countsubcat);?></span> คน</div>  
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
                                            <div class="stat-heading">สำเร็จการศึกษาในปี <?php echo $year; ?></div>
                                            <?php
                                                $sql = "SELECT * FROM user WHERE end_year = '$year'";
                                                if ($result = mysqli_query($conn, $sql)) {
                                                    $rowcount = mysqli_num_rows($result);
                                                }
                                            ?>
                                            <div class="stat-text"><span class="count"><?php echo $rowcount; ?> </span> คน</div>                                         
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
                                            <div class="stat-heading">ระงับการใช้งาน</div>
                                            <?php $query=mysqli_query($conn,"SELECT * from user where Is_Active=0");
											$countposts=mysqli_num_rows($query);?>
                                            <div class="stat-text"><span class="count">
                                                <?php echo htmlentities($countposts);?></span> คน</div>
                                            
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