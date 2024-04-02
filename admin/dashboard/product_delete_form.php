<!-- Delete -->
<div class="modal fade" id="del<?php echo $row['product_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Delete</h4></center>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
				<?php
					$del=mysqli_query($conn,"select * from store  where product_id='".$row['product_id']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>ยืนยันการลบข้อมูล</center></h5> 
                </div> 
				
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove"></span>
						Cancel
					</button>
                    <a href="product_delete.php?product_id=<?php echo $row['product_id']; ?> class="btn btn-danger">
						<span class="glyphicon glyphicon-trash"></span>
						Delete
					</a>
                </div>
				
            </div>
        </div>
    </div>
<!-- /.modal -->