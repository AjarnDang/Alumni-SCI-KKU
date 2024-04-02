<?php	
    require('../template/header_user.php'); 
	$sql = "SELECT * FROM donate_stuff";
	$result= mysqli_query($conn, $sql);

    if(isset($_POST['submit'])) {

		$item=$_POST['item'];
		$details=$_POST['details'];		
		$fullName=$_POST['fullName'];
		$email=$_POST['email'];
		$tel=$_POST['tel'];
		$mad=$_POST['mad'];
		$Datee=$_POST['Datee'];
		$Timee=$_POST['Timee'];
	
    $file = pathinfo(basename($_FILES['Picture']['name']), PATHINFO_EXTENSION);
	if($file != ""){
		$new_image = 'Picture'. uniqid(). "." . $file;
		$image_path = "../admin/dashboard/postimages/";
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
	
		
	mysqli_query($conn,"INSERT INTO donate_stuff ( item, details,  Picture,  fullName, email, tel, mad, Datee, Timee) 
									VALUES( '$item', '$details', '$pic','$fullName','$email','$tel','$mad','$Datee','$Timee')");
	echo "<script>alert('ส่งแบบฟอร์มการบริจาคสำเร็จ')</script>";
	header("location:donate_thing.php");
    }
?>
<script>
	function changeContent1() {
	document.getElementById("show1").classList.remove("hide"); 
	}
	function changeContent2() {
	document.getElementById("show1").classList.add("hide");
	}
	
</script>
<style>.hide { display: none;}</style>
<body>
<div class="container">
    <div class="bread-crump mt-3 px-0">
        <a href="home.php">หน้าหลัก</a> >
        <a href="donate.php">บริจาค</a> >
        <a href="donate_thing.php">บริจาคสิ่งของ</a>
    </div>
<div class="row">
	<div class="col-lg-8 mt-3">
	<div class="card">
		<div class="card-header">บริจาคสิ่งของ</div>	
        <div class="card-body">
        <form method="POST" action="" enctype="multipart/form-data">
				
				<div class="row">
					<div class="col-lg-3">
					<label class="control-label" style="position:relative; top:7px;">รูปแบบการจัดส่ง</label>
				    </div>
						<div class="col-lg-9 d-flex align-items-center pt-2">
							<div><input type="radio"  value="ส่งผ่านที่อยู่"    name="mad" onclick="changeContent2();" value="2"> ส่งผ่านไปรษณีย์</div>&nbsp;&nbsp;&nbsp;
							<div><input type="radio"  value="นำส่งด้วยตัวเอง" name="mad" onclick="changeContent1();" value="1"> นำส่งด้วยตัวเอง</div>
						</div>
						<div id="show1" class="hide ">
							<label class="control-label" style="position:relative; top:7px;">ระบุวันที่ - เวลานำส่ง</label>
							<input type="date" class="form-control mt-2" name="Datee">
							<input type="time" class="form-control mt-3" name="Timee">
						</div>
					</div>
					
					<div class="row mt-3">
						<div class="col-lg-12"><label class="control-label">ชื่อ-สกุล</label>
							<input type="text" class="form-control" name="fullName">
						</div>
					</div>
					
					<div class="row mt-3">
						<div class="col-lg-6">
                            <label class="control-label">อีเมล</label>
							<input type="text" class="form-control" name="email">
						</div>
                        <div class="col-lg-6">
                            <label class="control-label">เบอร์โทรศัพท์</label>
							<input type="text" class="form-control" name="tel" max="10" min="10" pattern="[0-9]+">
						</div>
					</div>

					<p><a class="btn btn-primary mt-3 border-0 bg-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        คำแนะนำ
                    </a></p>
                    <div class="collapse" id="collapseExample">
                    <div class="card card-body p-0 pt-3 pr-2">
                        <ol class="list-group-numbered border-0 ">
                            <li class="list-group-item border-0 p-0">ของที่ต้องการบริจาค เช่น เสื้อผ้า, หนังสือ หรือ อุปกรณ์การเรียน</li>
							<li class="list-group-item border-0 p-0">รายละเอียดสิ่งของ เช่น เสื้อผ้าผู้ชาย 1 ตัว, หนังสือชีวเคมี 3 เล่ม และฟิสิกส์ 2 เล่ม, โต๊ะเลคเชอร์ 1 ตัว, จอมอนิเตอร์ 1 จอ เป็นต้น</li>
                        </ol>
                    </div>
                    </div> 
									
					<div class="row mt-3">
						<div class="col-lg-12"><label class="control-label">ของที่ต้องการบริจาค</label>
							<input type="text" class="form-control" name="item">
						</div>
					</div>
					
					<div class="row mt-3">
						<div class="col-lg-12"><label class="control-label">รายละเอียดสิ่งของ</label>
							<textarea class="form-control" name="details" rows="4"></textarea>
						</div>
					</div>
				

					<div class="row mt-3">
						<div class="col-lg-12">
							<label class="control-label">แนบรูปภาพ (แนบหรือไม่แนบก้ได้)</label>
						    <input type="file" class="form-control" name="Picture">                    
                        <div class="text-right">
                        <button type="submit" class="btn btn-primary mt-3 border-0 text-black" name="submit">ยืนยัน</button>
                        </div>
						
						</div>
					</div>
                </div> 
        </form>
        </div>
    </div>
	<div class="col-lg-4 mt-3">
	<div id="show2" class="hide card">
			<div class="card-body">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.0241826864863!2d102.8211907163238!3d16.474313132826783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31228bfd5f159233%3A0x54e37d9b3e18c6ff!2z4Lit4Liy4LiE4Liy4Lij4Lin4Li04LiX4Lii4Liy4Lio4Liy4Liq4LiV4Lij4LmMIDA2IChTQyAwNikg4LiV4Li24LiB4Lir4Lil4Lit4LiU!5e0!3m2!1sth!2sth!4v1665656506338!5m2!1sth!2sth" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>	
		</div>
	</div>
	</div>	
</div>
</body>
<?php require('../template/footer_users.php');?>