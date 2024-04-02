<?php 
require('../template/header_user.php'); 
?>
<style>
    .card-header {
        background-color: #ffeeba !important;
    }
</style>
<body>
    <div class="container">
        <div class="bread-crump mb-3 mt-3">
            <a href="home.php">หน้าหลัก</a> >
            <a href="store.php?emptycart=1&return_url=<?php echo $current_url ?>">สินค้าที่ระลึก</a> >
            <a href="view_cart.php">ตะกร้าสินค้า</a> >
            <a href="#">ทำการสั่งซื้อ</a>
        </div>
            <table class="table table-borderless py-0 mb-4">
                <thead>
                    <tr class="table-warning border-1">
                        <th>สินค้า</th>
                        <th>จำนวนสินค้า</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>ราคารวม</th>
                    </tr>        
                </thead>
                        <?php //current URL of the Page. cart_update.php redirects back to this URL
                        $current_url = base64_encode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                        if (isset($_SESSION["cart_session"])) {
                            $total = 0;       
                                           
                            foreach ($_SESSION["cart_session"] as $cart_itm) { ?>
                            <tr class="border-1">
                                <td><?php echo $cart_itm["name"] ?></td>
                                <td><?php echo $cart_itm["qty"] ?></td>   
                                <td>฿<?php echo $cart_itm["price"] ?></td> 
                              
                                <?php 
                                $subtotal = ($cart_itm["price"] * $cart_itm["qty"]);
                                $total = ($total + $subtotal); 
                                ?>

                                <td><?php echo $currency . $total ?></td>
                            </tr>
                            <?php } ?>
                        
                        <?php } else { ?>
                         <h4>(ไม่มีสินค้าในตะกร้า)</h4>
                       <?php } ?>
                </table>

        <form method="POST" action="./form_order_precess.php" enctype="multipart/form-data">                    
        <div class="card rounded-0">
            <div class="card-header">กรอกที่อยู่จัดส่งและชำระเงิน</div>
            <div class="card-body">                 
                    <div class="form-group">
                        <label for="username">ชื่อ-สกุล</label>
                        <input type="text" class="form-control" id="nameuser" required placeholder="สมชาย ใจดี" name="nameuser">
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="email">อีเมล</label>
                            <input type="email" class="form-control" id="email" required placeholder="example@gmail.com" name="email">
                        </div>
                        <div class="col-6">
                            <label for="phone"> โทรศัพท์:</label>
                            <input type="text" class="form-control" id="tel" required placeholder="089XXXXXXX" name="tel" min="10" max="10" pattern="[0-9]+">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="country">ที่อยู่จัดส่ง</label>
                            <textarea class="form-control" id="addresss" required name="addresss"></textarea>        
                        </div>
                        <div class="col-6"> 
                            <label for="code">รหัสไปรษณีย์</label>
                            <input type="text" class="form-control" id="code" required name="code" min="5" max="5" pattern="[0-9]+">
                        </div>
                    </div>         
            </div>
        </div>
        <div class="card rounded-0 mt-4">
            <div class="card-header">เลือกวิธีการชำระเงิน</div>
            <div class="card-body">
                        <?php
                        $current_url = base64_encode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                        if (isset($_SESSION["cart_session"])) {
                            $total = 0;
                            $cart_items = 0;
                            foreach ($_SESSION["cart_session"] as $cart_itm) {
                                $Product_ID  = $cart_itm["code"];
                                $results = $conn->query("SELECT productName,Description, Price FROM store  WHERE Product_ID='$Product_ID'"); 
                                if ($results) {        
                                while($obj = $results->fetch_object()) {
                                    echo '
                                    <input type="hidden"  value='.$obj->productName.' name="productName">
                                    <input type="hidden"  value='.$cart_itm["qty"].' name="quantity">
                                    <input type="hidden"  value='.$cart_itm["price"].' name="price">
                                    ';
                                    $cart_items ++;
                                    }
                                }
                            }							
						}
                          ?>
                    <div class="form-group row px-0">
                        <div class="col-6">
                            <div class="text-center">
                                <img src="https://www.moonshineresort.com/bank/files/card_image_topper_705.png" width="200" height="220" alt="" />
                            </div>
                            <label class="mt-3">แนปสลิป</label>
                            <input type="file" class="form-control" name="Picture">
                        </div>
                    </div>
                <div class="mt-4 text-right">
                <?php
                $current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); 
                if(isset($_SESSION["cart_session"])) {
                    $total = 0;
                    foreach ($_SESSION["cart_session"] as $cart_itm) {
                        $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
                        $total = ($total + $subtotal) ; 	
                    } ?>
                    <span class="text-bold">ราคารวม:<?php echo $currency.$total ?></span> 
                   <?php
                    echo '<input type="hidden"  value='.$total.' name="totalprice">';
                
                } ?>
                    <input type="submit" class="btn btn-primary border-0 text-black" name="save" value="ยืนยันการสั่งซื้อ" />
                </div>
            </div>
        </div>
        </form>
    </div>
            <?php require('../template/footer_users.php'); ?>
</body>

</html>