<?php 
  include('template/header.php');
  
?>
  <link rel="stylesheet" href="assets/css/home.css">
  
  <link rel="stylesheet" href="assets/css/css-carousel-9/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/css-carousel-9/owl.theme.default.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
	<link rel="stylesheet" href="assets/css/css-carousel-9/style.css">

  
  <section class="ftco-section">
			<div class="row">
			<div class="col-md-12">
				<div class="hero featured-carousel owl-carousel">
        <?php
            $query = "SELECT * FROM tb_slider ORDER BY id DESC";
            $result = mysqli_query($conn, $query);
            $i = 0;
            foreach ($result as $row) {
              $actives = '';
              if ($i == 0) {
                $actives = 'active';
              }
          ?>
					<div class="item">
						<div class="work">
              <div class="img d-flex align-items-center justify-content-center" 
							style="background-image: url(assets/img/slider/<?php echo $row['slider']; ?>);"></div>
						</div>
					</div>
          <?php $i++; } ?>
				</div>
			</div>
			</div>
		</section>
            

<div class="container">
  <div class="slogan">
    <div class="text_slogan"><strong>
      วิทยา 56 ปี<br>
      "คณะวิทยาศาสตร์ชั้นนำในระดับอาเซียน<br>
      ด้านการผลิตบัณฑิตและการวิจัย"<br>
    </strong></div>
  </div>
  

  <div class="function">
  <div class="row">
    <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="image-box">
        <a href="hall_of_fame.php">
        <img src="assets/img/fun-button/1.png" alt=""/>
        <div class="topic-box">
          รางวัลเกียรติยศ<br>ความภาคภูมิใจชาววิทยา</div>
        <div class="sub-topic-box">
           เรียนรู้เพิ่มเติม 
           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
        </div>
        </a>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="image-box">
        <a href="">
        <img src="assets/img/fun-button/1.png" alt=""/>
        <div class="topic-box">กิจกรรมสัมพันธ์<br>รำลึกถึงพี่น้องชาววิทยา</div>
        <div class="sub-topic-box">
           ดูกิจกรรมเพิ่มเติม 
           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
        </div>
        </a>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="image-box">
        <a href="normal_user/donate_page.php">
        <img src="assets/img/fun-button/1.png" alt=""/>
        <div class="topic-box">บริจาคเงินทุน<br>เพื่อสนับสนุนนักศึกษา</div>
        <div class="sub-topic-box">
           เรียนรู้เพิ่มเติม 
           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
        </div>
          </a>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-lg-3">
      <div class="image-box">
        <a href="">
        <img src="assets/img/fun-button/1.png" alt=""/>
        <div class="topic-box">ของที่ระลึก<br>สินค้าคุณภาพเพื่อคุณ</div>
        <div class="sub-topic-box">
           เรียนรู้เพิ่มเติม 
           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
        </div>
           </a>
      </div>
    </div>

  </div>
  </div>

</div>



<div class="highlight">
  <div class="container">
    <div class="row">
    <?php
            $count1 = 0;
            $sql = "SELECT  tblposts.id                                  as pid,
                            tblposts.PostTitle                           as posttitle,
                            tblposts.PostImage,tblcategory.CategoryName  as category,
                            tblcategory.id                               as cid,
                            tblsubcategory.Subcategory                   as subcategory,
                            tblposts.PostDetails                         as postdetails,
                            tblposts.PostingDate                         as postingdate,
                            tblposts.PostUrl                             as url
                       from tblposts
                  left join tblcategory    on tblcategory.id               = tblposts.CategoryId
                  left join tblsubcategory on tblsubcategory.SubCategoryId = tblposts.SubCategoryId 
                      WHERE tblcategory.CategoryName = 'ข่าวเด่น' 
                        and tblposts.CategoryId = 13
                      ORDER BY RAND() LIMIT 1";
                      
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)) { 
              if($count1 == 1){
                break;
              }               
        ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="topic-highlight"><strong>ไฮไลท์
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
        <path d="M0 8a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2H1a1 1 0 0 1-1-1z"/>
        </svg></strong></div>
    </div>

      <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 mt-2">
        <div class="highligh-1">
          <img src="admin/dashboard/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="">
        </div>
      </div>
      <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 mt-2">
        <div class="highligh-2">
          <div class="topic-highlight-2"><?php echo $row['posttitle']; ?></div>
          <div class="detail-highlight-2"><?php echo $row['postdetails'] ?></div>
          <br>
        </div>
      </div>
    
      <div class="see-more mt-5">
      <a href="news_ac_detail.php?nid=<?php echo htmlentities($row['pid'])?>" class="hvr-underline-from-right">ดูเพิ่มเติม <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
          </svg>
      </a>
      </div>
        <?php $count1++; } ?>
      </div>
  </div>
</div>


<div class="image-background" style="background-image: url('assets/img/decoration-img/kku.jpg');"></div>


  <div class="new-background">
  <div class="container">
    <div class="news">
      
      <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12"> 
        <div class="news-header"><strong>กิจกรรมและข่าวสาร <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-lg" viewBox="0 0 16 16">
          <path d="M0 8a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2H1a1 1 0 0 1-1-1z"/>
          </svg></strong></div>
      </div>

      <div class="row">
            <?php
            $count1 = 0;
            $sql = "SELECT  tblposts.id                                  as pid,
                            tblposts.PostTitle                           as posttitle,
                            tblposts.PostImage,tblcategory.CategoryName  as category,
                            tblcategory.id                               as cid,
                            tblsubcategory.Subcategory                   as subcategory,
                            tblposts.PostDetails                         as postdetails,
                            tblposts.PostingDate                         as postingdate,
                            tblposts.PostUrl                             as url
                       from tblposts
                  left join tblcategory     on tblcategory.id=tblposts.CategoryId
                  left join tblsubcategory  on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId                            
                  ORDER BY RAND() LIMIT 8";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)) { ?>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
        <div class="news-element">
                <a href="news_ac_detail.php?nid=<?php echo htmlentities($row['pid'])?>">
                  <img class="news-image" src="admin/dashboard/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>"/>
                </a>
                <div class="news-detail">
                  <div class="bg">
                  <div class="news-topic">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/></svg>
                    <a style="color:lightslategray;" href="news_ac_detail.php?nid=<?php echo htmlentities($row['pid'])?>"><?php echo htmlentities($row['postingdate']);?></a><br>
                    <a href="news_ac_detail.php?nid=<?php echo htmlentities($row['pid'])?>"><?php echo htmlentities($row['posttitle']);?></a>
                  </div>
                  </div>

                    <hr class="news-hr">

                  <span class="read-more"><a href="news_ac_detail.php?nid=<?php echo htmlentities($row['pid'])?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16"><path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/></svg>
                      <a href="news_ac_category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a>
                    <div class="right-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg></div></a>
                  </span>

                </div>
        </div>
        </div>
        <?php $count1++; } ?>
    </div>


      <div class="see-more">
        <a href="news_ac.php">ดูเพิ่มเติม <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
        </svg></a>
      </div>

      </div>
    </div>
  </div>
</div>





<script src="assets/js/js-carousel-9/jquery.min.js"></script>
<script src="assets/js/js-carousel-9/popper.js"></script>
<script src="assets/js/js-carousel-9/bootstrap.min.js"></script>
<script src="assets/js/js-carousel-9/owl.carousel.min.js"></script>
<script src="assets/js/js-carousel-9/main.js"></script>

<?php include('template/footer.php') ?>
