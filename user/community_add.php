<?php
include('../db/connection.php');
if(isset($_POST['submit'])) {
    $posttitle=$_POST['posttitle'];
    $catid=($_POST['category']);
    $postdetails=$_POST['postdescription'];
    $arr = explode(" ",$posttitle);
    $url=implode("-",$arr);
    $user_id=$_POST['user_id'];

    $imgfile=$_FILES["postimage"]["name"];

   // get the image extension
    if(!empty($imgfile)) {
        $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");
    if(!in_array($extension,$allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {           
        $imgnewfile=md5($imgfile).$extension;
        move_uploaded_file($_FILES["postimage"]["tmp_name"],"../admin/dashboard/postimages/".$imgnewfile);
            $status=1;
            $query=mysqli_query($conn,"INSERT into community_topic(PostTitle,
                                                                CategoryId,                                                                 
                                                                PostDetails,
                                                                PostUrl,
                                                                Is_Active,
                                                                PostImage,
                                                                user_id
                                                                )
                                                            values('$posttitle',
                                                                '$catid',
                                                                '$postdetails',
                                                                '$url',
                                                                '$status',
                                                                '$imgnewfile',
                                                                '$user_id'
                                                                )");                                                                                                           
            if($query) {
                $msg="เพิ่มหัวข้อสำเร็จ!";
            } else {
                $error="มีบางอย่างผิดพลาด! ไม่สามารถเพิ่มหัวข้อได้.";    
            } 
        }
    } else {
        $status=1;
        $query=mysqli_query($conn,"INSERT into community_topic(PostTitle,
                                                                CategoryId,                                                                 
                                                                PostDetails,
                                                                PostUrl,
                                                                Is_Active,
                                                                user_id
                                                                )
                                                            values('$posttitle',
                                                                '$catid',
                                                                '$postdetails',
                                                                '$url',
                                                                '$status',
                                                                '$user_id'
                                                                )");                                                                                                           
            if($query) {
                $msg="เพิ่มหัวข้อสำเร็จ!";
            } else {
                $error="มีบางอย่างผิดพลาด! ไม่สามารถเพิ่มหัวข้อได้.";    
            }
    }
    header('location:community_addpost.php');
}
