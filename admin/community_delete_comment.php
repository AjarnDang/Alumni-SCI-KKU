<?php
include('../db/connection.php');

if (isset($_POST['delete_comment'])) {
    $comment_id = $_POST['id'];
    $nid = $_POST['nid'];
    $query = mysqli_query($conn,"DELETE from community_comment
                                 where id='$comment_id'
                                ");
}
header("location:community_detail.php?nid=$nid");

?>