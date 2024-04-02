<?php
session_start();
include('condb.php');
include('./header_dashboard.php')
?>

<style>
td {width: 5em;}
</style>


    
<?php
    $sql = "SELECT * FROM order JOIN store ON order.product_id = store.product_id";
    $result = mysqli_query($con, $sql);
?>
<div class="container-fluid">
<div class="well">

<span style="font-size:25px; color:blue"><center><strong>รายการสั่งซื้อ</strong></center></span>	
    <table class="table table-striped table-bordered table-hover">
    <thead>
        <th>ชื่อ</th>
        <th>เบอร์โทร</th>
        <th>Email</th>
        <th>ที่อยู่</th>
        <th>สินค้าที่สั่ง</th>
        <th>สลิป</th>
    </thead>
    <tbody>	
        <?php while($row=mysqli_fetch_array($result3)) { ?>
        <tr style="width: auto;">
            <td style="width:5em;"><?php echo $row['nameuser'] ?></td>
            <td><?php echo $row['tel'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['addresss'] ?></td>
            <td><?php echo $row['book_status'] ?></td>                   
            <td style="width: 17.5em;"><img style="width: 17.5em;height: 180px;object-fit: cover;" 
                src="<?php echo $row['product_img']; ?>" alt="">
            </td>
            <td style="width: 17.5em;"><img style="width: 17.5em;height: 180px;object-fit: cover;" 
                src="<?php echo $row['product_img']; ?>" alt="">
            </td>
            <td>
                <a href="#edit<?php echo $row['product_id']; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                <a href="#confirm<?php echo $row['product_id'] ?>" data-toggle="modal" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Book Confirm</a>
                <?php include('manage.php'); ?>				
			</td>
		</tr>
        <?php } ?>
    </div> 
	</div>



	