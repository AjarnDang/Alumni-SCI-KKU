<?php
include('../../db/connection.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if(isset($_POST["register"])){  
          
        $student_id =       $_POST['student_id'];
        $username =         $_POST['username'];
        $userlevel =        $_POST["userlevel"];
        $email =            $_POST["email"];
        $phone_number =     $_POST["phone_number"];
        $address =          $_POST['address'];
        $province_id =      $_POST['province_id'];
        $amphure_id =       $_POST['amphure_id'];
        $district_id =      $_POST['district_id'];
        $firstname =        $_POST['firstname'];
        $lastname =         $_POST['lastname'];
        $gender =           $_POST['gender'];
        $fos_id =           $_POST['fos_id'];
        $start_year=        $_POST['start_year'];
        $end_year=          $_POST['end_year'];
        $company =          $_POST['company'];
        $career_id =        $_POST['career_id'];
        $date_of_birth =    date('Y-m-d', strtotime($_POST['date_of_birth']));
        
        $password =         $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        $check_query = mysqli_query($conn, "SELECT * FROM user
                                            where username ='$username'
                                                ");
        $rowCount = mysqli_num_rows($check_query);       
        if(!empty($username) && !empty($password)){
            if($rowCount > 0){ 
                $error="Username already exist.";
            } if($password != $confirm_password) { 
                $error="Password or Confirm password is disparate.";
            } else {
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                $result = mysqli_query($conn,
                "INSERT INTO user(student_id,
                                  username,
                                  password,
                                  confirm_password,
                                  firstname,
                                  lastname,
                                  gender,
                                  fos_id,
                                  career_id,
                                  date_of_birth,
                                  company,
                                  email,
                                  phone_number,
                                  userlevel,
                                  status,
                                  address,
                                  province_id,
                                  amphure_id,
                                  district_id,
                                  start_year,
                                  end_year,
                                  Is_Active
                                )
                         VALUES ('$student_id',
                                 '$username',
                                 '$password',
                                 '$confirm_password',
                                 '$firstname',
                                 '$lastname',
                                 '$gender',
                                 '$fos_id',
                                 '$career_id',
                                 '$date_of_birth',
                                 '$company',
                                 '$email',
                                 '$phone_number',
                                 'member',
                                  1,
                                 '$address',
                                 '$province_id',
                                 '$amphure_id',
                                 '$district_id',
                                 '$start_year',
                                 '$end_year',
                                 1
                                )");
            }
        }
        if($result) {
            $msg="User Updated successfully ";
        } else {
            $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง"; 
        } 
    }

    include('header_dashboard.php');
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<style>a {text-decoration: none;}</style>
<body>
    <?php 
        $sql_provinces = "SELECT * FROM provinces";
        $query = mysqli_query($conn, $sql_provinces);
    ?>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ศิษย์เก่า</a> >
            <a href="./alumni_manage.php">เพิ่มศิษย์เก่า</a>
        </div>
        <div class="pt-2 header-product">
		    <strong>เพิ่มศิษย์เก่า</strong>
	    </div>
        <hr/> 

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">             
            <!---Success Message--->  
            <?php if($msg){ ?>
            <div class="alert alert-success" role="alert">
                <strong>สำเร็จ!</strong> <?php echo htmlentities($msg);?>
            </div>
            <?php } ?>

            <!---Error Message--->
            <?php if($error){ ?>
            <div class="alert alert-danger" role="alert">
                <strong>ขออภัย</strong> <?php echo htmlentities($error);?>
            </div>
            <?php } ?>
            </div>
        </div>
              
        	<div class="row">   
                <div class="col-lg-6 col-md-6 col-sm-12 p-0">        
                <form class="form-horizontal" name="userupdate" method="post">
	                    <div class="form-group">
	                        <label class="col-md-12 control-label">รหัสนักศึกษา</label>
	                        <div class="col-md-12">
	                            <input type="text" class="form-control" name="student_id" placeholder="6230xxxxx-x">
	                        </div>
	                    </div>
	                                     
	                    <div class="form-group">
	                        <label class="col-md-12 control-label">ชื่อผู้ใช้งาน</label>
	                        <div class="col-md-12">
                                <input type="text" class="form-control" name="username">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">รหัสผ่าน</label>
	                        <div class="col-md-12">
                                <input type="password" class="form-control" name="password">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">ยืนยันรหัสผ่าน</label>
	                        <div class="col-md-12">
                                <input type="password" class="form-control" name="confirm_password">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">ระดับผู้ใช้งาน</label>
	                        <div class="col-md-12">
                                <input type="text" class="form-control" name="userlevel" value="member" readonly>
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">อีเมล</label>
	                        <div class="col-md-12">
                                <input type="email" class="form-control" name="email">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">เบอร์โทรศัพท์</label>
	                        <div class="col-md-12">
                                <input type="text" class="form-control" name="phone_number" max="10">
	                        </div>
	                    </div>                

                        <div class="form-group">
	                        <label class="col-md-12 control-label">วัน/เดือน/ปี เกิด</label>
	                        <div class="col-md-12">                           
	                            <input type="date" class="form-control" name="date_of_birth">
	                        </div>
	                    </div>
                        
                        <div class="form-group">
	                        <label class="col-md-12 control-label">ปีที่เข้ารับการศึกษา</label>
	                        <div class="col-md-12">                           
	                            <input type="text" class="form-control" name="start_year">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">ปีที่สำเร็จการศึกษา</label>
	                        <div class="col-md-12">                           
	                            <input type="text" class="form-control" name="end_year">
	                        </div>
	                    </div>

                                                   
                    </div>
                                            
                    <!---------------------->
                    <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                    <div class="form-group">
	                        <label class="col-md-12 control-label">ชื่อจริง</label>
	                        <div class="col-md-12">                           
	                            <input type="text" class="form-control" name="firstname">
	                        </div>
	                    </div>
                    
                    
                        <div class="form-group">
	                        <label class="col-md-12 control-label">นามสกุล</label>
	                        <div class="col-md-12">                           
	                            <input type="text" class="form-control" name="lastname">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">เพศ</label>
                            <div class="col-md-12">
	                        <select name="gender" id="gender" class="form-select" required>
                                <option selected>เพศ</option>
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                                <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                             </div>
	                    </div>

                        <div class="form-group">
                        <label class="col-md-12 control-label">สาขา</label>
                        <div class="col-12">
                            <select name="fos_id" class="form-select" required>
                                <?php // Feching active field of study
                                    $fos=mysqli_query($conn,"SELECT fos_id,
                                                                fos_name
                                                        from field_of_study
                                                        where Is_Active=1
                                                        "); ?>
                            <option selected>สาขา</option>
                            <?php while($row = mysqli_fetch_array($fos)) { ?>
                                <option value="<?php echo htmlentities($row['fos_id']);?>">
                                    <?php echo htmlentities($row['fos_name']);?>
                                </option>                          
                            <?php } ?>
                            </select>
                        </div>
	                    </div>
                                              

                        <div class="form-group">
	                        <label class="col-md-12 control-label">สถานที่ทำงาน</label>
	                        <div class="col-md-12">                           
	                            <input type="text" class="form-control" name="company">
	                        </div>
	                    </div>

                        <div class="form-group">
                            <label class="col-md-12 control-label">อาชีพ</label>
                            <div class="col-md-12">
                            <select name="career_id" id="" class="form-select" required>
                            <option value="">เลือกอาชีพ</option>
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
                        </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">บ้านเลขที่</label>
	                        <div class="col-md-12">
                                <input type="text" class="form-control" name="address">
	                        </div>
	                    </div>                                                           
        
                    <!--select จังหวัด / อำเภอ / ตำบล-->             
                    <div class="form-group col-md-12">
                    <label>จังหวัด</label>
                        <select name="province_id" id="province" class="form-select">
                            <option value="">เลือกจังหวัด</option>
                            <?php while($result = mysqli_fetch_assoc($query)): ?>
                                <option value="<?=$result['id']?>"><?=$result['name_th']?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                    <label>อำเภอ</label>
                        <select name="amphure_id" id="amphure" class="form-select">
                            <option value="">เลือกอำเภอ</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                    <label>ตำบล</label>
                        <select name="district_id" id="district" class="form-select">
                            <option value="">เลือกตำบล</option>
                        </select>
                    </div>
                

                    </div>

                <?php } ?>
            
                 <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                    <div class="form-group">
                        <label class="col-md-12 control-label">&nbsp;</label>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success" name="register">
                                Confirm
                            </button> 
                        </div>
                    </div>
                 </div>
         
	        </form>               
                
        </div>   
    </div>
    
    <script src="script.js"></script>
    <script src="jquery.min.js"></script>
    
    <?php include('DashboardScript.php'); ?>
</body>