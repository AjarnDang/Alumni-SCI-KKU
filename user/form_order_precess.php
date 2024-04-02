<?php
include('../db/connection.php');
if(isset($_POST['save'])) {
    $nameuser       =$_POST['nameuser'];
    $email          =$_POST['email'];
    $tel            =$_POST['tel'];
    $addresss       =$_POST['addresss'];
    $code           =$_POST['code'];
    $productName    =$_POST['productName'];
    $quantity       =$_POST['quantity'];
    $totalprice     =$_POST['totalprice'];
    $price          =$_POST['price'];

$file = pathinfo(basename($_FILES['Picture']['name']), PATHINFO_EXTENSION);
if($file != ""){
    $new_image = 'Picture'. uniqid(). "." . $file;
    $image_path = "";
    $upload_path = $image_path . "../admin/dashboard/postimages/" . $new_image;
    $upload = move_uploaded_file($_FILES['Picture']['tmp_name'], $upload_path);
    if ($upload == FALSE){
        echo "ไม่สามารถอัพโหลดได้";
        exit();
    }
    $pro_image = $new_image;
    $pic = "" . $pro_image;
    } else {
        $pic = "./postimages"; 
    }

    $sql="INSERT INTO orders(username,
                             email,
                             tel,
                             addresss,
                             Picture,
                             productName,
                             totalprice,
                             code,
                             quantity,
                             price
                            ) 
                   VALUES ('$nameuser',
                           '$email',
                           '$tel',
                           '$addresss',
                           '$pic',
                           '$productName',
                           '$totalprice',
                           '$code',
                           '$quantity',
                           '$price'
                            )";
    if (!mysqli_query($conn,$sql)) {
        die('Error: ' . mysqli_error($conn));
    }

    session_start();
    unset($_SESSION["cart_session"]);
    header("location:form_order_submit.php"); 
    exit();   
}
?>