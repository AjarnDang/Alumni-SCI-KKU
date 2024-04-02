
<?php 
require('../template/header_user.php');
require_once('../template/pagination_function.php');
if($_GET['catid']!=''){
  $_SESSION['catid']=intval($_GET['catid']);
}
?>
<link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css" >
<link rel="stylesheet" href="../assets/css/news_ac.css">
     

<div class="new-background">
<div id="banner" style="background-image: url('../assets/img/decoration-img/kku-darker.jpg');">
        <div class="container">
            <div class="topic">
                <!--<h1>&lt;GTCoding/&gt;</h1>-->    
                <h1 style="color:white;"><b>ประเภทข่าวสาร</b></h1>               
            </div>
        </div>
    </div>
  </div>
<div class="container">
  <?php 
   $sql =  "SELECT  tblposts.id                                 as pid,
                    tblcategory.id                              as cid,
                    tblposts.PostTitle                          as posttitle,
                    tblposts.PostImage,tblcategory.CategoryName as category,
                    tblsubcategory.Subcategory                  as subcategory,
                    tblposts.PostDetails                        as postdetails,
                    tblposts.PostingDate                        as postingdate,
                    tblposts.PostUrl                            as url
               from tblposts
          left join tblcategory    on tblcategory.id=tblposts.CategoryId
          left join tblsubcategory on tblsubcategory.SubCategoryId=tblposts.SubCategoryId
              where tblposts.CategoryId='".$_SESSION['catid']."'
                  "; 
    $result=$conn->query($sql);
    $row = $result->fetch_assoc()
  ?>
  <div class="nav-point mt-4">
    <a href="home.php">หน้าหลัก</a> >
    <a href="news_ac.php">ข่าวสาร</a> >
    <a href="#"><?php echo htmlentities($row['category']);?></a>
  </div>
<div class="news mt-4">
    <div class="row">
    <?php
        $num = 0;
        $sql =  "SELECT tblposts.id                                 as pid,
                        tblcategory.id                              as cid,
                        tblposts.PostTitle                          as posttitle,
                        tblposts.PostImage,tblcategory.CategoryName as category,
                        tblsubcategory.Subcategory                  as subcategory,
                        tblposts.PostDetails                        as postdetails,
                        tblposts.PostingDate                        as postingdate,
                        tblposts.PostUrl                            as url
                   from tblposts
              left join tblcategory    on tblcategory.id=tblposts.CategoryId
              left join tblsubcategory on tblsubcategory.SubCategoryId=tblposts.SubCategoryId
                  where tblposts.CategoryId='".$_SESSION['catid']."'
                        ";  
        $result=$conn->query($sql);
        $total=$result->num_rows;
        
        $e_page = 16; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
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
        $sql.="ORDER BY tblposts.id desc LIMIT ".$s_page.",$e_page";
        $result=$conn->query($sql);
        
        
        if($result && $result->num_rows>0){  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
            
            $rowcount=mysqli_num_rows($result);
            if($rowcount==!0) {

            while($row = $result->fetch_assoc()) { // วนลูปแสดงรายการ
                $num++;
                $startDate = $row['postingdate'];  
                $startdateFormat = date('d M Y', strtotime($startDate));
                $newDate = date("d", strtotime($startDate));  
                $newMonth = date("n", strtotime($startDate));
                $newYear = date("Y", strtotime($startDate));
        ?>

            <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="news-element">
                <a href="news_ac_detail.php?nid=<?php echo htmlentities($row['pid'])?>">
                  <img class="news-image" src="../admin/dashboard/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>"/>
                </a>
                <div class="news-detail">
                  <div class="bg">
                  <div class="news-topic">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/></svg>
                    <a style="color:lightslategray;" href="news_ac_detail.php?nid=<?php echo htmlentities($row['pid'])?>">
                      <?php echo date($newDate)." ".$month_arr[date($newMonth)]." ".(date($newYear)+543); ?>
                    </a><br>
                    <a href="news_ac_detail.php?nid=<?php echo htmlentities($row['pid'])?>"><?php echo htmlentities($row['posttitle']);?></a>
                  </div>
                  </div>

                    <hr class="news-hr">

                  <span class="read-more"><a href="news_ac_detail.php?nid=<?php echo htmlentities($row['pid'])?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16"><path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/></svg>
                      <a href="news_ac_category.php?catid=<?php echo htmlentities($row['cid'])?>">
                        <?php echo htmlentities($row['category']);?>
                      </a>
                    <div class="right-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg></div></a>
                  </span>

                </div>
            </div>
            </div>
            
        <?php
            }   
        } else { echo "<p class='text-center'>ไม่พบข้อมูลในระบบ</p>";
    }
  }
      ?>
    </div>
</div>
<div style="height: 1em;"></div>
<?php page_navi($total,(isset($_GET['page']))?$_GET['page']:1,$e_page);?>
</div>


<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
<?php require('../template/footer_users.php') ?>