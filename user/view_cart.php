<?php include('../template/header_user.php');?>
<link rel="stylesheet" href="../assets/css/view_cart.css">
<div class="container">
 	<?php
    $current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	if(isset($_SESSION["cart_session"])) {
	    $total = 0;	?> 
        
        <div class="bread-crump mb-3 mt-3">
            <a href="home.php">หน้าหลัก</a> >
            <a href="store.php?emptycart=1&return_url=<?php echo $current_url ?>">สินค้าที่ระลึก</a> >
            <a href="#">ตะกร้าสินค้า</a>
        </div>

        <table class="table table-borderless py-0">
        <thead>
            <tr class="table-warning border-1">
                <th>สินค้า</th>
                <th>จำนวนสินค้า</th>
                <th>ราคาต่อชิ้น</th>
                <th>แอ็คชั่น</th>
            </tr>        
        </thead>

        <form method="post" action="ordersubmit.php" enctype="multipart/form-data">      
        <?php	  
		$cart_items = 0;
		foreach ($_SESSION["cart_session"] as $cart_itm) {
           $Product_ID  = $cart_itm["code"];
		   $results = $conn->query("SELECT * 
                                     FROM store 
                                    WHERE Product_ID='$Product_ID'
                                    "); 
		   if ($results) { //fetch results set as object and output HTML
           while($obj = $results->fetch_object()) {	  ?>
          
            <tr class="border-1">
                <td><img src="../admin/dashboard/postimages/<?php echo $obj->Picture ?>" width="150" height="auto" alt="" class="pr-3"> 
                    <?php echo $obj->productName ?>
                </td>
                <td><?php echo $cart_itm["qty"] ?></td>   
                <td><?php echo $currency.$obj->Price ?></td>                
                <td><a href="../template/cart_update.php?removep=<?php echo $cart_itm["code"] ?>
                    &return_url=<?php echo $current_url ?>">
                     ลบ</a></td>
                
                <?php
                $subtotal = ($cart_itm["price"] * $cart_itm["qty"]);
                $total = ($total + $subtotal); 
                ?>

                <input type="hidden" name="item_name[<?php echo $cart_items ?>]" value="<?php echo $obj->productName ?>" />
                <input type="hidden" name="item_code[<?php echo $cart_items ?>]" value="<?php echo $Product_ID ?>" />
                <input type="hidden" name="item_desc[<?php echo $cart_items ?>]" value="<?php echo $obj->Description ?>" />
                <input type="hidden" name="item_qty[<?php echo $cart_items ?>]" value="<?php echo $cart_itm["qty"] ?>"/>
                <?php 
                //$a = array(0, $cart_itm["qty"]);
                //echo array_sum($a); 

                //echo $cart_items+1;
                ?>
                </tr>
            
            <?php 
            $cart_items ++;
                    }
                }
            } ?> 
            </table>	

            <div class="card rounded-0">
                <div class="card-body text-right">
                    <h4 class="d-inline pr-2 align-middle text-danger">ราคารวม : <?php echo $currency.$total ?></h4>
                    <a class="btn btn-primary text-black border-0 align-middle" href="form_order.php?Product_ID=<?php echo $Product_ID ?>">
                        ชำระเงิน
                    </a>
                </div>
            </div>
		
		</form> 
        <?php }else{ ?> 
            <div class="empty-cart text-center">
                <img src="../assets/img/empty_cart.png" class="mb-2" width="400" alt="">
                <h3 class="text-center">ตะกร้าของคุณไม่มีสินค้า</h3>
                <a class="btn btn-primary border-0 text-black" href="store.php">ซื้อสินค้าที่ระลึก</a>
            </div>    		    
        <?php } ?>
        <div class="hof_rand">
      <h4>สินค้าที่คุณอาจสนใจ</h4>  
      <div class="row">
        <?php
        $sql = "SELECT * FROM store ORDER BY RAND() LIMIT 8";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
        ?>

        <div class="col-lg-3 col-sm-6 col-xs-6 pt-4">
            <div class="ymal">
                <a href="product.php?id=<?php echo $row['Product_ID']; ?>">
                    <img src="../admin/dashboard/postimages/<?php echo $row['Picture']; ?>" alt="">
                </a>
                <a href="product.php?id=<?php echo $row['Product_ID']; ?>">
                    <div class="alumni-name text-center mt-3">
                        <h5 class="text-left"><?php echo $row['productName']; ?></h5>
                    </div>
                </a>
            </div>
        </div> 

        <?php } ?> 
      </div>   
    </div>
</div>

<?php include('../template/footer_users.php'); ?>