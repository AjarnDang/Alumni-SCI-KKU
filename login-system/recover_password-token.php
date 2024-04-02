<?php 
    if(isset($_POST["recover"])){
        include('../db/connection.php');
        $email = $_POST["email"];
        $sql = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");

        $row= mysqli_fetch_array($sql);

        if(mysqli_num_rows($sql) <= 0){ ?>
            <script>alert("<?php  echo "ขออภัย ไม่พบอีเมลดังกล่าวในระบบ"?>");</script>

  <?php }elseif($row["status"] == 0){ ?>
            <script>alert("ขออภัย อีเมลดังกล่าวยังไม่รับการยืนยัน กรุณายืนยันอีเมลก่อนทำรายการอีกครั้ง");
                //window.location.replace("recover_psw.php");
            </script>

  <?php }elseif($row) {
            $token = md5($email).rand(10,9999);
 
            $expFormat = mktime(
            date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
            );
        
           $expDate = date("Y-m-d H:i:s",$expFormat);
        
           $update = mysqli_query($conn,"UPDATE user 
                                         set password='".$password."',
                                             reset_link_token='".$token."',
                                             exp_date='".$expDate."'
                                       WHERE email='". $email."'
                                       ");
        
           $link = "<a href='www.yourwebsite.com/reset-password.php?key=".$email."&token=".$token."'>คลิกที่นี่เพื่อรีเซ็ตรหัสผ่าน</a>";
        
           require_once('Mail/PHPMailerAutoload.php');
        
           $mail = new PHPMailer();
        
           $mail->CharSet =  "utf-8";
           $mail->IsSMTP();
           // enable SMTP authentication
           $mail->SMTPAuth = true;                  
           // GMAIL username
           $mail->Username = "torntan.j@gmail.com";
           // GMAIL password
           $mail->Password = "0812601030Aa@";
           $mail->SMTPSecure = "ssl";  
           // sets GMAIL as the SMTP server
           $mail->Host = "smtp.gmail.com";
           // set the SMTP port for the GMAIL server
           $mail->Port = "465";
           $mail->From='torntan.j@gmail.com';
           $mail->FromName='Alumni - Admin | Faculty of Science';
           $mail->AddAddress('reciever_email_id', 'reciever_name');
           $mail->Subject  =  'Reset Password';
           $mail->IsHTML(true);
           $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
           if($mail->Send())
           {
             echo "Check Your Email and Click on the link sent to your email";
           }
           else
           {
             echo "Mail Error - >".$mail->ErrorInfo;
           }
         }else{
           echo "Invalid Email Address. Go back";
         }
    }


?>