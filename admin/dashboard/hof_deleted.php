<?php
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if($_GET['action']='restore') {
        $id=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE hall_of_fame
                                      set Is_Active=1
                                    where id='$id'
                                 ");
        if($query) {
            $msg="restored successfully ";
        } else{
            $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
        } 
    }

    if($_GET['perdel']) { 
        $id=intval($_GET['perdel']);
        $query=mysqli_query($conn,"DELETE from hall_of_fame
                                         where id='$id'
                                        ");
        $delmsg="deleted forever";
    }
?>
<link href="../../assets/css/defaultDashboard.css" rel="stylesheet" >
<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ศิษย์เก่า</a> >
            <a href=" ">จัดการศิษย์เก่า</a> >
            <a href="#">ศิษย์เก่าที่ถูกลบ</a> 
        </div>
        <div class="pt-2 d-flex justify-content-between">
		    <div><strong style="font-size: 40px;">ศิษย์เก่าที่ถูกลบ</strong></div>
            <div>
                <a class="btn btn-primary py-2 align-items-center" href="hof_dashboard.php">ย้อนกลับ</a>
            </div>
	    </div>
   
        <div class="row">       
            <div class="col-sm-6">  
                <?php if($delmsg){ ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>ขออภัย</strong> <?php echo htmlentities($delmsg);?>
                    </div>
                <?php } ?>
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
            <th>จัดการ</th>
			</tr>
        </thead>
        <tbody>
		<?php
			$num = 0;
			$sql = mysqli_query($conn,"SELECT  *
                                         from hall_of_fame
                                        where Is_Active = 0
                                        ");  
			 $rowcount=mysqli_num_rows($sql);
             if($rowcount==0) { ?>
                 <tr><td colspan="7" class="text-center"><h2 class="p-5">ไม่พบข้อมูลในระบบ</h2></td><tr>
             <?php } else {
                 while($row=mysqli_fetch_array($sql)) { ?>
		
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
                <td><a href="hof_deleted.php?pid=<?php echo htmlentities($row['id']);?>
                        &&action=restore" onclick="return confirm('คุณต้องการจะกู้คืนข้อมูลนี้หรือไม่ ?')">
                        <i class="fa fa-reply" title="Restore this Post"></i>
                    </a>&nbsp; 
                    <a href="hof_deleted.php?perdel=<?php echo htmlentities($row['id']);?>
                        &&action=perdel" onclick="return confirm('คุณต้องการจะลบข้อมูลนี้หรือไม่ ?')">
                        <i class="fa fa-trash-o" style="color: #f05050"></i>
                    </a>
                </td>
            </tr>
			<?php } } ?>
		</tbody>
	</table>
    
                    </div>
                </div>
            </div>
        </div>            

    </div>   
    
    <?php include('DashboardScript.php') ?>
</body>
<?php } ?>

