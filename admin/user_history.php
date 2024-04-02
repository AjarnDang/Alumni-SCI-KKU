<?php
include('../template/header_admin.php'); 
require_once("../template/pagination_function.php");

if (!isset($_SESSION['username'])) {
  header("location: ../login-system/login_form.php");
} 
?>
<style>
  body {background-color: #f5f5f5 !important;}
  .form-2 {background-color: white; padding: 2em; border-radius: 0.7em; box-shadow: 2px 5px 5px rgba(0, 0, 0, 0.1);}
</style>
<link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css" >
<link rel="stylesheet" href="../assets/css/header.css">

<div class="container mt-5">
  <div class="bread-crump mb-3">
      <a href="user_page.php">หน้าหลัก</a> >
      <a href="user_profile.php">บัญชีของฉัน</a> >
      <a href="#">ประวัติการเปลี่ยนแปลงข้อมูล</a> 
    </div>
<div class="form-2">
    <div class="d-flex justify-content-between">
        <div><h3 class="mb-4">ประวัติการเปลี่ยนแปลงข้อมูล</h1></div>
        <div><a class="text-secondary" href="user_profile.php">ย้อนกลับ</a></div>
      </div>
      <?php
        $studentId = $_SESSION['userid'];
        $num = 0;
        $sql = "SELECT * FROM user_update_at WHERE upd_id='$studentId'"; 
        $result=$conn->query($sql);
        $total=$result->num_rows;
        
        $e_page=10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
        $step_num=0;
        if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page']==1)){   
            $_GET['page']=1;   
            $step_num=0;
            $s_page = 0;    
        }else{   
            $s_page = $_GET['page']-1;
            $step_num=$_GET['page']-1;  
            $s_page = $s_page*$e_page;
        }   
        $sql.="ORDER BY upd_id LIMIT ".$s_page.",$e_page";
        $result=$conn->query($sql);
        if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
            $rowcount=mysqli_num_rows($topic);
            if($rowcount ==! 0) {
            while($row = $result->fetch_assoc()){ // วนลูปแสดงรายการ
                $num++;
        ?>
            <hr class="mb-4">
              <!--<th class="text-center" scope="row"><//?=($step_num*$e_page)+$num?></th>-->
              <p style="text-align:left;"><?php echo "<code>วันที่ (เวลา) : </code>" . $row['update_time']; ?></p>
              <p class="text-left" ><?=$row['update_data']?></p>
            
        <?php
            }   
          } else {
            echo "<p class='text-center'>ไม่พบประวัติการเปลี่ยนแปลง</p>";
          }
        }
        ?>
      <div style="height: 1em;"></div>
      <?php page_navi($total,(isset($_GET['page']))?$_GET['page']:1,$e_page);?>
    </div>
  </div>
    

<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
<?php include('../template/footer_users.php'); ?>