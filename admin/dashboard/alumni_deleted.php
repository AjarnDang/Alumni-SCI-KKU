<?php
include('header_dashboard.php');
require_once('../../template/pagination_function.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if($_GET['action']='restore') {
        $id=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE user
                                      set Is_Active=1
                                    where id='$id'
                                 ");
        if($query) {
            $msg="User restored successfully ";
        } else{
            $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
        } 
    }

    if($_GET['presid']) { // Forever deletionparmdel
        $id=intval($_GET['presid']);
        $query=mysqli_query($conn,"DELETE from user
                                         where id='$id'
                                        ");
        $delmsg="User deleted forever";
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
                <a class="btn btn-primary py-2 align-items-center" href="alumni_manage.php">ย้อนกลับ</a>
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
			<th>รหัสนักศึกษา</th>
            <th>ชื่อผู้ใช้งาน</th>
			<th>อีเมล</th>
			<th>ชื่อ-สกุล</th>
			<th>สาขา/ภาควิชา</th>
            <th>จัดการ</th>
			</tr>
        </thead>
        <tbody>
		<?php
			$num = 0;
			$sql = "SELECT  user.id                  as id,
                            user.student_id          as student_id,
                            user.username            as username,
                            user.email               as email,
                            user.firstname           as firstname,
                            user.lastname            as lastname,
                            user.gender              as gender,
                            user.date_of_birth       as birthday,
                            field_of_study.fos_name  as fos_name,
                            user.created_at          as created_at
                       from user
                  left join field_of_study    on field_of_study.fos_id = user.fos_id
                      where user.Is_Active = 0
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
                        <td><?php echo htmlentities($row['student_id']);?></td>
                        <td><?php echo htmlentities($row['username'])?></td>
                        <td><?php echo htmlentities($row['email'])?></td>
                        <td><?php echo htmlentities($row['firstname'].' '.$row['lastname'])?></td>
                        <td><?php echo htmlentities($row['fos_name'])?></td>
                        <td><a href="alumni_deleted.php?pid=<?php echo htmlentities($row['id']);?>
                                &&action=restore" onclick="return confirm('คุณต้องการจะลบข้อมูลนี้หรือไม่ ?')">
                            <i class="fa fa-reply" title="Restore this Post"></i>
                            </a>&nbsp; 
                            <a href="alumni_deleted.php?pid=<?php echo htmlentities($row['id']);?>
                                &&action=presid" onclick="return confirm('คุณต้องการจะลบข้อมูลนี้หรือไม่ ?')">
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

