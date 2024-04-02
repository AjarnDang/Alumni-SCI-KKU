<?php
include('header_dashboard.php');
require_once('../../template/pagination_function.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if($_GET['action']='del') {
        $postid=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE community_topic 
                                      set Is_Active=0
                                    where id='$postid'
                                   ");
        if($query) {
            $msg="ลบข้อมูลเสร็จสิ้น";
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
            <a href="#">คอมมูนิตี้</a> >
            <a href=" ">จัดการคอมมูนิตี้</a> 
        </div>
        <div class="pt-2 d-flex justify-content-between">
		    <div><strong style="font-size: 40px;">จัดการคอมมูนิตี้</strong></div>
            <div>
                <a class="btn btn-primary py-2 align-items-center" href="./community_topic_add.php">เพิ่มหัวข้อ</a>
                <a class="btn btn-danger py-2 align-items-center" href="./community_topic_deleted.php">หัวข้อที่ถูกลบ</a>
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
			<th>โพสต์</th>
			<th>หมวดหมู่</th>
            <th>วันที่สร้าง</th>
            <th>อัปเดตเมื่อ</th>
            <th>ผู้โพสต์</th>
			<th>แอ็คชั่น</th>
			</tr>
        </thead>
        <tbody>
		<?php
			$num = 0;
			$sql = "SELECT community_topic.id                as postid,
						   community_topic.PostImage         as PostImage,
						   community_topic.PostTitle         as title,
						   community_topic.PostingDate       as PostDate,
                           community_topic.UpdationDate      as UpdationDate,
						   community_category.CategoryName   as category,
                           user.username				   
					  from community_topic
				 left join community_category on community_category.id = community_topic.CategoryId
                inner join user on user.id = community_topic.user_id
					 where community_topic.Is_Active = 1
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
			$sql.="ORDER BY PostDate DESC LIMIT ".$s_page.",$e_page";
			$result=$conn->query($sql);
			if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
				while($row = $result->fetch_assoc()) { // วนลูปแสดงรายการ
					$num++;
                    $Date = $row['PostDate'];  
                    $newdateFormat = date('d M Y', strtotime($Date));
                    $newDate = date("d", strtotime($Date));  
                    $newMonth = date("n", strtotime($Date));
                    $newYear = date("Y", strtotime($Date)); 

                    $upDate = $row['UpdationDate'];  
                    $upnewdateFormat = date('d M Y', strtotime($upDate));
                    $upnewDate = date("d", strtotime($upDate));  
                    $upnewMonth = date("n", strtotime($upDate));
                    $upnewYear = date("Y", strtotime($upDate)); 

                    if($row['UpdationDate'] == NULL) {
                         $updation_date = '-';
                     } else {
                         $updation_date = date("$upnewDate")." ".$month_arr[date("$upnewMonth")]." ".(date("$upnewYear")+543);
                     }                      
		    ?>
			<tr>
                <td><?php echo ($step_num*$e_page)+$num; ?></td>
                <td><?php echo htmlentities($row['title']);?></td>
                <td><?php echo htmlentities($row['category'])?></td>
                <td><?php echo date("$newDate")." ".$month_arr[date("$newMonth")]." ".(date("$newYear")+543);?></td>
                <td><?php echo $updation_date; ?></td>
                <td><?php echo htmlentities($row['username'])?></td>
                <td><a href="community_topic_edit.php?pid=<?php echo htmlentities($row['postid']);?>">
                        <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                    </a>&nbsp; 
                    <a href="community_topic_manage.php?pid=<?php echo htmlentities($row['postid']);?>&&action=del"
                        onclick="return confirm('คุณต้องการจะลบหัวข้อนี้หรือไม่ ?')">
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