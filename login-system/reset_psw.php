<?php 
session_start() ;
include('../db/connection.php');
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
                    <div class="image-cover" style="background-image: url(../img/OJZ2LN0.jpg);"></div>
                    <div class="card-body mt-4">
                        <form action="#" method="POST" name="reset_psw">
                            <div class="form-group row justify-content-md-center">
                            <label class="col-lg-2 col-form-label" for="">รหัสผ่านใหม่</label>
                                <div class="col-md-auto">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="รหัสผ่าน" required autofocus>
                                </div>
                                <div class="col-lg-2 text-left">
                                <input class="btn" type="submit" value="รีเซต" name="reset">
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
    if(isset($_POST["reset"])){
        include('../connection.php');
        $psw = $_POST["password"];

        $token = $_SESSION['token'];
        $Email = $_SESSION['email'];

        $hash = password_hash( $psw , PASSWORD_DEFAULT );

        $sql = mysqli_query($conn, "SELECT * FROM user WHERE email='$Email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if($Email){
            $new_pass = $hash;
            mysqli_query($conn, "UPDATE user SET password='$new_pass' WHERE email='$Email'");
            ?>
            <script>
                window.location.replace("login_form.php");
                alert("<?php echo "อัปเดตรหัสผ่านสำเร็จ"?>");
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("<?php echo "ไม่สามารถอัปเดตรหัสผ่านได้ กรุณาลองใหม่อีกครั้ง"?>");
            </script>
            <?php
        }
    }

?>
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
