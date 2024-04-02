<?php
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    if($_GET['action']=='del' && $_GET['scid']) {
        $id=intval($_GET['scid']);
        $query=mysqli_query($conn,"UPDATE event_subcategory set Is_Active='0' where SubCategoryId='$id'");
        $msg="ลบข้อมูลเสร็จสิ้น";
    }
    // restore
    if($_GET['resid']) {
        $id=intval($_GET['resid']);
        $query=mysqli_query($conn,"UPDATE event_subcategory set Is_Active='1' where SubCategoryId='$id'");
        $msg="กู้คืนข้อมูลเสร็จสิ้น";
    }
    
    // Forever deletionparmdel
    if($_GET['action']=='perdel' && $_GET['scid']) {
        $id=intval($_GET['scid']);
        $query=mysqli_query($conn,"DELETE from event_subcategory where SubCategoryId='$id'");
        $delmsg="ลบข้อมูลเสร็จสิ้น";
    }
?>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">

<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">กิจกรรม</a> >
            <a href="./activity_add-category.php">จัดการหมวดหมู่ย่อยกิจกรรม</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>จัดการหมวดหมู่ย่อยกิจกรรม</strong>
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

            <?php if($delmsg){ ?>
                <div class="alert alert-danger" role="alert">
                    <strong>ขออภัย</strong> <?php echo htmlentities($delmsg);?>
                </div>
            <?php } ?>

            </div>
        </div>

        <div class="row">
			<div class="col-md-12">
				<div class="demo-box m-t-20">
                    <div class="m-b-30">
                        <a href="activity_subcategory_add.php">
                            <button id="addToTable" class="btn btn-success waves-effect waves-light mb-3">
                                เพิ่มหมวดหมู่ย่อย <i class="mdi mdi-plus-circle-outline"></i>
                            </button>
                        </a>
                    </div>

                    <!--Current Subcategory-->
					<div class="table-responsive">
                        <table class="table m-0 table-colored-bordered table-bordered-primary">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>หมวดหมู่</th>
                                <th>หมวดหมู่ย่อย</th>
                                <th>คำอธิบาย</th>
                                <th>วันที่สร้าง</th>
                                <th>อัปเดตเมื่อ</th>
                                <th>แอ็คชั่น</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php 
                        $query=mysqli_query($conn,"SELECT events_category.CategoryName as catname,
                                                          event_subcategory.Subcategory as subcatname,
                                                          event_subcategory.SubDescription as SubDescription,
                                                          event_subcategory.PostingDate as PostingDate,
                                                          event_subcategory.UpdationDate as UpdationDate,
                                                          event_subcategory.SubCategoryId as subcatid
                                                     from event_subcategory
                                                     join events_category on event_subcategory.CategoryId = events_category.id
                                                    where event_subcategory.Is_Active = 1
                                                    ");
                        $cnt=1;
                        $rowcount=mysqli_num_rows($query);
                        if($rowcount==0) { ?>

                            <tr><td colspan="7" class="text-center"><h3>ไม่พบข้อมูลในระบบ</h3></td></tr>

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
                                <td><?php echo htmlentities($row['catname']);?></td>
                                <td><?php echo htmlentities($row['subcatname']);?></td>
                                <td><?php echo htmlentities($row['SubDescription']);?></td>
                                <td><?php echo date("$newDate")." ".$month_arr[date("$newMonth")]." ".(date("$newYear")+543);?></td>
                                <td><?php echo $updation_date; ?></td>
                                <td>
                                <td><a href="activity_subcategory_edit.php?scid=<?php echo htmlentities($row['subcatid']);?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a>&nbsp;
                                    <a href="activity_subcategory_manage.php?scid=<?php echo htmlentities($row['subcatid']);?>&&action=del"><i class="fa fa-trash-o" style="color: #f05050"></i></a>
                                </td>
                            </tr>
                            <?php $cnt++; } } ?>
                            
                            </tbody>                        
                        </table>
                    </div>                                     
                </div>
            </div>
        </div>        

        <!--Current Delete Subcategory-->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="demo-box m-t-20">
                    <h5 tyle="font-size: 20px;" class="mb-2">
                        <i class="fa fa-trash-o"></i> 
                        หมวดหมู่ย่อยที่ถูกลบ
                    </h5>
                    <div class="table-responsive">
                        <table class="table m-0 table-colored-bordered table-bordered-danger">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>หมวดหมู่</th>
                            <th>หมวดหมู่ย่อย</th>
                            <th>คำอธิบาย</th>
                            <th>วันที่สร้าง</th>
                            <th>อัปเดตเมื่อ</th>
                            <th>แอ็คชั่น</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php 
                    $query=mysqli_query($conn,"SELECT events_category.CategoryName as catname,
                                                      event_subcategory.Subcategory as subcatname,
                                                      event_subcategory.SubDescription as SubDescription,
                                                      event_subcategory.PostingDate as PostingDate,
                                                      event_subcategory.UpdationDate as UpdationDate,
                                                      event_subcategory.SubCategoryId as subcatid
                                                 from event_subcategory
                                                 join events_category on event_subcategory.CategoryId=events_category.id
                                                where event_subcategory.Is_Active=0
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
                            <td><?php echo htmlentities($row['catname']);?></td>
                            <td><?php echo htmlentities($row['subcatname']);?></td>
                            <td><?php echo htmlentities($row['SubDescription']);?></td>
                            <td><?php echo date("$newDate")." ".$month_arr[date("$newMonth")]." ".(date("$newYear")+543);?></td>
                            <td><?php echo $updation_date; ?></td>
                            <td><a href="activity_subcategory_manage.php?resid=<?php echo htmlentities($row['subcatid']);?>"><i class="fa fa-reply" title="Restore this SubCategory"></i></a> &nbsp;
                                <a href="activity_subcategory_manage.php?scid=<?php echo htmlentities($row['subcatid']);?>&&action=perdel"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> </td>
                        </tr>

                    <?php $cnt++; } } ?>

                        </tbody>                           
                    </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include('DashboardScript.php'); ?>
</body>
<?php } ?>