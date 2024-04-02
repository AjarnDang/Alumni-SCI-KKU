<?php 
session_start() ;
?>
<script src="https://kit.fontawesome.com/0f35e6e1c5.js" crossorigin="anonymous"></script>    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>   
<link href="../assets/css/header.css" rel="stylesheet">
<style>
    body {background-color: rgb(245, 245, 245) !important;}
    .card {box-shadow: 0 5px 5px rgb(228, 228, 228)}
    .image-cover {
        height: 50vh;
        width: 100%;
        display: flex;
        flex-direction: column;
        background-position: center;
        }
    
</style>
<body>

<main class="login-form mt-5">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="card content">
                    <div class="card-header bg-white">กู้คืนรหัสผ่าน</div>
                    <div class="image-cover" style="background-image: url(../assets/img/60314.jpg);"></div>
                    <div class="card-body mt-4">
                        <form method="POST" name="recover_psw">
                            <div class="form-group row justify-content-md-center">
                            <label class="col-lg-2 col-form-label" for="">กรอกอีเมล</label>
                                <div class="col-md-auto">
                                    <input type="email" name="email" class="form-control" placeholder="อีเมล" required autofocus>
                                </div>
                                <div class="col-lg-2 text-left">
                                <input class="btn" type="submit" value="ยืนยัน" name="submit">
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
</body>

<?php
if(isset($_POST["submit"])){
    include('../db/connection.php');
    $email = $_POST["email"];

    $sql = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    $query = mysqli_num_rows($sql);
  	$fetch = mysqli_fetch_assoc($sql);

        if(mysqli_num_rows($sql) <= 0){ ?>
            <script>alert("<?php  echo "ขออภัย ไม่พบอีเมลดังกล่าวในระบบ"?>");</script>
            <?php
        }else if($fetch["status"] == 0){
            ?>
               <script>
                   alert("ขออภัย อีเมลดังกล่าวยังไม่รับการยืนยัน กรุณายืนยันอีเมลก่อนทำรายการอีกครั้ง");
                   window.location.replace("recover_psw.php");
               </script>
           <?php
        }else{
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            // session_start ();
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            require "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            // host account
            $mail->Username='wiwsoos@gmail.com';
            $mail->Password='0812601030';

            // send by host email
            $mail->setFrom('wiwsoos@gmail.com', 'Password Reset');
            // get email from input
            $mail->addAddress($_POST["email"]);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            $mail->isHTML(true);
            $mail->Subject="Recover your password";
            $mail->Body="<b>Dear User</b>
            <h3>We received a request to reset your password.</h3>
            <p>Kindly click the below link to reset your password</p>
            http://localhost/alumni_project/login-system/reset_psw.php
            <br><br>
            <p>With regrads,</p>
            <b>Alumni Admin</b>";

            if($mail->send()){ ?>
                <script>window.location.replace("notification.html");</script>           
            <?php }else{ ?>
                <script>alert("<?php echo "ไม่พบอีเมล หรืออีเมลไม่ถูกต้อง"?>");</script>
            <?php
            }
        }
    }
?>



