<?php 
include('../../template/pagination_function.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
include('header_dashboard.php'); ?>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<body>
   <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ศิษย์เก่า</a> >
            <a href="./alumni_manage.php">จัดการศิษย์เก่า</a> >
            <a href="#">ประวัติการแก้ใขข้อมูลศิษย์เก่า</a>
        </div>
        <div class="pt-2 header-product"><strong>ประวัติการแก้ใขข้อมูลศิษย์เก่า</strong></div>
        <hr/>

    <div class="form-2">
      <div class="d-flex justify-content-end">
        <div><a class="btn btn-primary mb-3" href="alumni_manage.php">ย้อนกลับ</a></div>
      </div>
      <?php
        $id = $_GET['pid'];
        $num = 0;
        $sql =  "SELECT * FROM user_update_at 
                     left JOIN user on user.student_id = user_update_at.student_id
                         WHERE user.student_id = '$id'
                         ";  
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
        $sql.="ORDER BY update_time LIMIT ".$s_page.",$e_page";
        $result=$conn->query($sql);
        if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
            $rowcount = mysqli_num_rows($result);
            if($rowcount == 0) { ?>
                <h3 class="text-center">ไม่พบข้อมูลในระบบ</h3><?php 
            } else {
                while($row = $result->fetch_assoc()){ // วนลูปแสดงรายการ  ?>

            <div class="card">  
            <div class="card-body">
            <p class="text-left">
                <code>วันที่ (เวลา) : </code>
                <?php echo $row['update_time']; ?>
            </p><hr>
            <p class="text-left" ><?=$row['update_data']?></p>
            </div>
            </div>

        <?php
                }   
            }
        }
        ?>
      <div style="height: 1em;"></div>
      <?php page_navi($total,(isset($_GET['page']))?$_GET['page']:1,$e_page);?>

    </div>

   </div> 

<?php include('DashboardScript.php'); 
}?>
</body>