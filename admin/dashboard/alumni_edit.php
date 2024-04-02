<?php
include('../../db/connection.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if(isset($_POST['submit'])) {
        $id             = intval($_GET['pid']);
        $student_id     = $_POST['student_id'];
        $username       = $_POST['username'];
        $userlevel      = $_POST['userlevel'];
        $email          = $_POST['email'];
        $phone_number   = $_POST['phone_number'];
        $address        = $_POST['address'];
        $province_id    = $_POST['province_id'];
        $amphure_id     = $_POST['amphure_id'];
        $district_id    = $_POST['district_id'];
        $firstname      = $_POST['firstname'];
        $lastname       = $_POST['lastname'];
        $gender         = $_POST['gender'];
        $fos_id         = $_POST['fos_id'];
        $start_year     = $_POST['start_year'];
        $end_year       = $_POST['end_year'];
        $company        = $_POST['company'];
        $career_id      = $_POST['career_id'];
        $date_of_birth  = date('Y-m-d', strtotime($_POST['date_of_birth']));

        if (empty($email)) {
            header("Location: ./alumni_edit.php?error=emptyemail");
            exit();

        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ./alumni_edit.php?error=invalidmail");
            exit();
            
        } else if ($password === $confirm_password) {
        $query=mysqli_query($conn,"UPDATE user
                                      set student_id    ='$student_id',
                                          username      ='$username',
                                          userlevel     ='$userlevel',
                                          email         ='$email',
                                          phone_number  ='$phone_number',
                                          address       ='$address',
                                          province_id   ='$province_id',
                                          amphure_id    ='$amphure_id',
                                          district_id   ='$district_id',
                                          firstname     ='$firstname',
                                          lastname      ='$lastname',
                                          gender        ='$gender',
                                          fos_id        ='$fos_id',
                                          start_year    ='$start_year',
                                          end_year      ='$end_year',
                                          company       ='$company',
                                          career_id     ='$career_id',
                                          date_of_birth ='$date_of_birth'
                                    where id='$id'
                                    ");
        if($query) {
            $msg="User Updated successfully ";
            $date = date("Y-m-d");
            $sql2 = "SELECT * FROM user
                    JOIN career on career.career_id=user.id
                    JOIN field_of_study on field_of_study.fos_id=user.id
                    ";
            $dataup = 
            $student_id     .",".
            $username       .",".
            $firstname      .",".
            $lastname       .",".
            $email          .",".
            $phone_number   .",".
            $address        .",".
            $gender         .",".
            $fos_id         .",".
            $career_id      .",".
            $start_year     .",".
            $end_year       .",".
            $company        .",".
            $date_of_birth  .",".
            $province_id    .",".
            $amphure_id     .",". 
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
            } else {
                $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
            } 
        }
    }
    include('header_dashboard.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<style>a {text-decoration: none;}</style>
<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ศิษย์เก่า</a> >
            <a href="./alumni_manage.php">จัดการศิษย์เก่า</a> >
            <a href="./alumni_edit.php">แก้ใขศิษย์เก่า</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>จัดการศิษย์เก่า</strong>
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


        <?php 
        $id=intval($_GET['pid']);
        $query=mysqli_query($conn,"SELECT   user.id                  as id,
                                            user.student_id          as student_id,
                                            user.username            as username,
                                            user.email               as email,
                                            user.phone_number        as phone_number,
                                            user.firstname           as firstname,
                                            user.lastname            as lastname,
                                            user.gender              as gender,
                                            user.status              as email_stutus,
                                            user.userlevel           as userlevel,
                                            user.start_year          as start_year,
                                            user.end_year            as end_year,
                                            user.address             as useraddress,
                                            user.province_id         as province_id,
                                            user.amphure_id          as amphure_id,
                                            user.district_id         as district_id,
                                            user.company             as company,
                                            user.date_of_birth       as date_of_birth,
                                            field_of_study.fos_name  as fos_name,
                                            career.career_name       as career_name,
                                            user.created_at          as created_at                                         
                                       from user
                                  left join field_of_study    on field_of_study.fos_id = user.fos_id
                                  left join career            on career.career_id = user.career_id                                  
                                      where user.Is_Active = 1
                                        and id='$id'
                                     ");
        $cnt=1;
        while($row=mysqli_fetch_array($query)) { ?>
        
            <div class="row mt-2">
            <div class="col-12 d-flex justify-content-between">
                <div><h3 class="font-weight-bold"><?php echo htmlentities($row['student_id'].' '.$row['firstname'].' '.$row['lastname']);?></h3></div>
                <div><span class="pr-3">สร้างบัญชีเมื่อ [<?php echo htmlentities($row['created_at']);?>]</span>
                    <span><a class="btn btn-primary" href="alumni_manage.php">ย้อนกลับ</a></span>
                </div>
            </div>
            </div>
            
            
        	<div class="row">   
                <div class="col-lg-6 col-md-6 col-sm-12 p-0">       
                <form class="form-horizontal" name="userupdate" method="post">
	                    <div class="form-group">
	                        <label class="col-md-12 control-label">รหัสนักศึกษา</label>
	                        <div class="col-md-12">
	                            <input type="text" class="form-control" 
                                    value="<?php echo htmlentities($row['student_id']);?>" 
                                    name="student_id">
	                        </div>
	                    </div>
	                                     
	                    <div class="form-group">
	                        <label class="col-md-12 control-label">ชื่อผู้ใช้งาน</label>
	                        <div class="col-md-12">
                                <input type="text" class="form-control" 
                                    value="<?php echo htmlentities($row['username']);?>" 
                                    name="username">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">ระดับผู้ใช้งาน</label>
	                        <div class="col-md-12">
                                <input type="text" class="form-control" 
                                    value="<?php echo htmlentities($row['userlevel']);?>" 
                                    name="userlevel">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">อีเมล</label>
	                        <div class="col-md-12">
                                <input type="text" class="form-control" 
                                    value="<?php echo htmlentities($row['email']);?>" 
                                    name="email">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">เบอร์โทรศัพท์</label>
	                        <div class="col-md-12">
                                <input type="text" class="form-control" 
                                    value="<?php echo htmlentities($row['phone_number']);?>" 
                                    name="phone_number">
	                        </div>
	                    </div>                

                        <div class="form-group">
	                        <label class="col-md-12 control-label">ปีที่เข้ารับการศึกษา</label>
	                        <div class="col-md-12">                           
	                            <input type="text" class="form-control"    
                                    value="<?php echo htmlentities($row['start_year']); ?>" 
                                    name="start_year">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">ปีที่สำเร็จการศึกษา</label>
	                        <div class="col-md-12">                           
	                            <input type="text" class="form-control" 
                                    value="<?php echo htmlentities($row['end_year']); ?>" 
                                    name="end_year">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">สถานที่ทำงาน</label>
                            <?php $companyname = '';
                                if($row['company'] == '') {
                                    $companyname = 'ไม่ระบุ';
                                } else {
                                    $companyname = $row['company'];
                                } ?>
	                        <div class="col-md-12">                           
	                            <input type="text" class="form-control" 
                                    value="<?php echo htmlentities($companyname);?>" 
                                    name="company">
	                        </div>
	                    </div>

                        <div class="form-group">
                            <label class="col-md-12 control-label">อาชีพ</label>
                            <div class="col-md-12">
                            <select name="career_id" id="" class="form-select" required>
                            <?php $careername = '';
                                if($row['career_id'] == 0) {
                                    $careername = 'ไม่ระบุ';
                                } else {
                                    $careername = $row['career_id'];
                                } ?>
                            <option selected><?php echo htmlentities($careername);?></option>
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
                            
                        

                    </div>
                                            
                    <!---->
                    <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                    <div class="form-group">
	                        <label class="col-md-12 control-label">ชื่อจริง</label>
	                        <div class="col-md-12">                           
	                            <input type="text" class="form-control" 
                                    value="<?php echo htmlentities($row['firstname']);?>" 
                                    name="firstname">
	                        </div>
	                    </div>
                    
                    
                        <div class="form-group">
	                        <label class="col-md-12 control-label">นามสกุล</label>
	                        <div class="col-md-12">                           
	                            <input type="text" class="form-control" 
                                    value="<?php echo htmlentities($row['lastname']);?>" 
                                    name="lastname">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">เพศ</label>
                            <?php $gendervalue = '';
                                  if($row['gender'] == '') { 
                                     $gendervalue = 'ไม่ระบุ'; } else {
                                     $gendervalue = $row['gender']; } ?>
                            <div class="col-md-12">
	                        <select name="gender" id="gender" class="form-select" required>
                                <option selected><?php echo htmlentities($gendervalue); ?></option>
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
                            <option selected><?php echo htmlentities($row['fos_name']);?></option>
                            <?php while($row = mysqli_fetch_array($fos)) { ?>

                                <option value="<?php echo htmlentities($row['fos_id']);?>">
                                    <?php echo htmlentities($row['fos_name']);?>
                                </option>
                            
                            <?php } ?>

                            </select>
                        </div>
	                    </div>

                         
                        
                        <div class="form-group">
	                        <label class="col-md-12 control-label">วัน/เดือน/ปี เกิด</label>
                            <?php 
                                $birthday = '';
                                if($row['date_of_birth'] == '') {
                                    $birthday = '00/00/0000';
                                } else {
                                    $birthday = $row['date_of_birth'];
                                }
                            ?>
	                        <div class="col-md-12">                           
	                            <input type="date" class="form-control" 
                                    value="<?php echo htmlentities($birthday);?>" 
                                    name="date_of_birth">
	                        </div>
	                    </div>

                        <div class="form-group">
	                        <label class="col-md-12 control-label">บ้านเลขที่</label>
	                        <div class="col-md-12">
                                <input type="text" class="form-control" 
                                    value="<?php echo htmlentities($row['useraddress']);?>" 
                                    name="address">
	                        </div>
	                    </div>                                                           
        
                    <!--select จังหวัด / อำเภอ / ตำบล-->
                        <?php 
                            $sql2 = "SELECT * FROM provinces";
                            $query = mysqli_query($conn, $sql2);             
                            if($row['province_id'] == '') {
                                $choosepv = 'จังหวัด'; } else {
                                $choosepv = $row['province_id']; } ?>                                                                                   
                        <div class="form-group col-md-12">
                            <label class="form-label">จังหวัด</label> 
                            <select name="province_id" id="province" class="form-select">
                                <option selected><?php echo $choosepv; ?></option>
                                    <?php while($result = mysqli_fetch_assoc($query)): ?>
                                    <option value="<?=$result['id']?>"><?=$result['name_th']?></option>
                                    <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <?php if($row['amphure_id'] == '') {
                                    $chooseam = 'อำเภอ'; } else {
                                    $chooseam = $row['amphure_id']; } ?> 
                            <label class="form-label">อำเภอ</label> 
                                <select name="amphure_id" id="amphure" class="form-select">
                                    <option value=""><?php echo $chooseam; ?></option>
                                </select>
                        </div>

                        <div class="form-group col-md-12">
                            <?php if($row['district_id'] == '') {
                                    $choosedt = 'ตำบล'; } else {
                                    $choosedt = $row['district_id']; } ?> 
                            <label class="form-label">ตำบล</label> 
                                <select name="district_id" id="district" class="form-select">
                                    <option value=""><?php echo $choosedt; ?></option>
                                </select>
                        </div>

                    </div>

                <?php } ?>
            
                 <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                    <div class="form-group">
                        <label class="col-md-12 control-label">&nbsp;</label>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success" name="submit">
                                Update
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

<?php } ?>