<?php
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
    
    //restore
    if($_GET['resid']) {
        $id=intval($_GET['resid']);
        $query=mysqli_query($conn,"UPDATE community_category set Is_Active='1' where id='$id'");
        $msg="กู้คืนข้อมูลเสร็จสิ้น";
    }
    
    //Forever delete
    if($_GET['action']=='parmdel' && $_GET['rid']) {
        $id=intval($_GET['rid']);
        $query=mysqli_query($conn,"DELETE from community_category where id='$id'");
        $delmsg="ลบข้อมูลเสร็จสิ้น";
    }
?>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">

<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">คอมมูนิตี้</a> >
            <a href="./community_category_ass.php">จัดการหมวดหมู่คอมมูนิตี้</a> 
        </div>
        <div class="d-flex justify-content-between">
            <div class="pt-2 header-product">
                <strong>จัดการหมวดหมู่คอมมูนิตี้</strong>
            </div>
            <div><a class="btn btn-primary py-2 align-items-center" href="community_category_add.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/></svg> 
                    ย้อนกลับ
                </a>
            </div>
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

                <h5 style="font-size: 20px;" class="mb-2 mt-4"><i class="fa fa-trash-o"></i> 
                    Deleted Categories
                </h5>

                <div class="table-responsive">
                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Posting Date</th>
                            <th>Last updation Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php 
                    $query=mysqli_query($conn,"SELECT id,
                                                    CategoryName,
                                                    Description,
                                                    PostingDate,
                                                    UpdationDate
                                                from community_category
                                            where Is_Active=0
                                            ");
                    $cnt=1;
                    $rowcount=mysqli_num_rows($query);
                    if($rowcount==0) { ?>

                        <tr><td colspan="7" class="text-center"><h3>ไม่พบข้อมูลในระบบ</h3></td><tr>

                    <?php } else { while($row=mysqli_fetch_array($query)) { ?>
                        <tr>
                            <th scope="row"><?php echo htmlentities($cnt);?></th>
                            <td><?php echo htmlentities($row['CategoryName']);?></td>
                            <td></td><?php echo htmlentities($row['Description']);?></td>
                            <td><?php echo htmlentities($row['PostingDate']);?></td>
                            <td><?php echo htmlentities($row['UpdationDate']);?></td>
                            <td><a href="community_category_manage.php?resid=<?php echo htmlentities($row['id']);?>"><i class="fa fa-reply"></i></a> &nbsp;
                                <a href="community_category_manage.php?rid=<?php echo htmlentities($row['id']);?>&&action=parmdel" title="Delete forever"><i class="fa fa-trash-o" style="color: #f05050"></i></a>
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