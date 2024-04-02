<?php	
    require('template/header.php'); 
	$sql = "SELECT * FROM donate";
	$result= mysqli_query($conn, $sql);

    if(isset($_POST['submit'])) {
    $item=$_POST['item'];
	$details=$_POST['details'];
	$quantity=$_POST['quantity'];
	$fullName=$_POST['fullName'];
	$email=$_POST['email'];
	$tel=$_POST['tel'];
	$mad=$_POST['mad'];
	
	
    $file = pathinfo(basename($_FILES['Picture']['name']), PATHINFO_EXTENSION);
	if($file != ""){
		$new_image = 'Picture'. uniqid(). "." . $file;
		$image_path = "admin/dashboard/postimages/";
		$upload_path = $image_path . "/" . $new_image;

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
	
		
	mysqli_query($conn,"INSERT INTO donate ( item, details,  Picture, quantity, fullName, email, tel, mad) 
									VALUES( '$item', '$details', '$pic','$quantity','$fullName','$email','$tel','$mad')");
	echo "<script>alert('ส่งแบบฟอร์มการบริจาคสำเร็จ')</script>";
    }
?>

<style>
    .row {
        margin-bottom: 1em;
    }
</style>
<body>
<div class="container">
    <div class="bread-crump mt-3 mb-3 px-0">
        <a href="home.php">หน้าหลัก</a> >
        <a href="donate.php">บริจาค</a> >
        <a href="donate_thing.php">บริจาคสิ่งของ</a>
    </div>

    <div class="card">
	<div class="card-header">บริจาคสิ่งของ</div>	
        <div class="card-body">
        <form method="POST" action="" enctype="multipart/form-data">
				
					<div class="row">
						<div class="col-lg-12">
                        <label class="control-label">รูปแบบการจัดส่ง :</label>
							<span class="align-middle"><input type="radio" value="ส่งผ่านที่อยู่"    name="mad"> ส่งผ่านที่อยู่</span>
							<span class="align-middle"><input type="radio" value="นำส่งด้วยตัวเอง" name="mad"> นำส่งด้วยตัวเอง</span>
						</div>
                    </div>
					
					<div class="row">
						<div class="col-lg-12"><label class="control-label">ชื่อผู้บริจาค :</label>
							<input type="text" class="form-control" name="fullName">
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-6">
                            <label class="control-label">อีเมล :</label>
							<input type="text" class="form-control" name="email">
						</div>
                        <div class="col-lg-6">
                            <label class="control-label">เบอร์โทรศัพท์ :</label>
							<input type="text" class="form-control" name="tel">
						</div>
					</div>
									
					<div class="row">
						<div class="col-lg-12"><label class="control-label">ของที่ต้องการบริจาค :</label>
							<input type="text" class="form-control" name="item">
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12"><label class="control-label">รายระเอียดสิ่งของ :</label>
							<textarea class="form-control" name="details" rows="4"></textarea>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
                            <label class="control-label">จำนวน :</label>
							<input type="number" class="form-control" name="quantity">
						</div>
					</div>
				

					<div class="row">
						<div class="col-lg-12">
							<label class="control-label">รูปภาพสิ่งของที่ต้องการบริจาค</label>
						    <input type="file" class="form-control" name="Picture">                    
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-3 border-0 text-black" name="submit">ยืนยัน</button>
                        </div>
						
						</div>
					</div>
                </div> 
        </form>
        </div>
    </div>
</div>
</body>
<?php require('template/footer.php');?>