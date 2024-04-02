<?php 
include('../db/connection.php');

if(isset($_POST['edit_comment'])) {
   $comment_id = $_POST['id'];
   $nid = $_POST['nid'];
   $comment = $_POST['comment'];     
   $query=mysqli_query($conn,"UPDATE event_comments 
                                 SET comment = '$comment'
                               where id='$comment_id'
                       ");
} header("location:activity_detail.php?nid=$nid");

if (isset($_POST['delete_comment'])) {
  $comment_id = $_POST['id'];
  $nid = $_POST['nid'];
  $query = mysqli_query($conn,"DELETE from event_comments
                               where id='$comment_id'
                              ");
}
header("location:activity_detail.php?nid=$nid");
?>