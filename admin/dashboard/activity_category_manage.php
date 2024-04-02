<?php
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if($_GET['action']=='del' && $_GET['rid']) {
        $id=intval($_GET['rid']);
        $query=mysqli_query($conn,"UPDATE events_category set Is_Active='0' where id='$id'");
        $msg="ลบข้อมูลเสร็จสิ้น";
    }
    //restore
    if($_GET['resid']) {
        $id=intval($_GET['resid']);
        $query=mysqli_query($conn,"UPDATE events_category set Is_Active='1' where id='$id'");
        $msg="กู้คืนข้อมูลเสร็จสิ้น";
    }
    
    //Forever delete
    if($_GET['action']=='parmdel' && $_GET['rid']) {
        $id=intval($_GET['rid']);
        $query=mysqli_query($conn,"DELETE from events_category where id='$id'");
        $delmsg="ลบข้อมูลเสร็จสิ้น";
    }
?>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">

<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">กิจกรรม</a> >
            <a href=" ">จัดการหมวดหมู่กิจกรรม</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>จัดการหมวดหมู่กิจกรรม</strong>
	    </div>
        <hr/> 

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">  

            <!---Success Message--->  
            <?php if($msg) { ?>
                <div class="alert alert-success" role="alert">
                    <strong>สำเร็จ!</strong> <?php echo htmlentities($msg);?>
                </div>
            <?php } ?>

            <!---Error Message--->
            <?php if($delmsg) { ?>
                <div class="alert alert-danger" role="alert">
                    <strong>ขออภัย</strong> <?php echo htmlentities($delmsg);?>
                </div>
            <?php } ?>

            </div>
        </div>

        <div class="row">
			<div class="col-md-12">
                    <div class="pb-3">
                        <a href="./activity_category_add.php">
                            <button id="addToTable" class="btn btn-success waves-effect waves-light">
                                เพิ่มหมวดหมู่ <i class="mdi mdi-plus-circle-outline" ></i>
                            </button>
                        </a>
                    </div>

					<div class="table-responsive">
                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>หมวดหมู่</th>
                            <th>คำอธิบาย</th>
                            <th>วันที่สร้าง</th>
                            <th>อัปเดตเมื่อ</th>
                            <th>แอ็คชั่น</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $query=mysqli_query($conn,"SELECT id,
                                                        CategoryName,
                                                        Description,
                                                        PostingDate,
                                                        UpdationDate
                                                    from events_category
                                                    where Is_Active=1
                                                ");
                        $cnt=1;
                        while($row=mysqli_fetch_array($query)) { 
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
                            <th scope="row"><?php echo htmlentities($cnt);?></th>
                            <td><?php echo htmlentities($row['CategoryName']);?></td>
                            <td><?php echo htmlentities($row['Description']);?></td>
                            <td><?php echo date("$newDate")." ".$month_arr[date("$newMonth")]." ".(date("$newYear")+543);?></td>
                            <td><?php echo $updation_date; ?></td>
                            <td><a href="activity_category_edit.php?cid=<?php echo htmlentities($row['id']);?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a> &nbsp;
                                <a href="activity_category_manage.php?rid=<?php echo htmlentities($row['id']);?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a>
                            </td>
                        </tr>

                        <?php $cnt++; } ?>

                        </tbody>                                  
                    </table>
                </div>
            
        </div>
    </div><!--- end row -->

    <div class="row mt-4">
        <div class="col-md-12">

                <h5 style="font-size: 20px;" class="mb-2 mt-4"><i class="fa fa-trash-o"></i> 
                    หมวดหมู่ที่ถูกลบ
                </h5>

                <div class="table-responsive">
                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>หมวดหมู่</th>
                            <th>คำอธิบาย</th>
                            <th>วันที่สร้าง</th>
                            <th>อัปเดตเมื่อ</th>
                            <th>แอ็คชั่น</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php 
                    $query=mysqli_query($conn,"SELECT id,
                                                    CategoryName,
                                                    Description,
                                                    PostingDate,
                                                    UpdationDate
                                                from events_category
                                            where Is_Active=0
                                            ");
                    $cnt=1;
                    $rowcount=mysqli_num_rows($query);
                    if($rowcount==0) { ?>

                        <tr><td colspan="7" class="text-center"><h3>ขณะนี้ยังไม่มีหมวดหมู่ที่ถูกลบ</h3></td><tr>

                    <?php } else { 
                        while($row=mysqli_fetch_array($query)) {
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
                            <th scope="row"><?php echo htmlentities($cnt);?></th>
                            <td><?php echo htmlentities($row['CategoryName']);?></td>
                            <td><?php echo htmlentities($row['Description']);?></td>
                            <td><?php echo date("$newDate")." ".$month_arr[date("$newMonth")]." ".(date("$newYear")+543);?></td>
                            <td><?php echo $updation_date; ?></td>
                            <td><a href="activity_category_manage.php?resid=<?php echo htmlentities($row['id']);?>"><i class="fa fa-reply"></i></a> &nbsp;
                                <a href="activity_category_manage.php?rid=<?php echo htmlentities($row['id']);?>&&action=parmdel" title="Delete forever"><i class="fa fa-trash-o" style="color: #f05050"></i></a>
                            </td>
                        </tr>

                    <?php $cnt++; } } ?>
                
                    </tbody>
                </table>
            </div>
		</div>					
	</div><!--- end row -->

    <?php include('./DashboardScript.php'); ?>
</body>

<?php } ?>