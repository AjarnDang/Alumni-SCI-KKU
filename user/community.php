<?php 
require('../template/header_user.php');
require_once('../template/pagination_function.php');
error_reporting(0);
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
?>
<link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css" >
<link rel="stylesheet" href="../assets/css/community.css">

<div class="new-background">
<div id="banner" style="background-image: url('../assets/img/decoration-img/kku-darker.jpg');">
        <div class="container">
            <div class="topic">
                <!--<h1>&lt;GTCoding/&gt;</h1>-->    
                <h1 style="color:white;"><b>คอมมูนิตี้</b></h1>               
            </div>
        </div>
    </div>
  </div>
<div class="container">
  
  <div class="row mt-4">
      <div class="col-lg-9 col-sm-12">
        <div class="nav-point">
          <a class="text-black" href="home.php">หน้าหลัก</a> >
          <a class="text-black" href="community.php">คอมมูนิตี้</a>
        </div>
      </div>
      <div class="col-lg-3 col-sm-12">
        <a class="btn text-black border-0 w-100 py-3" href="community_addpost.php">โพสต์หัวข้อ</a>
      </div>
  </div>
 
<div class="news mt-4">
    <div class="row">
      <div class="col-lg-9 col-sm-12">
        <?php 
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
              $num++;

              $startDate = $row['PostingDate'];  
              $startdateFormat = date('d M Y', strtotime($startDate));
              $newDate = date("d", strtotime($startDate));  
              $newMonth = date("n", strtotime($startDate));
              $newYear = date("Y", strtotime($startDate));
        ?>           
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
                    <a href="news_ac_detail.php?nid=<?php echo htmlentities($row['id'])?>">
                    <?php if ($row['PostImage'] != '') { ?>
                      <img class="news-image rounded" width="100" src="../admin/dashboard/postimages/<?php echo htmlentities($row['PostImage']);?>" //>
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
                     
        <?php } ?> 
        <div style="height: 1em;"></div>
        <?php page_navi($total,(isset($_GET['page']))?$_GET['page']:1,$e_page);?>     
      </div>
      <div class="col-lg-3">
      <?php 
      $query=mysqli_query($conn,"SELECT * from community_category");
      while($row=mysqli_fetch_array($query)) {  ?>
      <a href="community_category.php?catid=<?php echo htmlentities($row['id'])?>" class="text-black" >
      <div class="rightside-card card mb-3">
          <div class="card-body">
              <div class="row">
                  <div class="col-lg-12">
                  <ul class="list-unstyled mb-0">
                      <li><?php echo htmlentities($row['CategoryName']);?></li>                
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      </a>
      <?php } } ?>    
    </div>
  </div>
</div>
</div>

<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
<?php require('../template/footer_users.php') ?>