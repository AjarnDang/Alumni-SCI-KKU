<?php session_start(); ?>

<?php
    include('../db/connection.php');

    if(isset($_POST["register"])){
        $start_year = $_POST['start_year'];
        $end_year = $_POST['end_year'];
        $student_id = $_POST['student_id'];
        $username = $_POST['username'];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];
        $fos_id = $_POST['fos_id'];
        $career_id = $_POST['career_id'];

        $address = $_POST['address'];
        $postal_code = $_POST['postal_code'];
        $province_id = $_POST['province_id'];
        $amphure_id = $_POST['amphure_id'];
        $district_id = $_POST['district_id'];
        $date_of_birth =    date('Y-m-d', strtotime($_POST['date_of_birth']));

        $check_query = mysqli_query($conn, "SELECT * FROM user
                                                    where username ='$username'
                                                      and email = '$email'
                                                ");
        $rowCount = mysqli_num_rows($check_query);
    
        if(!empty($username) && !empty($password)){
            if($rowCount > 0){ ?>
                <script>alert("มีชื่อผู้ใช้งานหรืออีเมลนี้ในระบบแล้ว กรุณาลองใหม่อีกครั้ง");</script>
                <?php  }else{
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                $result = mysqli_query($conn,
                "INSERT INTO user  (student_id,
                                    username,
                                    password,
                                    firstname,
                                    lastname,
                                    gender,
                                    fos_id,
                                    career_id,
                                    start_year,
                                    end_year,
                                    email,
                                    userlevel,
                                    status,
                                    address,
                                    postal_code,
                                    province_id,
                                    amphure_id,
                                    district_id
                                    )
                            VALUES ('$student_id',
                                    '$username',
                                    '$password',
                                    '$firstname',
                                    '$lastname',
                                    '$gender',
                                    '$fos_id',
                                    '$career_id',
                                    '$start_year',
                                    '$end_year',
                                    '$email',
                                    'member',
                                    0,
                                    '$address',
                                    '$postal_code',
                                    '$province_id',
                                    '$amphure_id',
                                    '$district_id'
                                    )");
    
                if($result){
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                    $otp = rand(100000,999999);
                    $_SESSION['otp'] = $otp;
                    $_SESSION['mail'] = $email;
                    require "Mail/phpmailer/PHPMailerAutoload.php";
                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';   
                    $mail->Username='wiwsoos@gmail.com';
                    $mail->Password='0812601030';   
                    $mail->setFrom('wiwsoos@gmail.com',
                                    'OTP Verification - Faculty of Science, Khon Kaen University');
                    $mail->addAddress($_POST["email"]);    
                    $mail->isHTML(true);
                    $mail->Subject="Faculty of Science Alumni - Verify code";
                    $mail->Body="<p>Dear user, </p> <h2>Your verify OTP code is $otp <br></h2>
                    <br><br>
                    <p>With regrads,</p>
                    <b>Faculty of Science Admin</b><br>
                    This is an auto verification email, please do not reply";
                            if(!$mail->send()){ ?>
                                    <script>alert("<?php echo "อีเมลไม่ถูกต้อง ไม่สามารถสมัครสมาชิกได้"?>");</script> 
                    <?php }else{ ?>
                                <script>alert("<?php echo "สมัครสมาชิกเสร็จสิ้น เลข OTP ถูกส่งไปยังอีเมล " . $email ?>");
                                        window.location.replace('verification.php');</script>
                    <?php  }
                }
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
    <link rel="icon" href="../assets/img/sci_logo.png" type="img/png">
    <title>ลงทะเบียน | ศิษย์เก่าคณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!--font awsome 6.1.2-->
    <script src="https://kit.fontawesome.com/bb6b0468a1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="../assets/css/register.css">
   

</head>
<body>
    <?php 
        $sql_provinces = "SELECT * FROM provinces";
        $query = mysqli_query($conn, $sql_provinces);
    ?>
    <div class="wrapper py-4">
            
			<div class="inner">
				<div class="image-holder">
					<img style="box-shadow: rgb(0, 0, 0, 0.4) 3px 5px 12px;"
                         src="../assets/img/decoration-img/kku-2.jpg" alt=""> 
				</div>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                
					<h3>ลงทะเบียน</h3>
                    <div class="form-header pb-3"><h6> ข้อมูลทั่วไป</h6> &#x2015;&#x2015;&#x2015;&#x2015;</div>
                    <div class="form-row">
                        <div class="form-group col">
                            <input type="text" name="start_year" class="form-control" placeholder="ปีการศึกษาที่เข้า">
                        </div>
                        <div class="form-group col">
                            <input type="text" name="end_year" class="form-control" placeholder="ปีการศึกษาที่จบ">  
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <input type="text" name="student_id" class="form-control" placeholder="รหัสนักศึกษา" value=" ">
                            <span>*กรอกหรือไม่กรอกก็ได้</span>
                        </div>
                        <div class="form-group col">
                            <input type="text" name="email" class="form-control" placeholder="อีเมล" required>  
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <input type="text" name="username" class="form-control" placeholder="ชื่อผู้ใช้งาน" required> 
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">
                            <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" required> 
                            
                        </div>
                    </div>
                    
                    
                    <div class="form-header mt-3 mb-0 pb-3"><h6>ข้อมูลส่วนตัว</h6> &#x2015;&#x2015;&#x2015;&#x2015;</div>
					<div class="form-row">
                        <div class="form-group col">
                            <input type="text" name="firstname" class="form-control" placeholder="ชื่อ" required> 
                        </div>
                        <div class="form-group col">
                            <input type="text" name="lastname" class="form-control" placeholder="นามสกุล" required>  
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-4">
                            <select name="gender" id="gender" class="form-select" required>
                                <option value="">เพศ</option>
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                                <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                        </div>

                        <div class="form-group col-4">
                            <select name="fos_id" id="" class="form-select" required>
                                <option value="">สาขา</option>
                                <?php // Feching active Field Of Study
                                $fos=mysqli_query($conn,"SELECT fos_id,
                                                                fos_name
                                                           from field_of_study
                                                          where Is_Active=1
                                                        ");
                                while($result=mysqli_fetch_array($fos)) { ?>
                                <option value="<?php echo htmlentities($result['fos_id']);?>">
                                    <?php echo htmlentities($result['fos_name']);?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>                   
                                     
                        <div class="form-group col-4">
                            <select name="career_id" id="" class="form-select" required>
                                <option value="">อาชีพ</option>
                                <?php // Feching active Career
                                $career=mysqli_query($conn,"SELECT career_id,
                                                                   career_name
                                                              from career
                                                             where Is_Active=1
                                                        ");
                                while($result=mysqli_fetch_array($career)) { ?>
                                <option value="<?php echo htmlentities($result['career_id']);?>">
                                    <?php echo htmlentities($result['career_name']);?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <input type="date" name="date_of_birth" class="form-control">             
                        </div>
                    
                    </div>

                    <div class="form-header mt-3 mb-0 pb-3"><h6>ที่อยู่</h6>  &#x2015;&#x2015;&#x2015;&#x2015; </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <input type="text" name="address" class="form-control" placeholder="บ้านเลขที่"> 
                        </div>
                        <div class="form-group col">
                            <input type="text" name="postal_code" class="form-control" placeholder="รหัสไปรษณีย์"> 
                        </div>
                    </div>

                    <div class="form-row">
                    <div class="form-group col-md-4">
                        
                        <select name="province_id" id="province" class="form-select">
                            <option value="">เลือกจังหวัด</option>
                            <?php while($result = mysqli_fetch_assoc($query)): ?>
                                <option value="<?=$result['id']?>"><?=$result['name_th']?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        
                        <select name="amphure_id" id="amphure" class="form-select">
                            <option value="">เลือกอำเภอ</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        
                        <select name="district_id" id="district" class="form-select">
                            <option value="">เลือกตำบล</option>
                        </select>
                    </div>
                </div>                
            

                    <br>
                    <p class="go-back">มีบัญชีอยู่แล้ว ? <a href="./login_form.php">คลิกที่นี่ </a>เพื่อเข้าสู่ระบบ</p>
                    
                    <button type="submit" name="register">ลงทะเบียน<i class="zmdi zmdi-long-arrow-right"></i></button>
                    
                    
				</form>
				
			</div>
		</div>
</body>
</html>

<script src="script.js"></script>

<script src="../assets/js/jquery-3.3.1.min.js"></script>
<script src="../assets/js/register.js"></script>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function(){
        if(password.type === "password"){
            password.type = 'text';
        }else{
            password.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });
</script>





