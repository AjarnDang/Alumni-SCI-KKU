<?php
include "../db/connection.php";
require('../template/header_user.php');
error_reporting(0);
require_once("../template/pagination_function.php");

if (!isset($_SESSION['username'])) {
  header("location: ../login-system/login_form.php");
}   
if($_GET['action']='del') {
  $postid=intval($_GET['id']);
  $query=mysqli_query($conn,"UPDATE community_topic 
                                set Is_Active=0
                              where id='$postid'
                             ");
  if($query) {
    echo "<script>alert('หัวข้อของคุณถูกเก็บไว้ในถังขยะใน 'บัญชี' ของคุณ');</script>";
  } 
}
if($_GET['action']='restore') {
  $postid=intval($_GET['pid']);
  $query=mysqli_query($conn,"UPDATE community_topic 
                                set Is_Active=1
                              where id='$postid'
                           ");
  if($query) {
    $msg="กู้คืนโพสต์สำเร็จ";
  } else{
    $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง.";    
  } 
}

if($_GET['presid']) { // Forever deletionparmdel
  $id=intval($_GET['presid']);
  $query=mysqli_query($conn,"DELETE from community_topic 
                                   where id='$id'
                                  ");
  $delmsg="ลบโพสต์สำเร็จ";
}
?>
<link rel="stylesheet" href="../assets/css/user_profile.css">
<link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css" >

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!--Boostrap vertical tab-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
   <script type="text/javascript">
      $(function() {
         $( "#date" ).datepicker({dateFormat: 'yy'});
      });
   </script>
<?php
$username = $_SESSION['username'];
$sql = "SELECT user.id,
               user.student_id,
               user.username,
               user.email,
               user.password,
               user.confirm_password,
               user.firstname,
               user.lastname,
               user.gender,
               user.fos_id,
               user.career_id,
               user.start_year,
               user.end_year,
               user.userlevel,
               user.status,
               user.address,
               user.postal_code,
               user.province_id,
               user.amphure_id,
               user.district_id,
               user.phone_number,
               user.date_of_birth,
               user.company,
               user.Is_Active,
               user.created_at,
               field_of_study.fos_id,
               field_of_study.fos_name,
               career.career_id,
               career.career_name
          FROM user 
          join field_of_study   on field_of_study.fos_id  = user.fos_id
          join career           on career.career_id       = user.career_id
         WHERE username = '$username'
           and user.Is_Active = 1";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($result)) {
?>
  <body>
    <div class="container mt-5 mb-5">
      <div class="bread-crump mb-3">
        <a href="user_home.php">หน้าหลัก</a> >
        <a href="#">บัญชีของฉัน</a>
      </div>
      <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/></svg>
                        <span class="text-uppercase align-middle">ข้อมูลผู้ใช้งาน</span></a>
                    <!--
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                        <span class="text-uppercase align-middle">ข้อมูลส่วนตัว</span></a>
                    -->
                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16"><path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/><path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/></svg>
                        <span class="text-uppercase align-middle">โพสต์ของคุณ</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-delete-tab" data-toggle="pill" href="#v-pills-delete" role="tab" aria-controls="v-pills-delete" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>
                        <span class="text-uppercase align-middle">โพสต์ที่คุณลบ</span></a>    
                </div>
            </div>


            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">

                    <!--ข้อมูลผู้ใช้งาน-->
                    <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">                       
                        <div class="d-flex justify-content-between">
                          <div>
                            <h1 class="mb-3 align-middle">
                              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/></svg> 
                              ข้อมูลผู้ใช้งาน
                            </h1>
                          </div>
      
                        </div>
                        <hr class="mb-4">

                      <form action="edit_profile.php" method="post" encrypt="multipart/form-data">
                        <div class="user-profile">
                          <div class="row">

                            <!--username-->
                              <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="username">ชื่อผู้ใช้งาน</label>
                                <div class="col-lg-9"><input class="form-control" type="text" name="username" readonly value="<?php echo $_SESSION['username'];?>"></div>
                              </div>

                              <!--รหัส นศ-->
                              <div class="form-group row">
                                <label for="student_id" class="col-lg-3 col-form-label">รหัสนักศึกษา</label>
                                <div class="col-lg-9"><input class="form-control" type="text" name="student_id" id="student_id" value="<?php echo $row['student_id']; ?>" max="11" min="11" placeholder="6230XXXXX-X"></div>
                              </div>

                              <!--password-->
                              <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="fullname">รหัสผ่าน</label>
                                <div class="col-lg-5"><input class="form-control" type="password" name="password" placeholder="รหัสผ่าน"></div>
                                <div class="col-lg-4"><input class="form-control" type="password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน"></div>
                              </div>

                              <!--ปีที่เข้า/ปีที่จบ-->
                              <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="fullname">ปีการศึกษาที่เข้า/จบ</label>
                                <div class="col-lg-5"><input class="form-control" type="text" name="start_year" value="<?php echo $row['start_year']; ?>" id="date" min="4" max="4" placeholder="ปีการศึกษาที่เข้า"></div>
                                <div class="col-lg-4"><input class="form-control" type="text" name="end_year" id="date" value="<?php echo $row['end_year']; ?>" min="4" max="4" placeholder="ปีการศึกษาที่จบ"></div>
                              </div>

                              <!--email-->
                              <div class="form-group row">
                                <label class="col-lg-3 col-sm-12 col-form-label" for="email">อีเมล</label>
                                <div class="col-lg-9 col-sm-12"><input class="form-control" type="email" name="email" placeholder="email" value="<?php echo $row['email']; ?>"></div>
                              </div>

                              <!--telephone-->
                              <div class="form-group row">
                                <label class="col-lg-3 col-sm-12 col-form-label" for="phone_number">โทรศัพท์</label>
                                <div class="col-lg-9 col-sm-12"><input class="form-control" type="text" name="phone_number" placeholder="โทรศัพท์" min="10" max="10" value="<?php echo $row['phone_number']; ?>"></div>
                              </div>

                              <!--ชื่อ สกุล-->
                              <div class="form-group row">
                                <label class="col-lg-3 col-sm-12 col-form-label" for="fullname">ชื่อ-สกุล</label>
                                <div class="col-lg-5 col-sm-12"><input class="form-control" type="text" name="firstname" placeholder="ชื่อ" value="<?php echo $row['firstname']; ?>"></div>
                                <div class="col-lg-4 col-sm-12"><input class="form-control" type="text" name="lastname" placeholder="นามสกุล" value="<?php echo $row['lastname']; ?>"></div>
                              </div>

                              <!-- เพศ -->
                              <div class="form-group row">
                                <label class="col-lg-3 col-sm-12 col-form-label" for="fullname">รายละเอียดเพิ่มเติม</label>
                                <div class="col-lg-3 col-sm-12">
                                  <select name="gender" id="gender" class="form-select info-select">
                                    <option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
                                    <option value="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                    <option value="อื่นๆ">อื่นๆ</option>
                                  </select>
                                </div>

                                <!-- สาขา -->
                                <div class="col-lg-3 col-sm-12">
                                <select name="fos_id" id="" class="form-select info-select">
                                  <option value="<?php echo $row['fos_id']; ?>"><?php echo $row['fos_name']; ?></option>
                                  <?php // Feching active Field Of Study
                                  $fos=mysqli_query($conn,"SELECT * from field_of_study
                                                           WHERE Is_Active = 1
                                                           ");
                                   while($result=mysqli_fetch_array($fos)) { ?>                                    
                                  <option value="<?php echo ($result['fos_id']);?>"><?php echo ($result['fos_name']);?></option>
                                    <?php } ?>
                                </select>
                                </div>                   
                                                    
                                <div class="col-lg-3 col-sm-12">
                                <select name="career_id" id="" class="form-select info-select">
                                  <option value="<?php echo $row['career_id']; ?>"><?php echo $row['career_name']; ?></option>
                                  <?php // Feching active Career
                                  $career=mysqli_query($conn,"SELECT * from career
                                                              WHERE Is_Active = 1
                                                              ");
                                    while($result=mysqli_fetch_array($career)) { ?>
                                    <option value="<?php echo ($result['career_id']);?>"><?php echo ($result['career_name']);?></option>
                                    <?php } ?>
                                </select>
                              </div>
                              </div>

                              <!--select จังหวัด / อำเภอ / ตำบล-->
                              <?php 
                                $sql2 = "SELECT * FROM provinces";
                                $query = mysqli_query($conn, $sql2); ?>
                              <div class="form-group row pb-0">
                                <label class="col-lg-3 col-sm-12 col-form-label" for="fullname">ที่อยู่</label>
                                    <div class="col-lg-3 col-sm-12">
                                        <select name="province_id" id="province" class="form-select info-select">
                                            <option value="<?php echo $row['province_id'] ?>"><?php echo $row['province_id'] ?></option>
                                              <?php while($result = mysqli_fetch_assoc($query)): ?>
                                                <option value="<?=$result['id']?>"><?=$result['name_th']?></option>
                                              <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <select name="amphure_id" id="amphure" class="form-select info-select">
                                            <option value="<?php echo $row['amphure_id'] ?>"><?php echo $row['amphure_id'] ?></option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <select name="district_id" id="district" class="form-select info-select">
                                            <option value="<?php echo $row['district_id'] ?>"><?php echo $row['district_id'] ?></option>
                                        </select>
                                    </div> 
                              </div>                             

                              <!--address-->
                              <div class="form-group row">
                                <label class="col-lg-3 col-sm-12 col-form-label" for=""></label>
                                <div class="col-lg-5 col-sm-12">
                                  <input class="form-control" type="text" name="address" placeholder="บ้านเลขที่" value=<?php echo $row['address']; ?>>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                  <input class="form-control" type="text" name="postal_code" placeholder="รหัสไปรษณีย์" value=<?php echo $row['postal_code']; ?>>
                                </div>
                              </div>

                              <div class="form-group row">
                                <label for="student_id" class="col-lg-3 col-form-label"></label>
                                <div class="col-lg-9"><input class="btn submit-button w-100" type="submit" name="submit1" value="บันทึก"></div>
                              </div>

                          </div>
                        </div>
                      </form>
                    </div>                  
                    

                    <!--ข้อมูลส่วนตัว-->
                    <!--
                      <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                          <div class="d-flex justify-content-between">
                            <div>
                              <h1 class="mb-3 align-middle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                                ข้อมูลส่วนตัว
                              </h1>
                            </div>
                          </div>
                          <hr class="mb-4">
                          <form action="" method="post" encrypt="multipart/form-data">
                            <div class="user-profile">
                              <div class="row">
                                

                                <div class="form-group row">
                                  <label for="student_id" class="col-lg-3 col-sm-12 col-form-label"></label>
                                  <div class="col-lg-9 col-sm-12">
                                  <input class="btn submit-button w-100" type="submit" name="submit" value="บันทึก">
                                  </div>
                                </div>
                                
                              </div>
                            </div>
                          </form>
                      </div>
                    -->
                    

                    <!--โพสต์ของคุณ-->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <div class="d-flex justify-content-between">
                          <div>
                            <h1 class="mb-3 align-middle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16"><path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/><path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/></svg>
                              โพสต์ของคุณ
                            </h1>
                          </div>
                          <!--<div><a class="text-secondary" href="user_history.php">ประวัติการเปลี่ยนแปลงข้อมูล</a></div>-->
                        </div>
                        <hr class="mb-4">   
                        <div class="row">          
                        <?php 
                            $userid = $_SESSION['userid'];
                            $tag = $conn->query("SELECT * FROM community_category order by CategoryName asc");            
                            while($row= $tag->fetch_assoc()) {
                              $tags[$row['id']] = $row['CategoryName'];
                            }
                            $sql = "SELECT  community_topic.id,
                                            community_topic.PostTitle,
                                            community_topic.CategoryId,
                                            community_topic.PostDetails,
                                            community_topic.PostingDate,
                                            community_topic.Is_Active,
                                            community_topic.PostImage,
                                            community_topic.user_id,
                                            user.username
                                      from community_topic
                                      join user on user.id = community_topic.user_id 
                                     where community_topic.Is_Active = 1
                                       and user_id = $userid
                                        ";  
                        $result=$conn->query($sql);
                        $total=$result->num_rows;

                        $e_page = 10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
                        $step_num=0;
                        if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page']==1)){   
                            $_GET['page']=1;   
                            $step_num=0;
                            $s_page = 0;    
                        }else{   
                            $s_page = $_GET['page']-1;
                            $step_num=$_GET['page']-1;  
                            $s_page = $s_page*$e_page;
                        }
                        $sql.="ORDER BY community_topic.PostingDate DESC LIMIT ".$s_page.",$e_page";      
                        $result=$conn->query($sql);
                        if($result && $result->num_rows>0){                  
                            while($row = $result->fetch_assoc()) { 
                              $view =    $conn->query("SELECT * FROM community_forum_view where topic_id=".$row['id'])->num_rows;
                              $comment = $conn->query("SELECT * FROM community_comment    where postId=".$row['id'])->num_rows;
                              $reply =   $conn->query("SELECT * FROM community_reply      where comment_id in (SELECT id FROM community_comment where postId=".$row['id'].")")->num_rows;
                        ?>      
                            <div class="col-lg-11 col-sm-12">     
                              <div class="card bg-light mb-3">
                                <div class="card-body">

                                <div class="d-flex justify-content-between">
                                  <div class="news-topic">
                                    <h3 class="px-0 mx-0"><a class="text-black" href="community_detail.php?nid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['PostTitle']);?></a></h3>
                                    เมื่อ : <a class="text-secondary" href="community_detail.php?nid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['PostingDate']);?></a>               
                                  </div>
                                  <div>
                                    <a href="news_ac_detail.php?nid=<?php echo htmlentities($row['id'])?>">
                                    <?php if ($row['PostImage'] != '') { ?>
                                      <img class="news-image rounded" width="100" src="../admin/dashboard/postimages/<?php echo htmlentities($row['PostImage']);?>"/>
                                    <?php } else {
                                        echo '';
                                      }?>
                                    </a>
                                  </div>     
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                  <div><span class="category bg-light border border-secondary rounded px-4 py-2">
                                    <a class="text-black" href="community_detail.php?nid=<?php echo htmlentities($row['id'])?>">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16"><path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/></svg>
                                      <?php foreach(explode(",",$row['CategoryId']) as $cat) { ?>
                                        <span><?php echo $tags[$cat] ?></span>
                                        <span><?php //echo $tags[$row['id']] ?></span>
                                      <?php } ?>
                                    </a>
                                    </span>
                                  </div>
                                  <div>
                                    <span class="bg-light py-2">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16"><path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/><path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/></svg> 
                                      <?php echo number_format($comment) ?> คอมเมนต์</span>
                                  </div>
                                </div>

                              </div>
                            </div>
                            </div>

                            <div class="col-lg-1 text-center">
                              <span>
                                <a href="community_editpost.php?id=<?php echo htmlentities($row['id']);?>" class="align-middle my-auto m-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>
                                </a>          
                              </span>
                              
                              <span>                       
                                <a href="user_profile.php?id=<?php echo htmlentities($row['id']);?>&action=del"
                                    onclick="return confirm('คุณต้องการจะลบโพสต์นี่หรือไม่ ?')" class="align-middle my-auto m-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>
                                </a> 
                              </span>            
                             </div>  

                          <div class="col-12">
                            <hr>
                          </div>          
                        <?php } ?> 
                        </div> 
                        <div style="height: 1em;"></div>
                        <?php //page_navi($total,(isset($_GET['page']))?$_GET['page']:1,$e_page);?>     
                      
                      <?php } ?>
                    </div>


                    <!--โพสต์ที่ลบ-->
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-delete" role="tabpanel" aria-labelledby="v-pills-delete-tab">
                        <div class="d-flex justify-content-between">
                          <div>
                            <h1 class="mb-3 align-middle">
                              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>
                              โพสต์ที่คุณลบ
                            </h1>
                          </div>
                          <!--<div><a class="text-secondary" href="user_history.php">ประวัติการเปลี่ยนแปลงข้อมูล</a></div>-->
                        </div>
                        <hr class="mb-4">
                        <div class="row">
                        <?php 
                            $userid = $_SESSION['userid'];
                            $tag = $conn->query("SELECT * FROM community_category order by CategoryName asc");            
                            while($row= $tag->fetch_assoc()) {
                              $tags[$row['id']] = $row['CategoryName'];
                            }
                            $sql = "SELECT  community_topic.id,
                                            community_topic.PostTitle,
                                            community_topic.CategoryId,
                                            community_topic.PostDetails,
                                            community_topic.PostingDate,
                                            community_topic.Is_Active,
                                            community_topic.PostImage,
                                            community_topic.user_id,
                                            user.username
                                      from community_topic
                                      join user on user.id = community_topic.user_id 
                                     where community_topic.Is_Active = 0
                                       and user_id = $userid
                                        ";  
                        $result=$conn->query($sql);
                        $total=$result->num_rows;

                        $e_page = 10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
                        $step_num=0;
                        if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page']==1)){   
                            $_GET['page']=1;   
                            $step_num=0;
                            $s_page = 0;    
                        }else{   
                            $s_page = $_GET['page']-1;
                            $step_num=$_GET['page']-1;  
                            $s_page = $s_page*$e_page;
                        }
                        $sql.="ORDER BY community_topic.PostingDate DESC LIMIT ".$s_page.",$e_page";      
                        $result=$conn->query($sql);
                        if($result && $result->num_rows>0){                  
                            while($row = $result->fetch_assoc()) { 
                              $view =    $conn->query("SELECT * FROM community_forum_view where topic_id=".$row['id'])->num_rows;
                              $comment = $conn->query("SELECT * FROM community_comment    where postId=".$row['id'])->num_rows;
                              $reply =   $conn->query("SELECT * FROM community_reply      where comment_id in (SELECT id FROM community_comment where postId=".$row['id'].")")->num_rows;
                        ?>  
                          <div class="col-lg-11 col-sm-12">         
                              <div class="card bg-light">
                                <div class="card-body">

                                <div class="d-flex justify-content-between">
                                  <div class="news-topic">
                                    <h3 class="px-0 mx-0">
                                      <a class="text-black" href="community_detail.php?nid=<?php echo htmlentities($row['id'])?>">
                                        <?php echo htmlentities($row['PostTitle']);?>
                                      </a>
                                    </h3>
                                    เมื่อ : <a class="text-secondary" href="community_detail.php?nid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['PostingDate']);?></a>               
                                  </div>
                                  <div>
                                    <a href="news_ac_detail.php?nid=<?php echo htmlentities($row['id'])?>">
                                    <?php if ($row['PostImage'] != '') { ?>
                                      <img class="news-image rounded" width="100" src="../admin/dashboard/postimages/<?php echo htmlentities($row['PostImage']);?>"/>
                                    <?php } else {
                                        echo '';
                                      }?>
                                    </a>
                                  </div>     
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                  <div><span class="category bg-light border border-secondary rounded px-4 py-2">
                                    <a class="text-black" href="community_detail.php?nid=<?php echo htmlentities($row['id'])?>">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16"><path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/></svg>
                                      <?php foreach(explode(",",$row['CategoryId']) as $cat) { ?>
                                        <span><?php echo $tags[$cat] ?></span>
                                        <span><?php //echo $tags[$row['id']] ?></span>
                                      <?php } ?>
                                    </a>
                                    </span>
                                  </div>
                                  <div>
                                    <span class="bg-light py-2">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16"><path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/><path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/></svg> 
                                      <?php echo number_format($comment) ?> คอมเมนต์</span>
                                  </div>
                                </div>                                    
                                
                              </div>
                            </div>
                          </div>

                          <div class="col-lg-1 text-center restore">
                              <span>
                                <a href="user_profile.php?pid=<?php echo htmlentities($row['id']);?>
                                  &&action=restore" onclick="return confirm('คุณต้องการจะกู้คืนโพสต์นี้หรือไม่ ?')" class="align-middle my-auto m-3">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/><path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/></svg>
                                </a>          
                              </span>
                              
                              <span>                       
                                <a href="user_profile.php?presid=<?php echo htmlentities($row['id']);?>
                                  &&action=perdel" onclick="return confirm('คุณต้องการจะลบโพสต์นี่หรือไม่ ?')" class="align-middle my-auto m-3">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>
                                </a> 
                              </span>            
                             </div> 

                          <div class="col-12">
                            <hr class="my-4">
                          </div>
                        <?php } } ?>
                        
                      </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    </section>
    </div>
    <div class="py-1"></div>
    <script src="../login-system/script.js"></script> 
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
  </body>
  <script>
  $(function() {
    $('#datepicker').datepicker({
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy',
        onClose: function(dateText, inst) { 
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, 1));
        }
    });
  $(".date-picker-year").focus(function () {
          $(".ui-datepicker-month").hide();
      });
  });
  </script>

  <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
  <script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>                          
  <?php require('../template/footer_users.php') ?>
<?php } ?>