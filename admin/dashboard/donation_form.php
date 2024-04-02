<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 mt-3">
			<form action="donation_chart.php?p=adddb" method="post" class="form-horizontal">
				<div class="form-group row">				
					<div class="col-sm-2 col-form-label">ชื่อ-สกุล ผู้บริจาค</div>
					<div class="col-sm-7">
						<input type="text" name="full_name" class="form-control" placeholder="สมพูน เป็นคนใจบุญ" required>
					</div>
				</div>
				<div class="form-group row">				
					<div class="col-sm-2 col-form-label">เบอร์โทร ผู้บริจาค</div>
					<div class="col-sm-7">
						<input type="text" name="phone_number" class="form-control" min="10" max="10" placeholder="06XXXXXXXX" value="">
					</div>
				</div>
				<div class="form-group row">				
					<div class="col-sm-2 col-form-label">รายละเอียด</div>
					<div class="col-sm-7">
						<textarea name="detail" class="form-control" required></textarea>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2 col-form-label">จำนวนเงิน</div>
					<div class="col-sm-2">
						<input type="number" name="amount" class="form-control"  required>
					</div>
					<div class="col-sm-2"> บาท </div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-2">
						<button type="submit" name="save" class="btn btn-primary">บันทึก</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>