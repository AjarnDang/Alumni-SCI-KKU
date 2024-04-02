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
			<a href="#">ข่าวสาร</a> >
			<a href="product_dashboard.php">ภาพรวมระบบ</a> 
		</div>
		<div class="pt-2 header-product">
			<strong>ภาพรวมระบบข่าวสาร</strong>
		</div>	

		<hr>

		<div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<a href="news_category_manage.php">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="fa fa-th-list"></i>
                                    </div>
									
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                        <div class="stat-heading">หมวดหมู่ข่าวสาร</div>
										
										<?php $query=mysqli_query($conn,"SELECT * from tblcategory where Is_Active=1");
					 					$countcat=mysqli_num_rows($query);	?>

                                            <div class="stat-text"><span class="count"><?php echo htmlentities($countcat);?></span></div>                                     
                                        </div>
                                    </div>
									
                                </div>
                            </div>
                        </div>
						</a>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<a href="./news_subcategory_manage.php">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="fa fa-list"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">หมวดหมู่ย่อย</div>

											<?php $query=mysqli_query($conn,"SELECT * from tblsubcategory where Is_Active=1");
											$countsubcat=mysqli_num_rows($query); ?>

                                            <div class="stat-text"><span class="count"><?php echo htmlentities($countsubcat);?></span></div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</a>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						<a href="./news_news_manage.php"> 
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">ข่าวทั้งหมด</div>

                                            <?php $query=mysqli_query($conn,"SELECT * from tblposts where Is_Active=1");
											$countposts=mysqli_num_rows($query);?>

                                            <div class="stat-text"><span class="count"><?php echo htmlentities($countposts);?></span></div>                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</a>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
						<a href="./news_news_trash_post.php">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="fa fa-trash-o"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">ข่าวที่ถูกลบ</div>

                                            <?php $query=mysqli_query($conn,"SELECT * from tblposts where Is_Active=0");
											$countposts=mysqli_num_rows($query);?>

                                            <div class="stat-text"><span class="count"><?php echo htmlentities($countposts);?></span></div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</a>
                    </div>
					
                </div>


	</div>

<?php include('DashboardScript.php') ?>
</body>
</html>