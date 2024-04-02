<?php 
include('header_dashboard.php');
$id = $_GET['id'];
?>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<body>
    <div class="container-fluid">
		<div class="bread-crump pt-2">
			<a href="adminDashboard.php">แดชบอร์ด</a> >
			<a href="#">จัดการสินค้าที่ระลึก</a> >
			<a href="product_formorder.php">รายการสั่งซื้อ</a> > 
            <a href="product_order_info.php">รายละเอียดคำสั่งซื้อ</a>
		</div>
        <div class="pt-2 header-product">
            <strong>จัดการรายการสั่งซื้อสินค้าที่ระลึก</strong>
        </div>
        <hr>

        
            <?php
            $query = mysqli_query($conn, "SELECT * from orders where staytus=1 and $id = order_id");
            $cnt = 1;
            while ($row = mysqli_fetch_array($query)) { ?>
            <form method="POST" action="./form_order_precess.php" enctype="multipart/form-data">                    
        <div class="card rounded-0">
            <div class="card-header">ที่อยู่จัดส่งและชำระเงิน</div>
            <div class="card-body">                 
                    <div class="form-group">
                        <label for="username">ชื่อ-สกุล</label>
                        <input type="text" class="form-control" value="<?php echo $row['username'] ?>"  readonly>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="email">อีเมล</label>
                            <input type="email" class="form-control" value="<?php echo $row['email'] ?>" readonly>
                        </div>
                        <div class="col-6">
                            <label for="phone"> โทรศัพท์</label>
                            <input type="text" class="form-control" value="<?php echo $row['tel'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="country">ที่อยู่จัดส่ง</label>
                            <textarea class="form-control" id="addresss" name="addresss" readonly><?php echo $row['addresss'] ?></textarea>        
                        </div>
                        <div class="col-6"> 
                            <label for="code">รหัสไปรษณีย์</label>
                            <input type="text" class="form-control" value="<?php echo $row['code'] ?>" readonly>
                        </div>
                    </div>         
            </div>
        </div>
        <div class="card rounded-0 mt-4">
            <div class="card-header">รายละเอียดสินค้าและหลักฐานการชำระเงิน</div>
            <div class="card-body">
            <div class="row">
                <div class="col-6">
                <table class="table shadow-sm rounded bg-light">
                    <thead>
                    <tr class="h5">
                        <th>รายการสินค้า</th>
                        <th></th>
                        <th></th>
                    </tr>    
                    </thead>
                    <tbody>
                    <tr>
                        <td class="p-3"><b>สินค้า : </b><?php echo $row['productName'] ?></td>
                        <td class="p-3 text-center"><b>จำนวน : </b><?php echo $row['quantity'] ?> ชิ้น</td>    
                        <td class="p-3 text-right"><b>ราคาต่อหน่วย : </b><?php echo $row['price'] ?></td>
                    </tr>
                    <tr>    
                        <td></td>          
                        <td></td>    
                        <td class="p-3 h6 text-right"><b>ราคารวม : </b><?php echo $row['totalprice'] ?></td>
                    </tr>
                    </tbody>                   
                </table>
                 <ul class="text-black list-unstyled shadow-sm rounded p-3 mt-3 bg-light">
                    <li><b>สั่งซื้อเมื่อ : </b> <?php echo $row['created_at'] ?></li>
                 </ul>
                </div>
                <div class="col-6">
                    <div class="form-group row px-0">
                        <div class="col-6">
                            <div class="text-left">
                                <h4 class="mb-3">หลักฐานการชำระสินค้า</h4>
                                <img src="postimages/<?php echo $row['Picture'] ?>" width="300" height="auto" alt="" class="rounded" />
                            </div>
                        </div>
                    </div>
                </div> 
            </div>                  
            </div>
        </div>
        </form>    
        <?php } ?>    
    </div>
</body>
<?php include('DashboardScript.php') ?>