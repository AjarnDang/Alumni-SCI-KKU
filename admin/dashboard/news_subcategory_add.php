<?php
include('header_dashboard.php');
error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
    header('location:../../login-system/login_form.php');
} else {
if(isset($_POST['submitsubcat'])) {
    $categoryid=$_POST['category'];
    $subcatname=$_POST['subcategory'];
    $subcatdescription=$_POST['sucatdescription'];
    $status=1;
    $query=mysqli_query($conn,"INSERT into  tblsubcategory(
                                            CategoryId,
                                            Subcategory,
                                            SubCatDescription,
                                            Is_Active
                                            ) 
                                    values('$categoryid',
                                           '$subcatname',
                                           '$subcatdescription',
                                           '$status'
                                        )");
        if($query) {
            $msg="จัดการข้อมูลเสร็จสิ้น";
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
            <a href="#">ข่าวสาร</a> >
            <a href=" ">เพิ่มหมวดหมู่ย่อยข่าวสาร</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>เพิ่มหมวดหมู่ย่อยข่าวสาร</strong>
	    </div>
        <hr />
    
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">

                <!---Success Message--->  
                <?php if($msg) { ?>
                    <div class="alert alert-success" role="alert">
                        <strong>สำเร็จ!</strong> <?php echo htmlentities($msg);?>
                    </div>
                <?php } ?>

                <!---Error Message--->
                <?php if($error) { ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>ขออภัย</strong> <?php echo htmlentities($error);?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="row">        
            <div class="col-lg-4 col-md-4 col-sm-12">  
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" name="category" method="post">             
                        <div class="form-group">
                        <label class=" control-label">หมวดหมู่</label>                       
                            <select class="form-control" name="category" required>
                                <option value="">เลือกหมวดหมู่</option>
                                    <?php // Feching active categories
                                    $ret=mysqli_query($conn,"SELECT id,
                                                                    CategoryName
                                                            from tblcategory
                                                            where Is_Active=1
                                                            ");
                                    while($result=mysqli_fetch_array($ret)) { ?>
                                        <option value="<?php echo htmlentities($result['id']);?>">
                                            <?php echo htmlentities($result['CategoryName']);?>
                                        </option>
                                    <?php } ?>
                            </select>                       
                        </div>
                                                
                        <div class="form-group">
                            <label class=" control-label">หมวดหมู่ย่อย</label>
                            <input type="text" class="form-control" value="" name="subcategory" required>
                        </div>
                                            
                        <div class="form-group">
                            <label class=" control-label">คำอธิบาย</label>
                            <textarea class="form-control" rows="5" name="sucatdescription" required></textarea>
                        </div>

                        <div class="form-group">                            
                            <button type="submit" class="btn btn-success" name="submitsubcat">ยืนยัน</button>
                        </div>
                    </form>    
                </div>
            </div>
            </div> 
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                    <table class="table m-0 table-borderless">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>หมวดหมู่</th>
                                <th>หมวดหมู่ย่อย</th>
                                <th>คำอธิบาย</th>
                                <th>แอ็คชั่น</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php 
                        $query=mysqli_query($conn,"SELECT tblcategory.CategoryName as catname,
                                                          tblsubcategory.Subcategory as subcatname,
                                                          tblsubcategory.SubCatDescription as SubCatDescription,
                                                          tblsubcategory.PostingDate as subcatpostingdate,
                                                          tblsubcategory.UpdationDate as subcatupdationdate,
                                                          tblsubcategory.SubCategoryId as subcatid
                                                     from tblsubcategory
                                                     join tblcategory on tblsubcategory.CategoryId=tblcategory.id
                                                    where tblsubcategory.Is_Active=1
                                                    ");
                        $cnt=1;
                        $rowcount=mysqli_num_rows($query);
                        if($rowcount==0) { ?>

                            <tr><td colspan="7" class="text-center"><h3>ไม่พบข้อมูลในระบบ</h3></td></tr>

                        <?php } else { 
                            while($row=mysqli_fetch_array($query)) { ?>
                            <tr>
                                <th scope="row"><?php echo htmlentities($cnt);?></th>
                                <td><?php echo htmlentities($row['catname']);?></td>
                                <td><?php echo htmlentities($row['subcatname']);?></td>
                                <td><?php echo htmlentities($row['SubCatDescription']);?></td>
                                <td><a href="news_subcategory_edit.php?scid=<?php echo htmlentities($row['subcatid']);?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a>&nbsp;
                                    <a href="news_subcategory_manage.php?scid=<?php echo htmlentities($row['subcatid']);?>&&action=del"><i class="fa fa-trash-o" style="color: #f05050"></i></a>
                                </td>
                            </tr>
                            <?php $cnt++; } } ?>
                            
                            </tbody>                        
                        </table>                        
                    </div>
                </div>
            </div>          
        </div>
    </div>

</div>

<?php include('DashboardScript.php') ?>
</body>
<?php } ?>