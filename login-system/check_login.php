<?php

include "../db/connection.php";
session_start(); 
 if (isset($_POST['username']) && isset($_POST['psw'])) {
     $username = $_POST['username'];
     $password = $_POST['password'];

     $sql = "SELECT * FROM user WHERE username = '$username' AND password = MD5('$password')";
     $result = mysqli_query($conn, $sql);
     if ($result) {
         $numrow = mysqli_num_rows($result);
         $row = mysqli_fetch_row($result);
         if ($numrow > 0) {
             echo "<script>
                     window.location ='./user_home.php'
                 </script>";
         } else {
             echo "<script>
                     alert('ไม่พบบัญชีของคุณ หรือ รหัสผ่านผิดพลาด')
                     window.location ='./login.php'
                 </script>";
         }
     }
 }


 ?>
