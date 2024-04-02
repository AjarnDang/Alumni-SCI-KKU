<?php
	include('../../db/connection.php');
	$product_id=$_GET['product_id'];
	mysqli_query($conn,"DELETE from store where product_id='$product_id'");
	header('location:./product_dashboard.php');
?>