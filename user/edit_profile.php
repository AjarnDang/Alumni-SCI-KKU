<?php
    session_start();
  
    if (isset($_POST['submit1'])) {
        require '../db/connection.php';

        $student_id =       mysqli_real_escape_string($conn, ($_POST['student_id']));
        $password =         mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));
        $start_year =       mysqli_real_escape_string($conn, ($_POST['start_year']));   
        $end_year =         mysqli_real_escape_string($conn, ($_POST['end_year']));        
        
        $firstname =        mysqli_real_escape_string($conn, ($_POST['firstname']));
        $lastname =         mysqli_real_escape_string($conn, ($_POST['lastname']));
        $email =            mysqli_real_escape_string($conn, ($_POST['email']));
        $phone_number =     mysqli_real_escape_string($conn, ($_POST['phone_number']));
        
        $gender =           mysqli_real_escape_string($conn, ($_POST['gender']));
        $fos_id =           mysqli_real_escape_string($conn, ($_POST['fos_id']));
        $career_id =        mysqli_real_escape_string($conn, ($_POST['career_id']));

        $province_id =      mysqli_real_escape_string($conn, ($_POST['province_id']));
        $amphure_id =       mysqli_real_escape_string($conn, ($_POST['amphure_id']));
        $district_id =      mysqli_real_escape_string($conn, ($_POST['district_id']));

        $address =          mysqli_real_escape_string($conn, ($_POST['address']));
        $postal_code =      mysqli_real_escape_string($conn, ($_POST['postal_code']));

        if (empty($email)) {
            header("Location: ./user_profile.php?error=emptyemail");
            exit();

        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ./user_profile.php?error=invalidmail");
            exit();
        } else if ($password === $confirm_password) {
                    $sql = "UPDATE user SET
                                        student_id=       '$student_id',
                                        email=            '$email',
                                        password=         '$password',
                                        confirm_password= '$confirm_password',
                                        firstname=        '$firstname',
                                        lastname=         '$lastname',
                                        gender=           '$gender',
                                        fos_id=           '$fos_id',
                                        career_id=        '$career_id',
                                        start_year=       '$start_year',
                                        end_year=         '$end_year',                                       
                                        address=          '$address',
                                        postal_code=      '$postal_code',                                       
                                        province_id=      '$province_id',
                                        amphure_id=       '$amphure_id',
                                        district_id=      '$district_id',
                                        phone_number=     '$phone_number'
                                  WHERE username='{$_SESSION['username']}'
                                  ";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if ($result) {
                        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
                        $date = date("Y-m-d");
                        $sql2 = "SELECT * FROM user
                                          JOIN career on career.career_id=user.id
                                          JOIN field_of_study on field_of_study.fos_id=user.id
                                          ";
                        $dataup = $student_id.",".
                                  $firstname.",".
                                  $lastname.",".
                                  $start_year.",".
                                  $end_year.",".
                                  $email.",".
                                  $phone_number.",".
                                  $postal_code.",".
                                  $address.",".
                                  $gender.",".
                                  $fos_id.",".
                                  $career_id.",".
                                  $province_id.",".
                                  $amphure_id.",".
                                  $district_id;
                        $sqlupdateUser = "INSERT INTO user_update_at(student_id,
                                                                     update_at,
                                                                     update_data
                                                                     ) 
                                                             VALUES ('$student_id',
                                                                     '$date',
                                                                     '$dataup'
                                                                     )";
                        $resultUp = mysqli_query($conn, $sqlupdateUser);
                        header("Location: user_profile.php?error=emptyemail");
                    } else {
                        echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้');</script>";
                        echo $conn->error;
                    }         
        } else {
            echo "<script>alert('รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่อีกครั้ง');</script>";
        } 
    }
?>