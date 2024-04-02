<?php
include('header_dashboard.php');
require_once('../../template/pagination_function.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if($_GET['action']='del') {
        $id=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE hall_of_fame 
                                      set Is_Active=0
                                    where id='$id'
                                   ");
        if($query) {
            $msg="User deleted ";
        } else{
            $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
        } 
    }
?>
<link href="../../assets/css/defaultDashboard.css" rel="stylesheet" >
<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ศิษย์เก่าดีเด่น</a> >
            <a href="#">จัดการศิษย์เก่าดีเด่น</a> 
        </div>
        <div class="pt-2 d-flex justify-content-between">
		    <div><strong style="font-size: 40px;">จัดการศิษย์เก่าดีเด่น</strong></div>
            <div>
                <a class="btn btn-primary py-2 align-items-center" href="hof_add.php">เพิ่มศิษย์เก่าดีเด่น</a>
                <a class="btn btn-danger py-2 align-items-center" href="hof_deleted.php">ศิษย์เก่าดีเด่นที่ถูกลบ</a>
            </div>
	    </div>
    

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="table-responsive">
                    <table class="table table-colored table-centered table-inverse m-0">
        <thead>
			<tr> 
			<th>#</th>                                         
			<th>รูปภาพ</th>
			<th>ชื่อ-สกุล</th>
            <th>อาชีพ/ตำแหน่ง ปัจจุบัน</th>
            <th>ศิษย์เก่าประจำปี</th>
            <th>ความเชี่ยวชาญ</th>
            <th>รางวัลที่เคยได้รับ</th>
            <th>แอ็คชัน</th>
			</tr>
        </thead>
        <tbody>
		<?php
			$num = 0;
			$sql = "SELECT *
                       from hall_of_fame
                      where hall_of_fame.Is_Active = 1
					  ";  
			$result=$conn->query($sql);
			$total=$result->num_rows;
			
			$e_page = 12; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
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
			$sql.="ORDER BY id DESC LIMIT ".$s_page.",$e_page";
			$result=$conn->query($sql);
			if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
				while($row = $result->fetch_assoc()) { // วนลูปแสดงรายการ
					$num++;
		?>
			<tr><td><?php echo ($step_num*$e_page)+$num; ?></td>
                <td><img width="30" height="150" src="<?php echo htmlentities($row['hof_image'])?>" alt=""></td>        
                <td><?php echo htmlentities($row['hof_prefix'].' '.$row['hof_firstname'].' '.$row['hof_lastname'])?></td>
                <td><?php echo htmlentities($row['hof_position'])?></td>
                <td><?php echo htmlentities($row['hof_year'])?></td>
                <td><ul class="hof-mastery">
                    <?php if($row['hof_mastery']   != "") { ?><li>- <?php echo htmlentities($row['hof_mastery'])  ?></li><?php } ?>
                    <?php if($row['hof_mastery_2'] != "") { ?><li>- <?php echo htmlentities($row['hof_mastery_2'])?></li><?php } ?>
                    <?php if($row['hof_mastery_3'] != "") { ?><li>- <?php echo htmlentities($row['hof_mastery_3'])?></li><?php } ?>
                    <?php if($row['hof_mastery_4'] != "") { ?><li>- <?php echo htmlentities($row['hof_mastery_4'])?></li><?php } ?>
                    <?php if($row['hof_mastery_5'] != "") { ?><li>- <?php echo htmlentities($row['hof_mastery_5'])?></li><?php } ?>    
                </ul></td>
                <td><ul class="hof-reward">
                    <?php if($row['hof_reward']   != "") { ?><li>- <?php echo htmlentities($row['hof_reward'])  ?></li><?php } ?>
                    <?php if($row['hof_reward_2'] != "") { ?><li>- <?php echo htmlentities($row['hof_reward_2'])?></li><?php } ?>
                    <?php if($row['hof_reward_3'] != "") { ?><li>- <?php echo htmlentities($row['hof_reward_3'])?></li><?php } ?>
                    <?php if($row['hof_reward_4'] != "") { ?><li>- <?php echo htmlentities($row['hof_reward_4'])?></li><?php } ?>
                    <?php if($row['hof_reward_5'] != "") { ?><li>- <?php echo htmlentities($row['hof_reward_5'])?></li><?php } ?>    
                </ul></td>
                <td><a href="hof_edit.php?pid=<?php echo htmlentities($row['id']);?>">
                        <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                    </a>&nbsp; 
                    <a href="hof_dashboard.php?pid=<?php echo htmlentities($row['id']);?>
                        &&action=del" onclick="return confirm('คุณต้องการจะลบข้อมูลนี้หรือไม่ ?')">
                        <i class="fa fa-trash-o" style="color: #f05050"></i>
                    </a>
                </td>
            </tr>
			<?php } } ?>
		</tbody>
	</table>
    <div class="mt-5">
    <?php page_navi($total,(isset($_GET['page']))?$_GET['page']:1,$e_page);?>
    </div>
                    </div>
                </div>
            </div>
        </div>            

    </div>   
    
    <?php include('DashboardScript.php') ?>
</body>
<?php } ?>

