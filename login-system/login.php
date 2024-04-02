<?php
session_start();
include('../db/connection.php');
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
                }
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
                    <script>alert("Please verify email account before login.");</script>
                <?php }else if(password_verify($password, $hashpassword)){ ?>
                    <script>alert("login in successfully");</script>
                <?php }else{ ?>
                    <script>alert("email or password invalid, please try again.");</script>              
                <?php
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