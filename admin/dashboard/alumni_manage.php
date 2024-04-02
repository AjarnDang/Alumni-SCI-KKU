<?php
include('header_dashboard.php');
require_once('../../template/pagination_function.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if($_GET['action']='del') {
        $id=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE user 
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
            <a href="#">ศิษย์เก่า</a> >
            <a href="#">จัดการศิษย์เก่า</a> 
        </div>
        <div class="pt-2 d-flex justify-content-between">
		    <div><strong style="font-size: 40px;">จัดการศิษย์เก่า</strong></div>
            <div class="d-flex justify-content-center align-items-center">
                <a class="btn btn-primary py-2 mx-1 align-items-center" href="alumni_add.php">เพิ่มศิษย์เก่า</a>
                <a class="btn btn-danger py-2 mx-1 align-items-center" href="alumni_deleted.php">ศิษย์เก่าที่ถูกระงับการใช้งาน</a>
            </div>
	    </div>
    <!--
        <form action="" name="form1" method="get">   
            <div class="form row">
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="keyword" id="keyword" 
                    value="<?=(isset($_GET['keyword']))?$_GET['keyword']:""?>" 
                    placeholder="ค้นหา">
                </div>
                <div class="col-lg-3">
                    <select class="mr-2 form-select form-control" name="field_of_study">
                        <option value="">เลือกสาขา</option>
                        <?php // Feching active Field Of Study
                            $fos=mysqli_query($conn,"SELECT fos_id,
                                                            fos_name
                                                    from field_of_study
                                                    where Is_Active=1
                                                    ");
                            while($result=mysqli_fetch_array($fos)) { ?>
                        <option value="<?php echo htmlentities($result['fos_id']);?>">
                            <?php echo htmlentities($result['fos_name']);?>
                        </option>
                        <?php } ?>
                    </select>    
                </div>
                <div class="col-lg-3">
                    <select class="form-select form-control" name="year">
                        <option value="" selected>ปีการศึกษาที่เข้ารับการศึกษา</option>
                        <?php
                            $firstYear = ((int)date('Y') + 543) - 58;
                            $currentYear = $firstYear + 59;
                            for ($i = $firstYear; $i <= $currentYear; $i++) {
                                echo '<option value=' . $i . '>' . $i . '</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row mt-2">
                <div class="col">
                <button type="submit" class="btn btn-primary" name="btn_search" id="btn_search">ค้นหา</button>
                <a href="alumni_manage.php" class="btn btn-danger">ล้างค่า</a>
                </div>            
            </div>                
        </form>        
    -->

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
            <th>ปีที่เข้า/สำเร็จการศึกษา</th>
            <th>แอ็คชัน</th>
			</tr>
        </thead>
        <tbody>
		<?php
			$num = 0;
			$sql = "SELECT  user.id                   as id,
                            user.student_id           as student_id,
                            user.username             as username,
                            user.email                as email,
                            user.firstname            as firstname,
                            user.lastname             as lastname,
                            user.gender               as gender,
                            user.date_of_birth        as birthday,
                            user.start_year           as start_year,
                            user.end_year             as end_year,
                            field_of_study.fos_name   as fos_name,                 
                            user.created_at           as created_at
                       from user
                  left join field_of_study    on field_of_study.fos_id = user.fos_id
                      where user.Is_Active = 1
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
                        <td><?php echo $row['start_year']." - ".$row['end_year'];?></td>
                        <td><a href="alumni_history.php?pid=<?php echo htmlentities($row['student_id']);?>">
                                <i class="fa fa-history" style="color: #000000"></i>
                            </a>&nbsp; 
                            <a href="alumni_edit.php?pid=<?php echo htmlentities($row['id']);?>">
                                <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                            </a>&nbsp; 
                            <a href="alumni_manage.php?pid=<?php echo htmlentities($row['id']);?>
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

