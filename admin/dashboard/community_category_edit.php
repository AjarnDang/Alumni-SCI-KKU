<?php
include('header_dashboard.php');
include('../../template/pagination_function.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if(isset($_POST['submit'])) {
        $catid=intval($_GET['cid']);
        $category=$_POST['category'];
        $description=$_POST['description'];
        $query=mysqli_query($conn,"UPDATE community_category
                                      set CategoryName='$category',
                                          Description='$description',
                                          UpdationDate=now()
                                    where id='$catid'
                                    ");
        if($query) {
            $msg="อัปเดตข้อมูลสำเร็จ";
        } else {
            $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
        } 
    }    
?>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">

<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">คอมมูนิตี้</a> >
            <a href=" ">แก้ใขหมวดหมู่คอมมูนิตี้</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>แก้ใขหมวดหมู่คอมมูนิตี้</strong>
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

        <div class="row">        
        <?php 
        $catid=intval($_GET['cid']);
        $query=mysqli_query($conn,"SELECT id,
                                         CategoryName,
                                         Description,
                                         PostingDate,
                                         UpdationDate 
                                    from community_category
                                   where Is_Active=1
                                     and id='$catid'
                                     ");
        $cnt=1;
        while($row=mysqli_fetch_array($query)) { ?>        	
                <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                    <form class="form-horizontal" name="category" method="post">
	                    <div class="form-group">
	                        <label class=" control-label">หมวดหมู่</label>
	                        <input type="text" class="form-control" value="<?php echo htmlentities($row['CategoryName']);?>" name="category" required>
	                    </div>
	                                     
	                    <div class="form-group">
	                        <label class=" control-label">คำอธิบาย</label>
                                <textarea class="form-control" rows="5" name="description" required>
                                    <?php echo htmlentities($row['Description']);?>
                                </textarea>
	                    </div>

                    <?php } ?>

                    <div class="form-group">
                    <button type="submit" class="btn btn-success" name="submit">อัปเดต</button>
                    </div>
	                </form>
                    </div>
                </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between">
                            <div><h3>รายการหมวดหมู่</h3></div>
                            <div><a href="./community_category_manage.php" class="btn btn-danger">หมวดหมู่ที่ถูกลบ</a></div>
                        </div>    
                    </div>
                    <div class="card-body">
                    <table class="table m-0 table-borderless p-0">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>หมวดหมู่</th>
                            <th>คำอธิบาย</th>
                            <th>วันที่สร้าง</th>
                            <th>อัปเดตเมื่อ</th>
                            <th>แอ็คชัน</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php                      
                        $num = 0;
                        $sql = "SELECT  id,
                                        CategoryName,
                                        Description,
                                        PostingDate,
                                        UpdationDate
                                   from community_category
                                  where Is_Active=1
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
                        $sql.="ORDER BY PostingDate DESC LIMIT ".$s_page.",$e_page";
                        $result=$conn->query($sql);
                        if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
                            while($row = $result->fetch_assoc()) {
                                $num++;
                                $Date = $row['PostingDate'];  
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
                            <th scope="row"><?php echo htmlentities($num);?></th>
                            <td><?php echo htmlentities($row['CategoryName']);?></td>
                            <td style="width: 250px;"><p class="des text-black"><?php echo htmlentities($row['Description']);?></p></td>
                            <td><?php echo date("$newDate")." ".$month_arr[date("$newMonth")]." ".(date("$newYear")+543);?></td>
                            <td><?php echo $updation_date; ?></td>
                            <td><a href="community_category_edit.php?cid=<?php echo htmlentities($row['id']);?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a> &nbsp;
                                <a href="community_category_add.php?rid=<?php echo htmlentities($row['id']);?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a>
                            </td>
                        </tr>

        <?php } }  ?>

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