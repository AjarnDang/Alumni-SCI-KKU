<?php 
include('../template/header_admin.php'); 
?>
<link rel="stylesheet" href="../assets/css/donate.css">
<div id="banner" class="mb-2" style="background-image: url('../assets/img/decoration-img/kku-darker.jpg');">
        <div class="container">
            <div class="topic">
                <!--<h1>&lt;GTCoding/&gt;</h1>-->         
                <h1 style="color:white;">
                  <b>ร่วมบริจาคให้เรา</b>
                </h1>                      
            </div>
        </div>
    </div>

    <div class="container">
        <div class="bread-crump pt-5 py-3 px-0">
            <a href="home.php">หน้าหลัก</a> >
            <a href="#">สินค้าที่ระลึก</a>
        </div>
  </div>
    <div class="container donate-content my-6" style="box-shadow: 0px 10px 30px 0px rgb(233,233, 233);">

      <div class="donate-form row">
                <div class="col-lg-12 col-sm-12">
                  <h2>ขั้นตอนการบริจาค</h2>
                </div>
      </div>
      <div class="donate-method row">
                <div class="option-1 col-4">
                  <h5 class="text-center">
                    <i class="fa-solid fa-1"></i>
                    &emsp;เลือกช่องทางบริจาค
                  </h5>
                </div>
                
                  <div class="option-2 col-4 ">
                  <h5 class="text-center">
                    <i class="fa-solid fa-2"></i>
                    &emsp;เลือกกองทุน
                  </h5>
                </div>
             
                <div class="option-3 col-4">
                  <h5 class="text-center">
                    <i class="fa-solid fa-3"></i>
                    &emsp;กรอกข้อมูล
                  </h5>
                </div>
      </div>

      
      <div class="row bg-white">
        <div class="first-step">
          <div class="first-step-content">
                <h4 class="mt-4 mb-4">ขั้นตอนที่ 1 : เลือกช่องทางบริจาค</h4>
                <div class="row bg-white">

                  <div class="col-lg-6 mt-2">
                  <div class="card">
                    <img class="card-img-top" src="https://img.freepik.com/free-vector/people-carrying-donation-charity-related-icons_53876-43091.jpg?w=2000" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">บริจาคสิ่งของ</h5>
                        <p class="card-text">
                            คณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น ขอเชิญชวนร่วมบริจาคสิ่งของต่างๆ 
                            เพื่อมอบให้แก่ผู้ที่ขาดแคลน และปันน้ำใจให้แก่เพื่อนมนุษย์ร่วมกัน
                        </p>
                        <a href="donate_thing.php" class="btn">บริจาค</a>
                    </div>
                    </div>
                  </div>

                  <div class="col-lg-6 mt-2">
                    <div class="card">
                    <img class="card-img-top" src="https://udraodisha.com/wp-content/uploads/2021/08/1_4XRAX4obUOvMVqWibVCneQ.jpeg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">บริจาคเงินทุน</h5>
                        <p class="card-text">
                            คณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น ขอเชิญชวนร่วมบริจาคเงินทุนเพื่อเป็น
                            ทุนการศึกษาตลอดจนทุนวิจัย เพื่อพัฒนานักศึกษาและคณะต่อไป
                        </p>
                        <a href="donate_money.php" class="btn">บริจาค</a>
                    </div>
                    </div>
                  </div>
                </div>
        </div>
      </div>

      </div>
    </div>
    <div class="py-4"></div>

<?php include('../template/footer_users.php');  ?>