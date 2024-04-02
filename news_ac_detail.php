<?php 
require('template/header.php');

  if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
   }
   
   if(isset($_POST['submit'])) {
     //Verifying CSRF Token
     if (!empty($_POST['csrftoken'])) {
         if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
           $name=$_POST['name'];
           $email=$_POST['email'];
           $comment=$_POST['comment'];
           $postid=intval($_GET['nid']);
           $st1='0';
           $query=mysqli_query($conn,"INSERT into tblcomments(postId,
                                                             name,
                                                             email,
                                                             comment,
                                                             status)
                                                     values('$postid',
                                                           '$name',
                                                           '$email',
                                                           '$comment',
                                                           '$st1')
                                                           ");
           if($query):
                  echo "<script>
                         alert('แสดงคิดเห็นสำเร็จ โปรดรอการอนุมัติความคิดเห็นของคุณจากผู้ดูแลระบบ ');
                       </script>";
                  unset($_SESSION['token']);
           else : echo "<script>
                         alert('มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง');
                       </script>";  
           endif;
       }
     }
   }
  
?>

<link rel="stylesheet" href="assets/css/news_ac_detail.css">

    <?php  
        $count = 0;
        $id=intval($_GET['nid']);
        $query=mysqli_query($conn,"SELECT tblposts.PostTitle                              as posttitle,
                                          tblposts.PostImage,tblcategory.CategoryName     as category,
                                          tblcategory.id                                  as cid,
                                          tblsubcategory.Subcategory                      as subcategory,
                                          tblposts.PostDetails                            as postdetails,
                                          tblposts.PostingDate                            as postingdate,
                                          tblposts.PostUrl                                as url
                                     from tblposts
                                left join tblcategory    on tblcategory.id                = tblposts.CategoryId
                                left join tblsubcategory on tblsubcategory.SubCategoryId  = tblposts.SubCategoryId
                                where tblposts.id='$id'
                                ");   
        $row = mysqli_fetch_array($query);
    ?>
<div id="banner" style="background-image: url('assets/img/decoration-img/kku-darker.jpg');">
        <div class="container">
            <div class="topic mb-4">
                <div class="text" style="color: white;">
                <h1><?php echo htmlentities($row['posttitle']);?></h1>
                  <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16"><path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/><path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg> 
                    <?php echo htmlentities($row['postingdate']);?>
                  </span> 
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a style="color: white;"  href="news_ac_category.php?catid=<?php echo htmlentities($row['cid'])?>">
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
            <a href="news_ac.php">ข่าวสาร</a> >
            <a class="news_ac_name" href="#"><?php echo htmlentities($row['posttitle']); ?></a>
          </div>
        </div>
      </div>

    <div class="row mt-4" >
        <div class="col-md-8">
        <?php 
        $id=intval($_GET['nid']);
        $query=mysqli_query($conn,"SELECT tblposts.PostTitle                              as posttitle,
                                          tblposts.PostImage,tblcategory.CategoryName     as category,
                                          tblcategory.id                                  as cid,
                                          tblsubcategory.Subcategory                      as subcategory,
                                          tblposts.PostDetails                            as postdetails,
                                          tblposts.PostingDate                            as postingdate,
                                          tblposts.PostUrl                                as url
                                     from tblposts
                                left join tblcategory    on tblcategory.id                = tblposts.CategoryId
                                left join tblsubcategory on tblsubcategory.SubCategoryId  = tblposts.SubCategoryId
                                where tblposts.id='$id'
                                ");   
        while ($row=mysqli_fetch_array($query)) { 
          $startDate = $row['postingdate'];  
          $startdateFormat = date('d M Y', strtotime($startDate));
          $newDate = date("d", strtotime($startDate));  
          $newMonth = date("n", strtotime($startDate));
          $newYear = date("Y", strtotime($startDate));
        ?>
        <div class="card mb-2">          
          <div class="card-body">
            <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
            <p><b>หมวดหมู่ : </b> <a href="news_ac_category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a> |
               <b>หมวดหมู่ย่อย : </b><?php echo htmlentities($row['subcategory']);?>
               <b>โพสต์เมื่อ : </b><?php echo date($newDate)." ".$month_arr[date($newMonth)]." ".(date($newYear)+543);?></p>
              <hr />
            <img class="img-fluid rounded"
              src="admin/dashboard/postimages/<?php echo htmlentities($row['PostImage']);?>"
              alt="<?php echo htmlentities($row['posttitle']);?>" width="100%">

            <div class="card-text w-100 pt-4">
              <?php $pt=$row['postdetails']; echo (substr($pt,0));?>
            </div>

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
      $query=mysqli_query($conn,"SELECT id,CategoryName from tblcategory");
      while($row=mysqli_fetch_array($query)) { 
        ?>
        <li><a href="news_ac_category.php?catid=<?php echo htmlentities($row['id'])?>">
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
<h5 class="card-header">ข่าวที่เกี่ยวข้อง</h5>
<div class="card-body">
  <ul class="mb-0 list-group">
  <?php
        $query=mysqli_query($conn,"SELECT tblposts.id        as pid,
                                          tblposts.PostTitle as posttitle
                                     from tblposts
                                left join tblcategory    on tblcategory.id=tblposts.CategoryId
                                left join tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId
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
      <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />

        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="ชื่อ-สกุล" required>
        </div>

        <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="ิอีเมล" required>
        </div>

        <div class="form-group">
          <textarea class="form-control" name="comment" rows="3" placeholder="แสดงความคิดเห็น" required></textarea>
        </div>
                
        <button type="submit" class="btn btn-primary text-black border-0" name="submit">ยืนยัน</button>
      </form>
  </div>
</div>



<?php 
    $sts=1;
    $query=mysqli_query($conn,"SELECT name,comment,postingDate
                                from tblcomments
                                where postId='$id' 
                                and status='$sts'
                                ");
    $rowcount=mysqli_num_rows($query); 
    if($rowcount==0) {
      echo ""; 
    } else { ?> 
    <div class="comment-header"><h3>ความคิดเห็น</h3></div>                        
    <?php 
    while ($row=mysqli_fetch_array($query)) {?>
    <div class="media my-2 p-3">
        <div class="media-body">
            <h5 class="mt-0"><?php echo htmlentities($row['name']);?> &nbsp;-&nbsp; 
              <span style="font-size:11px;"><b>At : </b> <?php echo htmlentities($row['postingDate']);?></span>
            </h5>
            <p class="p-0"><?php echo htmlentities($row['comment']);?></p>
        </div>
    </div>
  <?php } } ?>

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
<?php require('template/footer.php') ?>