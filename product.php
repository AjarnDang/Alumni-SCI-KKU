<?php require('template/header.php');?>
<link rel="stylesheet" href="assets/css/product.css">
<link rel="stylesheet" href="assets/css/css-carousel-12/owl.carousel.min.css">
<link rel="stylesheet" href="assets/css/css-carousel-12/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/css-carousel-12/style.css">
<body>
<?php 
    $product_id = $_GET['id'];
    $results = $conn->query("SELECT * FROM store 
                                     WHERE Is_Active=1 
                                       AND Product_ID = '$product_id'
                                       ");
            if ($results) {
                while ($obj = $results->fetch_object()) { 
                  ?>   
  <div class="container">        
  <div class="single-product mt-4">    

    <form method="post" action="template/cart_update.php"> 
      <div class="row g-0">

        <div class="col-lg-6 col-sm-12">
          <div class="image-product">
            <img src=admin/dashboard/postimages/<?php echo $obj->Picture ?> alt="">
          </div>
        </div>
        
        <div class="col-lg-6 col-sm-12 mt-2 p-4 ">
          <div class="bread-crump mb-4">
            <a href="home.php">หน้าหลัก</a> >
            <a href="store.php">สินค้าที่ระลึก</a> >
            <a class="news_ac_name" href="#"><?php echo $obj->productName ?></a>
          </div>

          <div class="product-detail">
            <h2><?php echo $obj->productName ?></h2>
            <h4 class="pb-5">฿ <?php echo $obj->Price ?>.-</h4>
            <p><?php echo $obj->short_details ?>.-<br><br>
              สินค้าเหลือจำนวน <?php echo $obj->stock ?> ชิ้น
            </p>
              <input class="add-to-cart" type="text" name="product_qty" value="1" size="3">
              <a class="submit cart-button add_to_cart text-black" href="">เพิ่มใส่ตะกร้า</a>

            <p class="mt-3">ประเภทสินค้า : <?php echo $obj->product_type ?></p>
            <div id="fb-root"></div>

            
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v14.0" nonce="Jzdj39xc"></script>
            <div class="fb-share-button mt-4" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="large">
              <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share" viewBox="0 0 16 16"><path d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/></svg>
                แชร์
              </a>

              <a href="login-system/login_form.php" class="add-to-cart pl-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16"><path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                เพิ่มใส่ตะกร้า
              </a>
              <input type="hidden" name="Product_ID" value="<?php $Product_ID ?>" />
              <input type="hidden" name="type" value="add" />
              <input type="hidden" name="return_url" value="<?php $current_url ?>" />          
            </div>

          </div>
        </div>

      </div>
      </form>

    </div>
  
  <div class="row g-0">    
  <div class="col-lg-12">
  <div class="tabset mt-4">
    <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
    <label for="tab1">รายละเอียด</label>

    <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
    <label for="tab2">ข้อมูลสินค้า</label>
    
    <div class="tab-panels">
      <section id="marzen" class="tab-panel">
        <p><?php echo $obj->short_details ?></p>
    </section>
      <section id="rauchbier" class="tab-panel">
        <p><?php echo $obj->Description ?></p>
      </section>
    </div>
    <hr>
  </div>
  </div>
  
  </div><?php  
      }
    }
  ?>

    <div class="hof_rand">
      <h2>สินค้าที่ระลึก</h2>  
      <div class="row">
        <?php
        $sql = "SELECT * FROM store ORDER BY RAND() LIMIT 4";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
        ?>

        <div class="col-lg-3 col-sm-6 col-xs-6 pt-4">
            <div class="ymal">
                <a href="product.php?id=<?php echo $row['Product_ID']; ?>">
                    <img src="admin/dashboard/postimages/<?php echo $row['Picture']; ?>" alt="">
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
</body>

<script language="javascript" type="text/javascript">
   $(document).ready(function () {
      $("#mytabs").tabs({ fx: {opacity: 'toggle'} });
   });
</script>

<script src="assets/js/js-carousel-12/jquery-3.3.1.min.js"></script>
<script src="assets/js/js-carousel-12/popper.min.js"></script>
<script src="assets/js/js-carousel-12/bootstrap.min.js"></script>
<script src="assets/js/js-carousel-12/owl.carousel.min.js"></script>
<script src="assets/js/js-carousel-12/main.js"></script>

<?php require('template/footer.php') ?>

