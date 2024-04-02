<div class="col-md-4">
<!-- Search Widget -->
<div class="card mb-4">
  <h5 class="card-header">หัวข้อที่เกี่ยวข้อง</h5>
  <div class="card-body">
    <ul class="mb-0 list-group">
    <?php
          $query=mysqli_query($conn,"SELECT community_topic.id        as pid,
                                            community_topic.PostTitle as posttitle
                                       from community_topic
                                  left join community_category on community_category.id = community_topic.CategoryId
                                  ORDER BY RAND() LIMIT 8
                                      ");
          while ($row=mysqli_fetch_array($query)) { ?>
            <li><a href="community_detail.php?nid=<?php echo htmlentities($row['pid'])?>">
                <?php echo htmlentities($row['posttitle']);?></a>
            </li>
            <hr>
    <?php } ?>
    </ul>
  </div>
  </div>
</div>



