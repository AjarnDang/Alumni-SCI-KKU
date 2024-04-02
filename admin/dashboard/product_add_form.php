<!-- Add New -->
<?php
	include('../../db/connection.php');
	$sql = "SELECT * FROM store";
	$result= mysqli_query($conn, $sql);
?>
<style>
	.row {
		margin: 1rem 0;
	}
</style>
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">เพิ่มสินค้า</h4></center>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">

					<form method="POST" action="product_add_product.php" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-3">
							<label class="control-label" style="position:relative; top:7px;">ชื่อสินค้า:</label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" name="productName">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<label class="control-label" style="position:relative; top:7px;">รายละเอียดสินค้า:</label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" name="Description">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<label class="control-label" style="position:relative; top:7px;">ราคา:</label>
						</div>
						<div class="col-lg-9">
							<input type="text" class="form-control" name="Price">
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-3">
							<label class="control-label" style="position:relative; top:7px;">รูปภาพ</label>
						</div>
						<div class="col-lg-9">
						<input type="file" class="form-control" name="Picture">
						</div>
					</div>
                 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a> </button>
				</form>
                </div>
				
            </div>
        </div>
    </div>