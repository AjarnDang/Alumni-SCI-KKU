<?php require('../template/header_admin.php'); ?>
<link rel="stylesheet" href="../assets/css/alumni_detail.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<?php
$student_id = $_GET['id'];
$sql = "SELECT user.id as user_id,
               user.student_id,
               user.firstname,
               user.lastname,
               user.fos_id,
               field_of_study.fos_name
          FROM user 
          JOIN field_of_study on field_of_study.fos_id = user.fos_id
         WHERE id = '$student_id'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while ($row = mysqli_fetch_array($result)) {
  $user_id = $row['user_id'];
?>
  <body>
    <div class="new-background">
      <div id="banner" style="background-image: url('../assets/img/decoration-img/kku-2-darker.jpg');">
        <div class="container">
          <div class="topic">
            <h1 style="color:white;"><b><?php echo $row['firstname'] . " " . $row['lastname']; ?></b></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container my-4">

      <div class="tabs-to-dropdown">
        <div class="nav-wrapper d-flex align-items-center justify-content-between">
          <ul class="nav nav-pills d-none d-md-flex" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation"><a class="nav-link active" id="pills-company-tab" data-toggle="pill" href="#pills-company" role="tab" aria-controls="pills-company" aria-selected="true">ข้อมูลทั่วไป</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" id="pills-product-tab" data-toggle="pill" href="#pills-product" role="tab" aria-controls="pills-product" aria-selected="false">คอมมูนิตี้ (โพสต์)</a></li>
          <!--  
            <li class="nav-item" role="presentation"><a class="nav-link" id="pills-news-tab" data-toggle="pill" href="#pills-news" role="tab" aria-controls="pills-news" aria-selected="false">News</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a></li>
          -->
          </ul>
          <!--
          <ul class="list-group list-group-horizontal">
            <li class="list-group-item"><a href=""><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.19795 21.5H13.198V13.4901H16.8021L17.198 9.50977H13.198V7.5C13.198 6.94772 13.6457 6.5 14.198 6.5H17.198V2.5H14.198C11.4365 2.5 9.19795 4.73858 9.19795 7.5V9.50977H7.19795L6.80206 13.4901H9.19795V21.5Z" fill="currentColor" /></svg></a></li>
            <li class="list-group-item"><a href=""><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 3C9.10457 3 10 3.89543 10 5V8H16C17.1046 8 18 8.89543 18 10C18 11.1046 17.1046 12 16 12H10V14C10 15.6569 11.3431 17 13 17H16C17.1046 17 18 17.8954 18 19C18 20.1046 17.1046 21 16 21H13C9.13401 21 6 17.866 6 14V5C6 3.89543 6.89543 3 8 3Z" fill="currentColor" /></svg></a></li>
            <li class="list-group-item"><a href=""><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3.00977 5.83789C3.00977 5.28561 3.45748 4.83789 4.00977 4.83789H20C20.5523 4.83789 21 5.28561 21 5.83789V17.1621C21 18.2667 20.1046 19.1621 19 19.1621H5C3.89543 19.1621 3 18.2667 3 17.1621V6.16211C3 6.11449 3.00333 6.06765 3.00977 6.0218V5.83789ZM5 8.06165V17.1621H19V8.06199L14.1215 12.9405C12.9499 14.1121 11.0504 14.1121 9.87885 12.9405L5 8.06165ZM6.57232 6.80554H17.428L12.7073 11.5263C12.3168 11.9168 11.6836 11.9168 11.2931 11.5263L6.57232 6.80554Z" fill="currentColor" /></svg></a></li>
          </ul>
        -->
        </div>

        <div class="tab-content py-4" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-company" role="tabpanel" aria-labelledby="pills-company-tab">
            <div class="container-fluid">
              <h2 class="mb-3 font-weight-bold">ข้อมูลทั่วไป</h2>
              <p>ชื่อ-สกุล : <?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
              <p>รหัสนักศึกษา : <?php echo $row['student_id']; ?></p>
              <p>สาขา : <?php echo $row['fos_name']; ?></p>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-product" role="tabpanel" aria-labelledby="pills-product-tab">
            <div class="container-fluid">
              <h2 class="mb-3 font-weight-bold">คอมมูนิตี้ (โพสต์)</h2>
              <?php 
             $tag = $conn->query("SELECT * FROM community_category order by CategoryName asc");            
             while($row= $tag->fetch_assoc()) {
               $tags[$row['id']] = $row['CategoryName'];
             }
         $topic=mysqli_query($conn,"SELECT community_topic.id,
                                           community_topic.PostTitle,
                                           community_topic.CategoryId,
                                           community_topic.PostDetails,
                                           community_topic.PostingDate,
                                           community_topic.Is_Active,
                                           community_topic.PostImage,
                                           community_topic.user_id,
                                           user.username
                                      from community_topic
                                inner join user on user.id = community_topic.user_id 
                                     where community_topic.id='$user_id'"
                                     );  
         if($rowcount==0) { ?>
            <h3 class="text-center my-5">ผู้ใช้งานนี้ยังไม่มีโพสต์</h3>
          <?php } else {                              
         while ($row=$topic->fetch_assoc()) { 
           $view =    $conn->query("SELECT * FROM community_forum_view where topic_id=".$row['id'])->num_rows;
           $comment = $conn->query("SELECT * FROM community_comment    where postId=".$row['id'])->num_rows;
           $reply =   $conn->query("SELECT * FROM community_reply      where comment_id in (SELECT id FROM community_comment where postId=".$row['id'].")")->num_rows;
          ?>      
              <div class="col-lg-12 col-sm-12 px-0">     
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
              <?php } } ?>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
            <div class="container-fluid">
              <h2 class="mb-3 font-weight-bold">News</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor leo nec ligula viverra, quis facilisis nunc vehicula. Maecenas purus orci, efficitur in dapibus vel, rutrum in massa. Sed auctor urna sit amet eros mattis interdum. Integer imperdiet ante in quam lacinia, a laoreet risus imperdiet.</p>
              <p>Proin maximus iaculis rhoncus. Morbi ante nibh, facilisis semper faucibus consequat, facilisis ut ante. Mauris at nisl vitae justo auctor imperdiet. Cras sodales, justo sed tincidunt venenatis, ante erat ultricies eros, at mollis eros lorem ac mi. Fusce sagittis nibh nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec mollis eros sodales convallis faucibus. Vestibulum sit amet odio lectus. Duis eu dolor vitae est venenatis viverra eu sit amet nisl. Aenean vel sagittis odio. Quisque in lacus orci. Etiam ut odio lobortis odio consectetur ornare.</p>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            <div class="container-fluid">
              <h2 class="mb-3 font-weight-bold">Contact</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor leo nec ligula viverra, quis facilisis nunc vehicula. Maecenas purus orci, efficitur in dapibus vel, rutrum in massa. Sed auctor urna sit amet eros mattis interdum. Integer imperdiet ante in quam lacinia, a laoreet risus imperdiet.</p>
              <p>Proin maximus iaculis rhoncus. Morbi ante nibh, facilisis semper faucibus consequat, facilisis ut ante. Mauris at nisl vitae justo auctor imperdiet. Cras sodales, justo sed tincidunt venenatis, ante erat ultricies eros, at mollis eros lorem ac mi. Fusce sagittis nibh nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec mollis eros sodales convallis faucibus. Vestibulum sit amet odio lectus. Duis eu dolor vitae est venenatis viverra eu sit amet nisl. Aenean vel sagittis odio. Quisque in lacus orci. Etiam ut odio lobortis odio consectetur ornare.</p>
            </div>
          </div>
        </div>
      </div>


    </div>
  </body>

<?php } ?>
<?php require('../template/footer_users.php') ?>