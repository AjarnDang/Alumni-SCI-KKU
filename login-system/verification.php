<?php 
session_start(); 
require('header.php');
?>
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
                    <div class="card-header bg-white">ยืนยันบัญชีผู้ใช้งาน</div>
                    <div class="image-cover" style="background-image: url(../img/ONZFBE0.jpg);"></div>
                    <div class="card-body mt-4">
                        <form action="#" method="POST">
                            <div class="form-group row justify-content-md-center">
                            <label class="col-lg-2 col-form-label" for="">กรอกรหัส OTP</label>
                                <div class="col-md-auto">
                                    <input type="text" id="otp" class="form-control" name="otp_code" placeholder="อีเมล" required autofocus>
                                </div>
                                <div class="col-lg-2 text-left">
                                <input class="btn" type="submit" value="ยืนยัน" name="verify">
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
<?php include('footer.php') ?>

<?php 
    include('../connection.php');
    if(isset($_POST["verify"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $otp_code = $_POST['otp_code'];

        if($otp != $otp_code){
            ?>
           <script>
               alert("Invalid OTP code");
           </script>
           <?php
        }else{
            mysqli_query($conn, "UPDATE user SET status = 1 WHERE email = '$email'");
            ?>
             <script>
                 alert("ยืนยันอีเมลสำเร็จ คุณสามารถเข้าสู้ระบบได้");
                   window.location.replace("login_form.php");
             </script>
             <?php
        }

    }

?>