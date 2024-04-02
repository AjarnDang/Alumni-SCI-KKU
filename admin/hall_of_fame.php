<?php 
include('../template/header_admin.php'); 
require_once('../template/pagination_function.php');
?>
<link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/hall_of_fame.css">

<div class="new-background">
<div id="banner" style="background-image: url('../assets/img/decoration-img/kku-darker.jpg');">
    <div class="container">
        <div class="topic">
            <h1><b>Hall of Fame</b></h1>
            <h4>หอเกียรติยศ คณะวิทยาศาสตร์<br> มหาวิทยาลัยขอนแก่น</h4>
        </div>
    </div>
</div>
</div>

<div class="container">
    <div class="bread-crump mb-3 mt-4">
        <a href="home.php">หน้าหลัก</a> >
        <a href="#">Hall of Fame (หอเกียรติยศ)</a>
      </div>
    <div class="row">    
    <?php
        $num = 0;
        $sql = "SELECT * FROM hall_of_fame WHERE 1 ";  
        $result=$conn->query($sql);
        $total=$result->num_rows;
        
        $e_page = 16; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
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
        $sql.="ORDER BY id LIMIT ".$s_page.",$e_page";
        $result=$conn->query($sql);
        if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
            while($row = $result->fetch_assoc()) { // วนลูปแสดงรายการ
                $num++;
        ?>
            <div class="col-lg-3 col-sm-6 col-xs-6 pt-4">
            <div class="ymal">
                <a href="hall_of_fame_detail.php?id=<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['hof_image'] ?>" alt="">
                </a>
                <a href="hall_of_fame_detail.php?id=<?php echo $row['id']; ?>">
                    <div class="alumni-name text-center mt-3">
                        <h5><?php echo $row['hof_prefix']." ".$row['hof_firstname']." ".$row['hof_lastname']; ?></h5>
                        <p><?php echo $row['hof_position'] ?></p>
                    </div>
                </a>
            </div>
            </div>

        <?php 
                }
            }        
        ?>
</div>

<div style="height: 1em;"></div>
<?php page_navi($total,(isset($_GET['page']))?$_GET['page']:1,$e_page);?>
</div>

<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
<?php include('../template/footer_users.php'); ?>