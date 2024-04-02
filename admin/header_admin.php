  <?php 
session_start();
include('../db/connection.php');

if (!isset($_SESSION['username'])) {
	echo"<script>alert('ขออภัย กรุณาล็อคอินเพื่อเข้าสู่ระบบ')</script>";
    header("location: ../login-system/login_form.php");
} 
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/img/sci_logo.png" type="image/png">
    <title>ศิษย์เก่าคณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น</title>

    <script src="https://kit.fontawesome.com/0f35e6e1c5.js" crossorigin="anonymous"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>   

	<link href="header.css" rel="stylesheet">
    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function(){
            /////// Prevent closing from click inside dropdown
            document.querySelectorAll('.dropdown-menu').forEach(function(element){
              element.addEventListener('click', function (e) {
                e.stopPropagation();
              });
            })
        }); 
      // DOMContentLoaded  end
    </script>
</head>
<!-- ============= COMPONENT ============== -->
<body>
<header class="contact-header">
<div class="container" id="top">
    <div class="row">
      <div class="col-md-10 col-sm-12 col-xs-12">
        <ul class="list-group list-group-horizontal">
          <li class="pr-4">
            <a class="social-md" href="donate.php" class="pr-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/></svg>
            บริจาคให้เรา</a>
          </li>
          <li>
            <a class="social-md" href="contact.php" class="pr-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/></svg> 
            ติดต่อเรา</a>
          </li>
        </ul>
      </div>
      <div class="col-md-2 col-sm-12 col-xs-12 text-left top-nav-right">
        <ul class="dots list-group list-group-horizontal">
          <li class="pr-3"><a class="social-md" href="https://www.facebook.com/Faculty-of-Science-Khon-Kaen-University-173153522752360/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg></a></li>
          <li class="pr-3"><a class="social-md" href="https://www.youtube.com/user/suktkl"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16"><path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/></svg></a></li>
          <li class="pr-3"><a class="social-md" href="https://sc.kku.ac.th/sciweb/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16"><path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/></svg></a></li>
		  <li class="pr-3">
		  	<?php
				//current URL of the Page. cart_update.php redirects back to this URL
				$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
				if(isset($_SESSION["cart_session"])) { 	
					$total = 0; 
					foreach ($_SESSION["cart_session"] as $cart_itm) {
						$subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
						$total = ($total + $subtotal); } ?>

							<div class="icon-badge-group"><a class="social-md" href="view_cart.php">
							<div class="icon-badge-container">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>
								<div class="icon-badge"><?php echo $cart_itm["qty"] ?></div>
							</div>
							</a>	
							</div>	
						<?php
				}else{ ?>
					<div class="icon-badge-group"><a class="social-md" href="view_cart.php">
							<div class="icon-badge-container">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>
							</div>
							</a>	
							</div>
				<?php } ?>
		  </li>				
		</ul>
      </div>
    </div>
  </div>
  </header>
<nav class="navbar navbar-expand-lg navbar-light navigation-bar">
<div class="container">
	<a class="navbar-brand" href="user_home.php"><img src="../assets/img/sci_logo.png" alt="sci-logo"></a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="main_nav">
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
					เกี่ยวกับเรา
				</a>
				<div class="dropdown-menu dropdown-large">
					<div class="row g-3">
						<div class="col-6">
						<h6 class="title"><a href="#">เกี่ยวกับเรา</a></h6>
							<ul class="list-unstyled">
								<li><a href="#">ประวัติสมาคม</a></li>
								<li><a href="#">ข้อบังคับสมาคม</a></li>
								<li><a href="#">ทำเนียบสมาคม</a></li>
								<li><a href="#">คณะกรรมการ</a></li>
							</ul>
						</div>
						<div class="col-6">
						<h6 class="title"><a href="#">ทุนการศึกษา</a></h6>
							<ul class="list-unstyled">
								<li><a href="#">ทุนการศึกษาประเภท ก.</a></li>
								<li><a href="#">ทุนการศึกษาประเภท ข.</a></li>
								<li><a href="#">ทุนวิจัย</a></li>
								<li><a href="#">ทุนเรียนดี</a></li>
							</ul>
						</div>
					</div>

					<div class="row g-3 mt-3">
						<div class="col-6">
						<h6 class="title"><a href="#">เรียนต่อกับเรา</a></h6>
							<ul class="list-unstyled">
								<li><a href="#">หลักสูตรปริญญาโท</a></li>
								<li><a href="#">หลักสูตรปริญญาเอก</a></li>
							</ul>
						</div>
						<div class="col-6">
						<h6 class="title"><a href="donate.php">บริจาคให้เรา</a></h6>
							<ul class="list-unstyled">
								<li><a href="donate_money.php">บริจาคเงิน</a></li>
								<li><a href="#">บริจาคสิ่งของ</a></li>
							</ul>
						</div>
					</div>
		
				</div> <!-- dropdown-large.// -->
			</li> 
			<li class="nav-item dropdown">
				<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">
					ศิษย์เก่า
				</a>
			    <ul class="dropdown-menu dropdown-menu-end">
				  <li><a class="dropdown-item" href="hall_of_fame.php">Hall of Fame (หอเกียรติยศ)</a></li>
				  <li><a class="dropdown-item" target="_blank" href="https://www.facebook.com/AlumniRelationsKKU/">สมาคมศิษย์เก่า มหาวิทยาลัยขอนแก่น</a></li>
				  <li><a class="dropdown-item" href="alumni_network.php">เครือข่ายศิษย์เก่า</a></li>
				  <li><a class="dropdown-item" href="alumni.php">รายชื่อศิษย์เก่า</a></li>
			    </ul>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">
					กิจกรรมและข่าวสาร
				</a>
			    <ul class="dropdown-menu dropdown-menu-end">
				  <li><a class="dropdown-item" href="news_ac.php">ข่าวสาร</a></li>
				  <li><a class="dropdown-item" href="activity.php">กิจกรรมสัมพันธ์</a></li>
				  <li><a class="dropdown-item" href="#">วิดีทัศน์</a></li>
			    </ul>
			</li>
			<li class="nav-item"><a class="nav-link" href="community.php">คอมมูนิตี้</a></li>
			<li class="nav-item"><a class="nav-link" href="store.php">สินค้าที่ระลึก</a></li>
		</ul>
	  <ul class="navbar-nav ms-auto">
      	<li class="nav-item dropdown">
          <a class="nav-link btn user-btn dropdown-toggle" href="#" data-bs-toggle="dropdown">
            <?php echo $_SESSION['username']; ?>
          </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="dashboard/adminDashboard.php">จัดการเว็บไซต์</a></li>
              <li><a class="dropdown-item" href="user_profile.php">บัญชีของฉัน</a></li>
			  <li><a class="dropdown-item" href="user_history.php">ประวัติการเปลี่ยนแปลงข้อมูล</a></li>
              <li><a class="dropdown-item" href="../login-system/logout.php">ออกจากระบบ</a></li>
            </ul>
        </li>
      </ul>
  </div> <!-- navbar-collapse.// -->
 </div> <!-- container-fluid.// -->
</nav>
  
