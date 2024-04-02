<?php  
  include('header_dashboard.php'); 
  error_reporting(0);
if(strlen($_SESSION['username'])=='admin') { 
 header('location:../../login-system/login_form.php');
} else {
    if($_GET['action']=='del' && $_GET['rid']) {
        $id=intval($_GET['rid']);
        $query=mysqli_query($conn,"UPDATE store set Is_Active='0' where Product_ID='$id'");
        $msg="ลบข้อมูลเสร็จสิ้น";
    }
    //restore
    if($_GET['resid']) {
        $id=intval($_GET['resid']);
        $query=mysqli_query($conn,"UPDATE store set Is_Active='1' where Product_ID='$id'");
        $msg="กู้คืนข้อมูลเสร็จสิ้น";
    }
    
    //Forever delete
    if($_GET['action']=='parmdel' && $_GET['rid']) {
        $id=intval($_GET['rid']);
        $query=mysqli_query($conn,"DELETE from store where Product_ID='$id'");
        $delmsg="ลบข้อมูลเสร็จสิ้น";
    }
?>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<body>
	<div class="container-fluid">
		<div class="bread-crump pt-2">
			<a href="adminDashboard.php">แดชบอร์ด</a> >
			<a href="#">จัดการสินค้าที่ระลึก</a> >
			<a href="product_dashboard.php">เพิ่ม/ลบ/แก้ใข</a> 
		</div>
	<div class="pt-2 header-product">
		<strong>จัดการเพิ่ม/ลบ/แก้ใข สินค้าที่ระลึก</strong>
	</div>	
	
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

	<div class="product-summary">
		<div class="col-lg-4 col-sm-6">
			<div class="row">
				
			</div>
		</div>
	</div>

	<span class="pull-left pb-3">
    <a href="#addnew" data-toggle="modal" class="btn btn-primary">
		<span class="glyphicon glyphicon-plus"></span>
		เพิ่มข้อมูล
	</a>
	</span>

    <table class="table table-colored-bordered table-bordered-primary mt-2">
		<thead>
		<th>#</th>
      	<th>รูปภาพ</th>
		<th>ชื่อสินค้า</th>
		<th>ประเภทสินค้า</th>
		<th>ราคา (บาท/หน่วย)</th>
        <th>รายละเอียดสินค้า</th>
        <th>แก้ไข</th>
		</thead>
		<tbody>
			<?php
				$count = 1;
				$con = mysqli_connect('localhost', 'root', '', 'alumni_sci');

				$perpage = 8;
				if (isset($_GET['page'])) {
				$page = $_GET['page'];
				} else {
					$page = 1;
				}
				
				$start = ($page - 1) * $perpage;
				
				$sql = "SELECT * from store WHERE Is_Active = 1 ORDER BY created_at DESC limit {$start} , {$perpage} ";
				$query = mysqli_query($con, $sql);
				while ($row = mysqli_fetch_assoc($query)) {
			?>
			<tr>
				<td><?php echo $count++; ?></td>
            	<td><img width="100" src="postimages/<?php echo $row['Picture']; ?>" alt="" class="rounded"></td>
				<td><?php echo $row['productName']; ?></td>
				<td><?php echo $row['product_type']; ?></td>
				<td><?php echo $row['Price']; ?></td>
            	<td style="width:20em;"><p class="detail"><?php echo $row['Description']; ?></p></td>
				<td>
					<a href="#edit<?php echo $row['Product_ID']; ?>" data-toggle="modal" class="button btn btn-warning">
						<span class="glyphicon glyphicon-edit"></span>
						แก้ใข
					</a> 
					<span class="mb-2"></span>
					<a href="product_dashboard.php?rid=<?php echo htmlentities($row['Product_ID']);?>&&action=del" class="btn btn-danger">
						<span class="glyphicon glyphicon-trash"></span>
						ลบ
					</a>
					<?php include('product_edit_form.php'); ?>
					<?php include('product_delete_form.php'); ?>
				</td>
          	</tr>
			<?php } ?>
		</tbody>
	</table>

	<div class="row mt-4">
        <div class="col-md-12">
                <h5 style="font-size: 20px;" class="mb-2"><i class="fa fa-trash-o"></i> 
                    ประวัติการลบ
                </h5>

                <div class="table-responsive">
                    <table class="table m-0 table-colored-bordered table-bordered-danger">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>สินค้า</th>
                            <th>ชื่อสินค้า</th>                              
                            <th>ราคา</th>
                            <th>รายระเอียดสินค้า</th>
                            <th>แอ็คชัน</th>
                            </tr>
                        </thead>

                        <tbody>
                    <?php 
                    $query=mysqli_query($conn,"SELECT *
                                                from store
                                            where Is_Active=0
                                            ");
                    $cnt=1;
                    while($row=mysqli_fetch_array($query)) { ?>

                        <tr>
                            <th scope="row"><?php echo $cnt++;?></th>
                            <td><img width="100" src="postimages/<?php echo $row['Picture']; ?>" alt=""></td>
                            <td><?php echo $row['productName'];?></td>
                            <td><?php echo $row['Price'];?></td>
                            <td><?php echo $row['Description'];?></td>
                            <td>
                                <a href="product_dashboard.php?resid=<?php echo htmlentities($row['Product_ID']);?>">
                                    <svg width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M480 256c0 123.4-100.5 223.9-223.9 223.9c-48.86 0-95.19-15.58-134.2-44.86c-14.14-10.59-17-30.66-6.391-44.81c10.61-14.09 30.69-16.97 44.8-6.375c27.84 20.91 61 31.94 95.89 31.94C344.3 415.8 416 344.1 416 256s-71.67-159.8-159.8-159.8C205.9 96.22 158.6 120.3 128.6 160H192c17.67 0 32 14.31 32 32S209.7 224 192 224H48c-17.67 0-32-14.31-32-32V48c0-17.69 14.33-32 32-32s32 14.31 32 32v70.23C122.1 64.58 186.1 32.11 256.1 32.11C379.5 32.11 480 132.6 480 256z"/></svg>
                                </a> &nbsp;
                                <a href="product_dashboard.php?rid=<?php echo htmlentities($row['Product_ID']);?>&&action=parmdel" title="Delete forever">
                                    <i class="fa fa-trash-o" style="color: #f05050"></i>
                                </a>
                            </td>
                        </tr>

                    <?php $cnt++; } ?>
                
                    </tbody>
                </table>
            </div>
		</div>					
	</div><!--- end row -->

    <?php
        $sql2 = "SELECT * from store";
        $query2 = mysqli_query($con, $sql2);
        $total_record = mysqli_num_rows($query2);
        $total_page = ceil($total_record / $perpage);
        ?>
		
        <div class="pagination-nav pt-3">
        <nav>
            <ul class="pagination">
                <li>
                    <a href="product_dashboard.php?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
				<?php for($i=1;$i<=$total_page;$i++){ ?>
				<li>
					<a href="product_dashboard.php?page=<?php echo $i; ?>">
						<?php echo $i; ?></a></li>
				<?php } ?>
				<li>
					<a href="product_dashboard.php?page=<?php echo $total_page;?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
				</li>
            </ul>
        </nav>
		</div>
    <?php include('product_add_form.php'); ?>
    <?php include('DashboardScript.php') ?>

</body>
</html>
<?php } ?>