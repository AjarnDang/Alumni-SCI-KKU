
<?php 
require_once 'db/connection.php';
require('template/header.php');
?>
<link rel="stylesheet" href="assets/css/donate_page.css">

<div id="banner" class="mb-2" style="background-image: url('assets/img/decoration-img/kku-darker.jpg');">
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
            <a href="#">บริจาคเงิน</a>
        </div>
  </div>
    <div class="container donate-content mb-5" style="box-shadow: 0px 10px 30px 0px rgb(233,233, 233);">

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
                  <h4 class="mt-4 mb-4">ขั้นตอนที่ 2 : เลือกกองทุน</h4>
                
                  <?php  
                /*
                    $sql = "SELECT * FROM donate";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result)) {               
                    ?>
                  <div class="choose-donate row no-gutters g-0+">
                    <div class="col-md-8 col-sm-12 d-md-block">
                        <img src="<?php echo $row['donate_image']; ?>" alt="">
                        <span class="ml-4"><?php echo $row['donate_name']; ?></span>
                    </div>

                    <div class="col-md-auto col-12 justify-content-center align-self-center">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group align-item-right" role="group" aria-label="First group">
                              <button type="button" class="btn btn-secondary" onclick="document.location='https://e.sc.kku.ac.th/donation/form/create'">
                                บริจาค
                              </button>
                              <button type="button" class="btn btn-moreinfo" data-bs-toggle="collapse" data-bs-target="#<?php echo $row['donate_id'] ?>" aria-expanded="false" aria-controls="collapseExample">
                                + รายละเอียดเพิ่มเติม
                              </button>
                            </div>
                    </div>           
                    </div>
                          <div class="col-12">
                            <div class="collapse mt-3" id="<?php echo $row['donate_id'] ?>">
                              <div class="card card-body">

                                <div class="row">
                                  <div class="col-6">
                                    <h4><b>รายละเอียด</b></h4>
                                    <?php echo $row['donate_description']; ?>
                                  </div>

                                  <div class="col-6">
                                  <h4><b>สนใจดูรายละเอียดได้ที่</b></h4>
                                    <a href="https://sc3.kku.ac.th/scfund50">
                                    <?php echo $row['donate_detail']; ?>
                                    </a>
                                  </div>
                                  </div>

                                </div>
                              </div>
                          </div>
                  </div>

                  <hr>
                <?php } 
              */
                ?>
              
                  <div class="choose-donate row no-gutters g-0+">
                        <div class="col-md-8 col-sm-12 d-md-block">
                            <img src="assets/img/sci_logo.png" alt="">
                            <span class="ml-4">กองทุน 50 ปี คณะวิทยาศาสตร์</span>
                        </div>
                        <div class="col-md-auto col-12 justify-content-center align-self-center">
                          <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="First group">
                              <button type="button" class="btn btn-secondary" onclick="document.location='https://e.sc.kku.ac.th/donation/form/create'">
                                บริจาค
                              </button>
                              <button type="button" class="btn btn-moreinfo" data-bs-toggle="collapse" data-bs-target="#collapseExample-1" aria-expanded="false" aria-controls="collapseExample">
                                + รายละเอียดเพิ่มเติม
                              </button>
                            </div>
                          </div>           
                        </div>
                        <div class="col-12">
                          <div class="collapse mt-3" id="collapseExample-1">
                            <div class="card card-body">
                              <div class="row">
                                <div class="col-6"><h4><b>รายละเอียด</b></h4>
                                    ขอเชิญชวนบริจาคเงินเข้ากองทุน 50 ปี คณะวิทยาศาสตร์ 
                                    มหาวิทยาลัยขอนแก่น  โดยใบเสร็จสามารถนำไปลดหย่อนภาษีได้ 2 เท่า
                                    ทั้งนี้  ท่านสามารถระบุวัตถุประสงค์ในการบริจาค เช่น เพื่อเป็นทุนการศึกษา
                                    เพื่อสนับสนุนกิจกรรมของสโมสรนักศึกษา หรืออื่นๆ เป็นต้น
                                </div>
                                <div class="col-6"><h4><b>สนใจดูรายละเอียดได้ที่</b></h4>
                                  <a href="https://e.sc.kku.ac.th/scfund50/?fbclid=IwAR2wYWXDhBx8uMfCTnClxFQq3E-0ydri9KXB1fIJJ2ZeYfed2oDxBWhK7os">
                                      https://e.sc.kku.ac.th/scfund50/?fbclid=IwAR2wYWXDhBx8uMfCTnClxFQq3E-0ydri9KXB1fIJJ2ZeYfed2oDxBWhK7os
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                  </div>

                    <hr>     
                   
                  <div class="choose-donate row no-gutters g-0+">
                        <div class="col-md-8 col-sm-12 d-md-block">
                            <img src="https://kkuoaa.kku.ac.th/wp-content/uploads/2019/10/cad_web_logo2018_black.png" alt="">
                            <span class="ml-4">กองทุนศิษย์เก่า คณะวิทยาศาสตร์</span>
                        </div>
                        <div class="col-md-auto col-12 justify-content-center align-self-center">
                          <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group align-item-right" role="group" aria-label="First group">
                              <button type="button" class="btn btn-secondary" onclick="document.location='https://kkuoaa.kku.ac.th/?page_id=563'">
                                บริจาค
                              </button>
                              <button type="button" class="btn btn-moreinfo" data-bs-toggle="collapse" data-bs-target="#collapseExample-2" aria-expanded="false" aria-controls="collapseExample">
                                + รายละเอียดเพิ่มเติม
                              </button>
                            </div>
                          </div>           
                        </div>
                        <div class="col-12">
                          <div class="collapse mt-3" id="collapseExample-2">
                            <div class="card card-body">
                              <div class="row">
                                <div class="col-6"><h4><b>รายละเอียด</b></h4>
                                กองพัฒนานักศึกษาและศิษย์เก่าสัมพันธ์  มหาวิทยาลัยขอนแก่น 
                                เชิญชวนศิษย์เก่ามหาวิทยาลัยขอนแก่นและผู้มีจิตศรัทธาร่วมบริจาค 
                                โครงการระดมทุนเพื่อการศึกษา “พี่ให้น้องกองละ 1,000 บาท” ปีที่ 5 
                                เพื่อมอบทุนการศึกษาแก่นักศึกษามหาวิทยาลัยขอนแก่นที่ยังขาดแคลนทุนทรัพย์ 
                                </div>
                                <div class="col-6"><h4><b>สนใจดูรายละเอียดได้ที่</b></h4>
                                  <a href="https://kkuoaa.kku.ac.th/?page_id=563">
                                      https://kkuoaa.kku.ac.th/?page_id=563
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                  </div>

                    <hr>

                  <div class="text-right mt-4"><button type="button" class="btn mr-2" onclick="document.location='./donate.php'">ย้อนกลับ</button></div> 

              </div>
            </div>
          </div>


        </div>
<div class="py-1"></div>

<?php require('template/footer.php') ?>
