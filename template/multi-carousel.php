<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/fonts/icomoon/style.css">
<link rel="stylesheet" href="../assets/css/css-carousel/owl.carousel.min.css">
<link rel="stylesheet" href="../assets/css/css-carousel/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/css-carousel/style.css">

  <div class="content">  
    <div class="container"><!--<h2 class="my-5 text-center"></h2>--></div>
      <div class="site-section bg-left-half mb-2">
        <div class="container owl-2-style">
        
        <h2 class="text-primary py-5 text-dark">สินค้าแนะนำ</h2>
        <div class="owl-carousel owl-2">
            <?php 
            $count = 1;
            $sql = "SELECT * FROM store";
            $result= mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) { 
              ?>
              <a href="">
              <div class="media-29101">
                  <img src="<?php echo $row['img'] ?>" alt="Image" class="img-fluid">               
                <h3>
                    <p><?php echo $row['nameproduct']; ?></p>
                    <p><?php echo $row['price']; ?></p>
                </h3>
              </div>
              </a>
            <?php 
                $count++; 
                } 
            ?>
        </div>

      </div>
    </div>
  </div>
    
    <script src="../assets/js/js-carousel/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/js-carousel/popper.min.js"></script>
    <script src="../assets/js/js-carousel/bootstrap.min.js"></script>
    <script src="../assets/js/js-carousel/owl.carousel.min.js"></script>
    <script src="../assets/js/js-carousel/main.js"></script>