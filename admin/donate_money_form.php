<?php 
include('../template/header_admin.php'); 
?>
<link rel="stylesheet" href="../../css/donate_form.css">
<body>
<div id="banner" style="background-image: url('../../img/decoration-img/kku-darker.jpg');">
        <div class="container">
            <div class="topic">
                <!--<h1>&lt;GTCoding/&gt;</h1>-->         
                <h1 style="color:white;">
                  <b>ร่วมบริจาคให้เรา</b>
                </h1>                      
            </div>
        </div>
    </div>  
    
    <div class="container donate-content" style="margin-top: 6em; margin-bottom: 6em; box-shadow: 0px 10px 30px 0px rgb(233,233, 233);">

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
      <div class="second-step">
          <div class="second-step-content bg-white">
            <h4 class="mt-4 mb-4">ขั้นตอนที่ 2 : กรอกข้อมูล</h4>
              <!--
              <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        โอนผ่านระบบ iBanking
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        บัตรเครดิต / เดบิต
                    </label>
                </div>
              -->
              <div class="form container">
      <hr class="mb-4">

      <form action="edit_profile.php" method="post" encrypt="multipart/form-data">
        <div class="user-profile">
          <div class="row">
            <div class="col-lg-12">

            <!--ชื่อ สกุล-->
            <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="fullname"><span class="text-danger">*</span> ชื่อ-สกุล</label>
                <div class="col-lg-4">
                  <input class="form-control" type="text" name="firstname" placeholder="ชื่อ" value="">
                </div>
                <div class="col-lg-5">
                  <input class="form-control" type="text" name="lastname" placeholder="นามสกุล" value="">
                </div>
              </div>

              <!--บัตร ปชช-->
              <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="citizen_id"><span class="text-danger">*</span> เลขประจำตัวประชาชน</label>
                <div class="col-lg-9">
                  <input class="form-control" type="text" name="citizen_id" placeholder="เลขประจำตัวประชาชน" value="">
                </div>
              </div>

              <!--telephone-->
              <div class="form-group row">
                <label class="col-lg-3 col-form-label" for="phone_number"><span class="text-danger">*</span> โทรศัพท์</label>
                <div class="col-lg-9">
                  <input class="form-control" type="text" name="phone_number" placeholder="โทรศัพท์" value="">
                </div>
              </div>

              <!--address-->
              <div class="form-group row">
              <label class="col-lg-3 col-form-label" for=""><span class="text-danger">*</span> ที่อยู่ปัจจุบัน</label>
                <div class="col-lg-4">
                  <input class="form-control" type="text" name="address" placeholder="บ้านเลขที่" value="">
                </div>
                <div class="col-lg-5">
                  <input class="form-control" type="text" name="postal_code" placeholder="รหัสไปรษณีย์" value="">
                </div>
              </div>

              <!--select จังหวัด / อำเภอ / ตำบล-->
              <div class="form-group row">
              <label class="col-lg-3 col-form-label" for=""></label>
                <div class="col-lg-3">
                  <select class="custom-select" name="current_province">
                    <option value="" selected>ระบุจังหวัด</option>
                    <option value="กาฬสินธุ์">กาฬสินธุ์</option>
                    <option value="หนองคาย">หนองคาย</option>
                    <option value="มหาสารคาม">มหาสารคาม</option>
                  </select>
                </div>
                <div class="col-lg-3">
                  <select class="custom-select" name="current_district">
                    <option value="" selected>ระบุอำเภอ</option>
                    <option value="เมืองขอนแก่น">เมืองขอนแก่น</option>
                    <option value="ชุมแพ">ชุมแพ</option>
                    <option value="น้ำพอง">น้ำพอง</option>
                    <option value="บ้านไผ่">บ้านไผ่</option>
                    <option value="เขาสวนกวาง">เขาสวนกวาง</option>
                  </select>
                </div>
                <div class="col-lg-3">
                  <select class="custom-select" name="current_sub_district">
                    <option value="" selected>ระบุตำบล</option>
                    <option value="สำราญ">สำราญ</option>
                    <option value="ท่าพระ">ท่าพระ</option>
                    <option value="บ้านทุ่ม">บ้านทุ่ม</option>
                  </select>
                </div>
              </div>

              <div class="text-right mt-4">
                <button type="button" class="btn mr-2" onclick="document.location='./donate_money.php'">ย้อนกลับ</button>
                <input style="width: 6em;" class="btn submit-button" type="submit" name="submit" value="บันทึก">
              </div>
            </div>

          </div>
        </div>
      </form>
    </div>
          </div>
      </div>
      </div>
    </div>
</body>

<?php include('../template/footer_users.php');  ?>