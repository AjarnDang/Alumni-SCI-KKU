<?php
include('header_dashboard.php');
require_once('../../template/pagination_function.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if($_GET['action']='del') {
        $postid=intval($_GET['pid']);
        $query=mysqli_query($conn,"UPDATE tblposts 
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
            <a href="#">ข่าวสาร</a> >
            <a href=" ">จัดการข่าวสาร</a> 
        </div>
        <div class="pt-2 d-flex justify-content-between">
		    <div><strong style="font-size: 40px;">จัดการข่าวสาร</strong></div>
            <div>
                <a class="btn btn-primary py-2 align-items-center" href="./news_news_add.php">เพิ่มข่าว</a>
                <a class="btn btn-danger py-2 align-items-center" href="./news_news_trash_post.php">ข่าวที่ถูกลบ</a>
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
			<th>ชื่อข่าว</th>
			<th>หมวดหมู่</th>
			<th>หมวดหมู่ย่อย</th>
            <th>วันที่โพสต์</th>
            <th>อัปเดตเมื่อ</th>
			<th>แอ็คชั่น</th>
			</tr>
        </thead>
        <tbody>
		<?php
			$num = 0;
			$sql = "SELECT tblposts.id                as postid,
						   tblposts.PostImage         as PostImage,
						   tblposts.PostTitle         as title,
						   tblposts.PostingDate       as PostDate,
                           tblposts.UpdationDate      as UpdationDate,
						   tblcategory.CategoryName   as category,
						   tblsubcategory.Subcategory as subcategory 
					  from tblposts
				 left join tblcategory    on tblcategory.id = tblposts.CategoryId
				 left join tblsubcategory on tblsubcategory.SubCategoryId = tblposts.SubCategoryId
					 where tblposts.Is_Active = 1
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

                    if($row['subcategory'] == 0 || $row['subcategory'] == NULL || $row['subcategory'] == "") {
                        $subcategory = '-';
                    } else {
                        $subcategory = $row['subcategory'];
                    }
                    
                    if($row['UpdationDate'] == NULL) {
                        $updation_date = '-';
                    } else {
                        $updation_date = date("$upnewDate")." ".$month_arr[date("$upnewMonth")]." ".(date("$upnewYear")+543);
                    }

                    if($row['status'] == 1) {
                        $status = 'Active';  } else {
                        $status = 'Inactive';
                     } 
		?>
			<tr>
                <td><?php echo ($step_num*$e_page)+$num; ?></td>
                <td><?php echo htmlentities($row['title']);?></td>
                <td><?php echo htmlentities($row['category'])?></td>
                <td><?php echo htmlentities($subcategory)?></td>
                <td><?php echo date("$newDate")." ".$month_arr[date("$newMonth")]." ".(date("$newYear")+543);?></td>
                <td><?php echo $updation_date; ?></td>
                <td><a href="news_news_edit.php?pid=<?php echo htmlentities($row['postid']);?>">
                        <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                    </a>&nbsp; 
                    <a href="news_news_manage.php?pid=<?php echo htmlentities($row['postid']);?>
                        &&action=del" onclick="return confirm('คุณต้องการจะลบข่าวนี้ใช่หรือไม่ ?')">
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