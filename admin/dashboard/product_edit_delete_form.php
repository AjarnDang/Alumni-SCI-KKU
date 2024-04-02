<?php
	include('../../db/connection.php');
	$sql = "SELECT * FROM store";
	$result= mysqli_query($conn, $sql);
?>


<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $row['Product_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">แก้ใข</h4></center>
                </div>
                <div class="modal-body">
				<?php

					$edit=mysqli_query($conn,"select * from store  where Product_ID='".$row['Product_ID']."'");
					$row=mysqli_fetch_array($edit);
				?>
				<div class="container-fluid">
				<form method="POST" action="edit_product.php?Product_ID=<?php echo $row['Product_ID']; ?>" enctype="multipart/form-data">
					
				<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">ชื่อสินค้า:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="productName" value="<?php echo $row['productName']?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">รายระเอียดสินค้า:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="Description"value="<?php echo $row['Description']?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">ราคา:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="Price"value="<?php echo $row['Price']?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">จำนวนสิ้นค้า:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="quantity"value="<?php echo $row['quantity']?>">
						</div>
					</div>
					<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">รูปภาพ</label>
						</div>
						<div class="col-lg-10">
							<input type="file" class="form-control-file" name="Picture">
						</div>
					</div>
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove"></span> Cancel
					</button>
                    <button type="submit" class="btn btn-warning">
						<span class="glyphicon glyphicon-check"></span> Save
					</button>
                </div>
				</form>
            </div>
        </div>
    </div>