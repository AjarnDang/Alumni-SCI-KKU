<?php include('template/header.php');?>
<link rel="stylesheet" href="assets/css/store.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div id="banner" style="background-image: url('assets/img/decoration-img/kku-2-darker.jpg');">
    <div class="container">
        <div class="topic">           
            <h1 style="color:white;"><b>สินค้าที่ระลึก</b></h1>
            <p>ร้านขายสินค้าที่ระลึก เพื่อเป็นที่ระลึกแด่ศิษย์เก่า คณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น 
                <br>—<br>
                โดยสโมสรนักศึกษา คณะวิทยาศาสตร์
            </p>
        </div>
    </div>
</div>

  <div class="container">
        <div class="bread-crump mb-3 mt-3">
            <a href="home.php">หน้าหลัก</a> >
            <a href="#">สินค้าที่ระลึก</a>
        </div>
  </div>
    <section class="section-products">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-6">
				<div class="header">
					<h2>สินค้าของเรา</h2>
					<hr style="width: 30px;">
				</div>
			</div>
		</div>
	
		<div class="row">
			<?php 
			$results = $conn->query("SELECT * FROM store 
                                             WHERE Is_Active=1 
                                          ORDER BY Product_ID ASC
                                          ");
            if ($results) {
                while ($obj = $results->fetch_object()) { ?>
                   <div class="col-lg-3 col-mg-3 col-sm-6 col-xs-6 mt-3">
                   <form method="post" action="template/cart_update.php">
                   <div class="product-grid">
                       <div class="product-image">
                           <a href="product.php?id=<?php echo $obj->Product_ID ?>">
                               <img class="pic-1" src="admin/dashboard/postimages/<?php echo $obj->Picture ?>">
                           </a>
                       </div>
                       <div class="product-content">
                           <h3 class="title"><a href="#"><?php echo $obj->productName ?></a></h3>
                           <div class="price">฿ <?php echo$obj->Price ?>.-</div>
                           <input type="text" name="product_qty" value="1" size="3" />
                           <a class="add-to-cart" href="login-system/login_form.php">+ Add To Cart</a>
                       </div>
                   </div>
                   
                   <input type="hidden" name="Product_ID" value="<?php echo $obj->Product_ID ?>"/>
                   <input type="hidden" name="type" value="add" />
                   <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
                   </form>
               </div>                  
			<?php  
                } 
            }
            ?>
			<a href="#" class="justify-content-center text-center pt-5">
              ดูสินค้าทั้งหมด
			</a>
        </div>
		

    </div>
</section>

 
	
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>              


   <?php include('template/footer.php'); ?>