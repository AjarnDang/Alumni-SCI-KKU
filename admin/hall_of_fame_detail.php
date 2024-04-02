<?php 
include('../template/header_admin.php'); 
$id = $_GET['id'];
$sql = "SELECT * FROM hall_of_fame WHERE id = $id";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_array($result);
?>
<link rel="stylesheet" type='text/css' href="../assets/css/css-carousel-14/owl.carousel.min.css">
<link rel="stylesheet" type='text/css' href="../assets/css/css-carousel-14/bootstrap.min.css">
<link rel="stylesheet" type='text/css' href="../assets/css/hall_of_fame_detail.css">
                
<?php
    $NewDate = $row['hof_year'];  
    $NewdateFormat = date('d M Y', strtotime($NewDate));
?>
<body>
    <figure class="grad1">
        <?php
            if($row['hof_image_cover'] != "") {
                echo "<img class='image-cover' src='".$row['hof_image_cover']."'>";
            } else {
                echo "<img class='image-cover' src='../assets/img/decoration-img/kku-darker.jpg'>";
            }          
        ?>
        <!--<img class="image-cover" src="<?php //echo $row['hof_image_cover']; ?>">-->
        <div class="bread-crump-bg">
            <div class="container">
                <div class="bread-crump py-4">
                    <a href="user_page.php">หน้าหลัก</a> >
                    <a href="hall_of_fame.php">Hall of Fame (หอเกียรติยศ)</a> >
                    <a href="#"><?php echo $row['hof_prefix']." ".$row['hof_firstname']." ".$row['hof_lastname']; ?></a>
                </div>
            </div>
        </div>
        <div class="container">
            <figcaption>
            <?php
            if($row['hof_image'] != "") {
                echo "<img src='".$row['hof_image']."'>";
                } else {
                echo "<img src='https://www.pngitem.com/pimgs/m/391-3918613_personal-service-platform-person-icon-circle-png-transparent.png'>";
            }      
            ?>
                <!--<img src="<?php //echo $row['hof_image']; ?>" alt="">-->
                <h1 class="mt-3"><?php echo $row['hof_prefix']." ".$row['hof_firstname']." ".$row['hof_lastname']; ?></h1>
            </figcaption>
        </div>
    </figure> 

    <div class="container py-5">
        <div class="hof-des">
            <div class="row box">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <ul>
                        <li><h5>ศิษย์เก่าดีเด่นประจำปี</h5></li>
                        <li><?php echo $row['hof_year']; ?></li>
                    </ul>
                    <ul>
                        <li><h5>วัน/เดือน/ปี เกิด</h5></li>
                        <li><?php echo $NewdateFormat; ?></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <ul>
                        <li><h5>ความถนัด</h5></li>
                        <li><?php echo $row['hof_mastery']; ?></li>
                        <li><?php echo $row['hof_mastery_2']; ?></li>
                        <li><?php echo $row['hof_mastery_3']; ?></li>
                        <li><?php echo $row['hof_mastery_4']; ?></li>
                        <li><?php echo $row['hof_mastery_5']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 pt-4 mt-5 p-0">
            <p style="font-size: 18px; font-weight:300;"><?php echo $row['hof_description']; ?></p>
        </div>
    </div>

    <figure class="grad2">
        <?php
            if($row['hof_image_2'] != "") {
                echo "<img class='image-cover' src='".$row['hof_image_2']."'>";
                } else {
                echo "<img class='image-cover' src='../assets/img/decoration-img/kku-darker.jpg'>";
            }      
        ?>
        <!--<img class="image-cover" src="<?php //echo $row['hof_image_2'] ?>">-->
        
        <figcaption class="figcaption"> 
                <div class="content">
                <section id="slider">
                <?php
                        $sql = "SELECT * FROM hall_of_fame WHERE id = $id";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)) {
                            if($row['hof_reward'] != "") {
                            echo "<input type='radio' name='slider' id='s1' checked>";

                            } if($row['hof_reward_2'] != "") {
                            echo "<input type='radio' name='slider' id='s2'>";

                            } if($row['hof_reward_3'] != "") {
                            echo "<input type='radio' name='slider' id='s3'>";
    
                            } if($row['hof_reward_4'] != "") {
                            echo "<input type='radio' name='slider' id='s4'>";   

                            } if($row['hof_reward_5'] != "") {
                            echo "<input type='radio' name='slider' id='s5'>"; 
                            }
                        }
                    ?>
                    <?php
                        $sql = "SELECT * FROM hall_of_fame WHERE id = $id";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)) {
                            if($row['hof_reward'] != "") {
                            echo "<label for='s1' id='slide1'>
                                    <h4>รางวัลที่เคยได้รับ</h4>".$row['hof_reward']."
                                 </label>";       

                            } if($row['hof_reward_2'] != "") {
                                echo "<label for='s2'
                                             id='slide2'>
                                             <h4>รางวัลที่เคยได้รับ</h4>
                                             ".$row['hof_reward_2']."
                                     </label>";    

                            } if($row['hof_reward_3'] != "") {
                                echo "<label for='s3'
                                             id='slide3'>
                                             <h4>รางวัลที่เคยได้รับ</h4>
                                             ".$row['hof_reward_3']."
                                     </label>";

                            } if($row['hof_reward_4'] != "") {
                                echo "<label for='s4'
                                             id='slide4'>
                                             <h4>รางวัลที่เคยได้รับ</h4>
                                             ".$row['hof_reward_4']."
                                     </label>";       
                            } if($row['hof_reward_5'] != "") {
                                echo "<label for='s5'
                                             id='slide5'>
                                             <h4>รางวัลที่เคยได้รับ</h4>
                                             ".$row['hof_reward_5']."
                                     </label>";       
                                }
                            }
                    ?>
                </section>
                </div>
            </figcaption>
    </figure> 

    <div class="container">
    <?php 
        $sql = "SELECT * FROM hall_of_fame WHERE id = $id";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        ?>
        <div class="hof-history">
            <h2>ประวัติ</h2>  
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p><?php echo $row['hof_history'] ?></p>
                </div>
            </div>
        </div>

        <hr>
        
        <div class="hof_rand">
        <h2>ศิษย์เก่าดีเด่น</h2>  
        <div class="row">
        <?php
        $sql = "SELECT * FROM hall_of_fame ORDER BY RAND() LIMIT 8";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
        ?>

        <div class="col-lg-3 col-sm-6 col-xs-6 pt-4">
            <div class="ymal">
                <a href="hall_of_fame_detail.php?id=<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['hof_image'] ?>" alt="">
                </a>
                <a href="hall_of_fame_detail.php?id=<?php echo $row['id']; ?>">
                    <div class="alumni-name text-center mt-3">
                        <h5><?php echo $row['hof_prefix']." ".$row['hof_firstname']." ".$row['hof_lastname']; ?></h5>
                        <p><?php echo $row['hof_position'] ?></p>
                    </div>
                </a>
            </div>
        </div> 

        <?php } ?> 
        </div>   
        </div>
    </div>

    <script src="../assets/js/js-carousel-14/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/js-carousel-14/popper.min.js"></script>
    <script src="../assets/js/js-carousel-14/bootstrap.min.js"></script>
    <script src="../assets/js/js-carousel-14/owl.carousel.min.js"></script>
    <script src="../assets/js/js-carousel-14/main.js"></script>
</body>
<?php include('../template/footer_users.php');  ?>