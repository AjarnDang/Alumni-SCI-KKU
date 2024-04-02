<?php
$p=$_GET['p'];
if($p=='adddb'){
	$full_name = 	$_POST['full_name'];
	$phone_number = $_POST['phone_number'];
	$detail = 		$_POST['detail'];
	$amount = 		$_POST['amount'];
		$sql="INSERT INTO donation(full_name,
								   phone_number,
								   detail,
								   amount
								   )
						   VALUES('$full_name',
						   		  '$phone_number',
								  '$detail',
								  '$amount'
								  )
		";
		$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
		mysqli_close($conn);
	
	if($result){
			echo "<script type='text/javascript'>";
			echo "alert('เพิ่มข้อมูลสำเร็จ!');";
			echo "window.location = 'donation_chart.php'; ";
			echo "</script>";
			}
			else{
			echo "<script type='text/javascript'>";
			echo "alert('ขออภัย! มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง');";
			echo "window.location = 'donation_chart.php'; ";
			echo "</script>";
			}
}
?>
