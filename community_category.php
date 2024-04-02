<?php 
include('template/header.php'); 
require_once('template/pagination_function.php');
?>
<link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css" >
<link rel="stylesheet" href="assets/css/news_ac.css">
<body>
<div class="new-background">
  <div id="banner" style="background-image: url('assets/img/decoration-img/kku-darker.jpg');">
        <div class="container">
            <div class="topic">
                <!--<h1>&lt;GTCoding/&gt;</h1>-->    
                <h1 style="color:white;"><b>ประเภทคอมมูนิตี้</b></h1>               
            </div>
        </div>
    </div>
  </div>
<div class="container">

  <div class="nav-point mt-4">
    <a href="home.php">หน้าหลัก</a> >
    <a href="community.php">คอมมูนิตี้</a> >
    <a href="#">หมวดหมู่คอมมูนิตี้</a>
  </div>

  <div class="news mt-4">
      <div class="row">
      <?php   
              if($_GET['catid']!=''){
                $_SESSION['catid']=intval($_GET['catid']);
              }
              $tag = $conn->query("SELECT * FROM community_category order by CategoryName asc");            
                while($row= $tag->fetch_assoc()) {
                  $tags[$row['id']] = $row['CategoryName'];
                }
              $topic = $conn->query("SELECT community_topic.id,
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
                                      where community_topic.CategoryId='".$_SESSION['catid']."'
                                      ");  
              $rowcount=mysqli_num_rows($topic);
              if($rowcount ==! 0) {                        
                while($row = $topic->fetch_assoc()) { 
                  $view =    $conn->query("SELECT * FROM community_forum_view where topic_id=".$row['id'])->num_rows;
                  $comment = $conn->query("SELECT * FROM community_comment    where postId=".$row['id'])->num_rows;
                  $reply =   $conn->query("SELECT * FROM community_reply      where comment_id in (SELECT id FROM community_comment where postId=".$row['id'].")")->num_rows;
                  
                  $startDate = $row['PostingDate'];  
                  $startdateFormat = date('d M Y', strtotime($startDate));
                  $newDate = date("d", strtotime($startDate));  
                  $newMonth = date("n", strtotime($startDate));
                  $newYear = date("Y", strtotime($startDate));
              ?>
              <div class="col-lg-9 col-sm-12">
                <div class="card bg-light mb-3">
                  <div class="card-body">

                  <div class="d-flex justify-content-between">
                    <div class="news-topic">
                      <h3 class="px-0 mx-0"><a class="text-black" href="community_detail.php?nid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['PostTitle']);?></a></h3>
                      โพสต์โดย : <a class="text-secondary" href=""><?php echo htmlentities($row['username'])?></a> 
                      เมื่อ : <a class="text-secondary" href="community_detail.php?nid=<?php echo htmlentities($row['id'])?>">
                              <?php echo date($newDate)." ".$month_arr[date($newMonth)]." ".(date($newYear)+543); ?>
                            </a>               
                    </div>
                    <div>
                    <?php if ($row['PostImage'] != '') { ?>
                      <img class="news-image rounded" width="100" src="admin/dashboard/postimages/<?php echo htmlentities($row['PostImage']);?>" //>
                    <?php } else {
                        echo '';
                      }?>
                    </div>     
                  </div>

                  <div class="d-flex justify-content-between mt-3">
                    <div><span class="category bg-light border border-secondary rounded px-4 py-2">
                      <a class="text-black" href="community_detail.php?nid=<?php echo htmlentities($row['id'])?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16"><path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/></svg>
                        <?php foreach(explode(",",$row['CategoryId']) as $cat) { ?>
                          <span><?php echo $tags[$cat] ?></span>
                        <?php } ?>
                      </a>
                      </span>
                    </div>
                    <div>
                      <span class="bg-light py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16"><path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/><path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/></svg> 
                        <?php echo number_format($view) ?> คอมเมนต์</span>
                    </div>
                  </div>

                </div>
                </div>
              </div>              
          <?php } } else { ?>
              <p class='text-center'>ไม่พบโพสต์ในหมวดหมู่นี้</p>
          <?php } ?>
      </div>
      
  </div>

</div>



<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>   
</body>
<?php include('template/footer.php'); ?>