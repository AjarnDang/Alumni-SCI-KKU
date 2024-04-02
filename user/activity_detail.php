<?php   
require('header_user.php');

$id=intval($_GET['nid']);
  if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
   } 
   if(isset($_POST['submit'])) {
      if (!empty($_POST['csrftoken'])) {
         if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
          $name=$_POST['name'];
          $email=$_POST['email'];
          $comment=$_POST['comment'];
          $user_id=$_POST['user_id'];
          $postid=intval($_GET['nid']);
          $query=mysqli_query($conn,"INSERT into event_comments(postId,
                                                                name,
                                                                email,
                                                                user_id,
                                                                comment,
                                                                status)
                                                        values('$postid',
                                                               '$name',
                                                               '$email',
                                                               '$user_id',
                                                               '$comment',
                                                                1)
                                                              ");
       }
     }
   }
?>
<!--Summernote-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<link rel="stylesheet" href="../assets/css/news_ac_detail.css">

    <?php  
        $count = 0;
        $id=intval($_GET['nid']);
        $query=mysqli_query($conn,"SELECT events.PostTitle                              as posttitle,
                                          events.PostImage,events_category.CategoryName     as category,
                                          events_category.id                                  as cid,
                                          event_subcategory.Subcategory                      as subcategory,
                                          events.PostDetails                            as postdetails,
                                          events.PostingDate                            as postingdate,
                                          events.PostUrl                                as url
                                     from events
                                left join events_category    on events_category.id                = events.CategoryId
                                left join event_subcategory on event_subcategory.SubCategoryId  = events.SubCategoryId
                                where events.id='$id'
                                ");   
        $row = mysqli_fetch_array($query);
    ?>
<div id="banner" style="background-image: url('../assets/img/decoration-img/kku-darker.jpg');">
        <div class="container">
            <div class="topic mb-4">
                <div class="text" style="color: white;">
                <h1><?php echo htmlentities($row['posttitle']);?></h1>
                  <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16"><path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/><path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg> 
                    <?php echo htmlentities($row['postingdate']);?>
                  </span> 
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a style="color: white;"  href="activity_category.php?catid=<?php echo htmlentities($row['cid'])?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16"><path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/></svg>
                  <?php echo htmlentities($row['category']);?>, <?php echo htmlentities($row['subcategory']);?>
                </a>
                </div>
            </div>
        </div>
</div>

<div class="container">
      <div class="row ">
        <div class="col-12">
          <div class="nav-point mt-4">
            <a href="home.php">หน้าหลัก</a> >
            <a href="activity.php">กิจกรรม</a> >
            <a class="news_ac_name" href="#"><?php echo htmlentities($row['posttitle']); ?></a>
          </div>
        </div>
      </div>

    <div class="row mt-4">
    <div class="col-md-8">
        <?php 
        $id=intval($_GET['nid']);
        $query=mysqli_query($conn,"SELECT events.PostTitle                              as posttitle,
                                          events.PostImage,events_category.CategoryName as category,
                                          events_category.id                            as cid,
                                          event_subcategory.Subcategory                 as subcategory,
                                          events.PostDetails                            as postdetails,
                                          events.PostingDate                            as postingdate,
                                          events.PostUrl                                as url,
                                          events.start_date                             as start_date,             
                                          events.end_date                               as end_date,
                                          events.start_time                             as start_time,
                                          events.end_time                               as end_time
                                     from events
                                left join events_category    on events_category.id                = events.CategoryId
                                left join event_subcategory on event_subcategory.SubCategoryId  = events.SubCategoryId
                                where events.id='$id'
                                ");                      
        while ($row=mysqli_fetch_array($query)) {
          $postDate = $row['postingdate'];  
          $postdateFormat = date('d M Y', strtotime($postDate));
          $newpostDate = date("d", strtotime($postDate));  
          $newpostMonth = date("n", strtotime($postDate));
          $newpostYear = date("Y", strtotime($postDate));

          $startDate = $row['start_date'];  
          $startdateFormat = date('d M Y', strtotime($startDate));
          $newDate = date("d", strtotime($startDate));  
          $newMonth = date("n", strtotime($startDate));
          $newYear = date("Y", strtotime($startDate));
            
          $endDate = $row['end_date'];
          $enddateFormat = date('d M Y', strtotime($endDate));
          $lastDate = date("d", strtotime($endDate));  
          $lastMonth = date("n", strtotime($endDate));
          $lastYear = date("Y", strtotime($endDate));

          $time = $row['start_time'];
          $newtime = "SELECT convert(char(5), start_time, 108) [time] FROM activity";    
         
          ?>

        <div class="card mb-2">         
          <div class="card-body">
            <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
            <p>
              <b>หมวดหมู่ : </b> <a href="activity_category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a> |
              <b>หมวดหมู่ย่อย : </b><?php echo htmlentities($row['subcategory']);?>
              <b>โพสต์เมื่อ : </b><?php echo date($newpostDate)." ".$month_arr[date($newpostMonth)]." ".(date($newpostYear)+543);?>
            </p><hr />

            <img class="img-fluid rounded"
              src="../admin/dashboard/postimages/<?php echo htmlentities($row['PostImage']);?>"
              alt="<?php echo htmlentities($row['posttitle']);?>" width="100%">

          <div class="datetime mt-3">
            <time datetime="<?php echo $row['start_date']; ?>" class="icon">
                <strong><?php echo $month_arr[date($newMonth)] ?></strong>
                <span><?php echo $newDate ?></span>
            </time>
            <h1><svg xmlns="http://www.w3.org/2000/svg" width="60" height="30" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/></svg></h1>
            <time datetime="<?php echo $row['start_date']; ?>" class="icon">
                <strong><?php echo $month_arr[date($lastMonth)] ?></strong>
                <span><?php echo $lastDate ?></span>
            </time>
            <div class="activity-type ml-4">
                <p><?php echo date($newDate)." ".$month_arr[date($newMonth)]." ".(date($newYear)+543);?> - 
                   <?php echo date($lastDate)." ".$month_arr[date($lastMonth)]." ".(date($lastYear)+543);?>
                <?php if($time = '00:00:00') {
                  echo ""; 
                } else {?>
                  <p>เริ่มตั้งแต่ <?php echo $time ?></p>
                <?php } ?>
            </div>
          </div>

            <p class="card-text"><?php $pt=$row['postdetails']; echo (substr($pt,0));?></p>
          </div>

        </div>
          <?php } ?>
      </div>

<div class="col-md-4">
<!-- Categories Widget -->
<div class="card">
  <h5 class="card-header">หมวดหมู่</h5>
  <div class="card-body">

    <div class="row">
      <div class="col-lg-12">
        <ul class="list-unstyled mb-0">
        <?php 
        $query=mysqli_query($conn,"SELECT id,CategoryName from events_category");
        while($row=mysqli_fetch_array($query)) { 
          ?>
          <li><a href="activity_category.php?catid=<?php echo htmlentities($row['id'])?>">
              <?php echo htmlentities($row['CategoryName']);?>
            </a>
          </li>
        <?php } ?>
        </ul>
      </div>
    </div>

  </div>
</div>

<!-- Side Widget -->
<div class="card my-4">
  <h5 class="card-header">กิจกรรมที่เกี่ยวข้อง</h5>
  <div class="card-body">
    <ul class="mb-0 list-group">
    <?php
          $query=mysqli_query($conn,"SELECT events.id        as pid,
                                            events.PostTitle as posttitle
                                       from events
                                  left join events_category    on events_category.id=events.CategoryId
                                  left join event_subcategory on  event_subcategory.SubCategoryId=events.SubCategoryId
                                  ORDER BY RAND() LIMIT 8
                                      ");
          while ($row=mysqli_fetch_array($query)) { ?>
            <li><a href="news_ac_detail.php?nid=<?php echo htmlentities($row['pid'])?>">
                <?php echo htmlentities($row['posttitle']);?></a>
            </li>
            <hr>
    <?php } ?>
    </ul>
  </div>
</div>

</div>

    </div>


    <div class="row">
<div class="col-md-8">

<!---News Display Section --->
<div class="card my-4">
  <h5 class="card-header">แสดงความคิดเห็น</h5>
  <div class="card-body">
    <form name="Comment" method="post">
      <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>"/>
      <input type="hidden" name="name" value="<?php echo htmlentities($_SESSION['username']); ?>">
      <input type="hidden" name="email" value="<?php echo htmlentities($_SESSION['email']); ?>">
      <input type="hidden" name="user_id" value="<?php echo htmlentities($_SESSION['userid']); ?>">
      
      <div class="form-group">
        <textarea class="form-control" name="comment" rows="3" placeholder="แสดงความคิดเห็นของคุณที่นี่" required></textarea>
      </div>
              
      <button type="submit" class="btn btn-warning text-black border-0" name="submit">ยืนยัน</button>
    </form>
  </div>
</div>


<?php 
$comment=mysqli_query($conn,"SELECT event_comments.id          as comment_id,
                                    event_comments.postId      as postId,
                                    event_comments.user_id     as user_id,
                                    event_comments.name        as name,
                                    event_comments.email       as email,
                                    event_comments.comment     as comment,
                                    event_comments.postingDate as postingDate,
                                    event_comments.status      as status,
                                    user.id                       as id
                               from event_comments
                               join user on user.id = event_comments.user_id 
                              where postId='$id' 
                                and event_comments.status = 1
                            ");
$rowcount=mysqli_num_rows($comment); 
      if($rowcount==0) {
        echo ""; 
      } else { ?>
      <div class="comment-header"><h3>ความคิดเห็น</h3></div>
      <?php 
      while ($row=mysqli_fetch_array($comment)) { ?>     
      <div class="media my-2 p-3">
          <div class="media-body">
            <div class="d-flex justify-content-between">
             <div><p class="mt-0 font-weight-bold">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/></svg>
                <?php echo ($row['name']);?> • <?php echo ($row['postingDate']);?>
              </p>
             </div>
             <?php if($_SESSION['userid'] == $row['user_id']) { ?>
             <div class="d-flex justify-content-between float-right">

                <div>
                  <button type="button" class="bg-transparent border-0 w-100 rounded" data-toggle="modal" 
                      data-target="#exampleModalCenter<?php echo $row['comment_id'] ?>">
                      แก้ใข
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModalCenter<?php echo $row['comment_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle<?php echo ($row['comment_id']);?>" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title mt-0" id="exampleModalLongTitle">
                                      แก้ใขความคิดเห็น
                                  </h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <form method="POST" action="activity_editdelete_comment.php" enctype="multipart/form-data">  
                                <div class="modal-body">                                 
                                    <?php
                                    $edit=mysqli_query($conn,"SELECT * from event_comments 
                                                              where id='".$row['comment_id']."'");
                                    $erow=mysqli_fetch_array($edit); ?>               
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <input type="hidden" name="id" value="<?php echo $erow['id']; ?>">
                                      <input type="hidden" name="nid" value="<?php echo intval($_GET['nid']); ?>">
                                      <textarea name="comment" class="form-control" rows="7"><?php echo $erow['comment']; ?></textarea>
                                    </div>
                                  </div>                                                       
                                </div>
                                <div class="modal-footer">
                                  <button type="button" data-dismiss="modal" class="btn btn-secondary">ยกเลิก</button>
                                  <button type="submit" name="edit_comment" class="btn btn-success">ยืนยัน</button>
                                </div>
                              </form>    
                          </div>
                      </div>
                  </div>
                </div>

                <span class="px-2"> | </span>

                <div>
                  <a href="#del<?php echo $row['comment_id']; ?>" data-toggle="modal" class="text-black">ลบ</a>
                    <div class="modal fade" id="del<?php echo $row['comment_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="myModalLabel">ลบความคิดเห็น</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>
                              <form method="POST" action="activity_editdelete_comment.php" enctype="multipart/form-data">  
                                <div class="modal-body">                                 
                                    <?php
                                    $delete=mysqli_query($conn,"SELECT * from event_comments 
                                                              where id='".$row['comment_id']."'");
                                    $drow=mysqli_fetch_array($delete); ?>               
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <input type="hidden" name="id" value="<?php echo $drow['id']; ?>">
                                      <input type="hidden" name="nid" value="<?php echo intval($_GET['nid']); ?>">
                                      <h5 class="text-center">ยืนยันการลบข้อมูล [<?php echo $drow['id']; ?>]</h5>
                                    </div>
                                  </div>                                                       
                                </div>
                                <div class="modal-footer">
                                  <button type="button" data-dismiss="modal" class="btn btn-secondary" >ยกเลิก</button>
                                  <button type="submit" name="delete_comment" class="btn btn-success">ยืนยัน</button>
                                </div>
                              </form>
                          </div>
                      </div>
                    </div> 
                </div> 

             </div>
             <?php } elseif($_SESSION['userlevel'] == 'admin') { ?>
              <div>
              <button class="btn dropdown-toggle text-black w-50 bg-transparent border-0" type="button" id="editpostdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/></svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="editpostdropdown">
                  <a class="dropdown-item" href="#">ลบความคิดเห็น</a>
                </div>
              </div>   
            <?php } ?>
            </div>
              
              <p class="p-0"><?php echo ($row['comment']);?></p>
          </div>
      </div>
    <?php 
    } 
  } 
  ?>
    
  </div>
</div>
      
        
      <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
      fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your share button code -->
      <div class="fb-share-button mt-3" 
      data-href="https://www.your-domain.com/your-page.html" 
      data-layout="button_count">
      </div>

    </div>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<?php require('../template/footer_users.php') ?>