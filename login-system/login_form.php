<?php 
include('../db/connection.php');
    session_start();
    if(isset($_GET['logout'])){
        if($_GET['logout'] == true){
            session_destroy();
        }
    }

 if(isset($_POST["username"])) {
    $username = ($_POST['username']);
    $password = trim($_POST['password']);

    $sql = mysqli_query($conn, "SELECT * FROM user 
                                where username = '$username'
                                and Is_Active = 1
                                ");
    $count = mysqli_num_rows($sql);
            if(mysqli_num_rows($sql) == 1) {
                $row = mysqli_fetch_array($sql);
                if($row['Is_Active'] = 0) {
                    echo "<script>alert('ขออภัย ขณะนี้บัญชีของคุณถูกระงับการใช้งานชั่วคราว กรุณาติดต่อผู้ดูแลระบบเพื่อสอบถามเพิ่มเติม');</script>";
                } else {
					$hashpassword = $row["password"];        
					$_SESSION['userid'] = $row['id'];
					$_SESSION['student_id'] = $row['student_id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['user'] = $row['firstname'] . " " . $row['lastname'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['userlevel'] = $row['userlevel'];
					
					if ($_SESSION['userlevel'] == 'member') {
						header("location: ../user/user_home.php");   
					}
								
					if($row["status"] == 0){ ?>
						<script>alert("ขออภัย บัญชีของคุณยังไม่ได้รับการยืน โปรดตรวจสอบที่อีเมลและลองใหม่อีกครั้ง");</script>
					<?php 
					}else if(password_verify($password, $hashpassword)){ ?>
						<script>alert("เข้าสู่ระบบสำเร็จ!");</script>
					<?php }else{ ?>
						<script>alert("ขออภัย ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง");</script>              
					<?php
				}
            }
        }
        $sql = mysqli_query($conn, "SELECT * FROM user 
                                    where username = '$username' 
                                    and userlevel = 'admin'");
        $count = mysqli_num_rows($sql);

            if(mysqli_num_rows($sql) == 1) {
            $row = mysqli_fetch_array($sql);
            
            $hashpassword = $row["password"];        
            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user'] = $row['firstname'] . " " . $row['lastname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['userlevel'] = $row['userlevel'];
                if ($_SESSION['userlevel'] == 'admin') {
                    header("location: ../admin/admin_home.php");
                }

            }           
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="icon" type="image/png" href="../assets/img/sci_logo.png"/>
	<link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/animate/animate.css">

	<link rel="stylesheet" type="text/css" href="../assets/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendor/select2/select2.min.css">	
	<link rel="stylesheet" type="text/css" href="../assets/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <title>ลงชื่อเข้าใช้งาน | ศิษย์เก่าคณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น</title>

</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('../assets/img/decoration-img/kku.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
			<a style="float:right;" href="../home.php">
				< ย้อนกลับ
			</a><!--action="login.php"-->
				<form class="login100-form validate-form" role="form" method="post" >
					<!--<span class="login100-form-title p-b-49">
						Login
					</span>-->
					<img class="mx-auto d-block" src="../assets/img/sci_logo.png" style="width:7em; margin-top:2em; margin-bottom:2em; clear:both;" alt="">

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is required">
						<span class="label-input100">
							ชื่อผู้ใช้งาน
						</span>
						<input class="input100" type="text" name="username" placeholder="Type your username">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">
							รหัสผ่าน
						</span>
						<input class="input100" type="password" name="password" placeholder="Type your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="text-right p-t-8 p-b-31">
						<a href="recover_psw.php">ลืมรหัสผ่าน ?</a>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn" name="login">เข้าสู่ระบบ</button>
						</div>
					</div>

					<div class="flex-col-c p-t-155">
						<span class="txt1 p-b-17">ลงทะเบียนเพื่อเข้าสู่ระบบ</span>
						<a href="register.php" class="txt2">ลงทะเบียน</a>
					</div>

				</form>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>
	
	<script src="../assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../assets/vendor/animsition/js/animsition.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/popper.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/vendor/select2/select2.min.js"></script>
	<script src="../assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="../assets/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="../assets/vendor/countdowntime/countdowntime.js"></script>
	<script src="../assets/js/main.js"></script>

</body>
</html>

<?php 

    if (isset($_SESSION['success']) || isset($_SESSION['error'])) {
        session_destroy();
    }

?>
