<?php 
$conn = mysqli_connect("localhost",
                       "root",
                       "",
                       "alumni_sci"
                       )
        or die("Error " . mysqli_error($conn));
    
        mysqli_query($conn, "SET NAMES 'utf8' ");
        date_default_timezone_set('Asia/Bangkok');
        
$currency = '฿';
$month_arr=array(
    "1"=>"มกราคม",
    "2"=>"กุมภาพันธ์",
    "3"=>"มีนาคม",
    "4"=>"เมษายน",
    "5"=>"พฤษภาคม",
    "6"=>"มิถุนายน", 
    "7"=>"กรกฎาคม",
    "8"=>"สิงหาคม",
    "9"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม"                 
);
//echo date("d")." ".$month_arr[date("n")]." ".(date("Y")+543);
 
?>