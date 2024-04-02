<?php 
include('../db/connection.php');

if(isset($_POST['edit_comment'])) {
   $comment_id = $_POST['id'];
   $nid = $_POST['nid'];
   $comment = $_POST['comment'];     
   $query=mysqli_query($conn,"UPDATE community_comment 
                                 SET comment = '$comment'
                               where id='$comment_id'
                       ");
} header("location:community_detail.php?nid=$nid");

?>