<?php
session_start();
require_once("template/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM store WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('nameproduct'=>$productByCode[0]["nameproduct"],
																'code'=>$productByCode[0]["code"],
																'quantity'=>$_POST["quantity"],
																'price'=>$productByCode[0]["price"],
																'img'=>$productByCode[0]["img"])
															);
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
<TITLE>Simple PHP Shopping Cart</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>G-Car | Car for sell</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
	
  
  <script src="../java/java2.js"></script>
  <style>
	img {
		display: inline-flex;
		width: 200px;
		height: 200px;
		object-fit: cover;
	}
  </style>
</HEAD>
<BODY>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];?>
				<tr>
				<td><img src="<?php echo $item["img"]; ?>" class="cart-item-img" />
					<?php echo $item["nameproduct"]; ?>
				</td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Remove</a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>

</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>
<form style="background-color: none;" name="form-order" action="ordersubmit.php" method="POST" enctype="multipart/form-data">
                <input type="button" name="sub" value="ชำระตัง" onclick="location.href='orderconfirm.php?product_id=<?php echo $row['product_id']?>'"
                      style="width: 100%; background-color:green; border:none; color:white;
                             padding:0.5em 0 0.5em 0; font-size:1.5em; margin:1em 0 0 0;">
                          
              </form>
<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php $product_array = $db_handle->runQuery("SELECT * FROM store ORDER BY product_id ASC");
		  if (!empty($product_array)) { 
			foreach($product_array as $key=>$value){ ?>
			<div class="product-item">
				<form method="post" action="cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
					<div class="product-image"><img src="<?php echo $product_array[$key]["img"]; ?>"></div>
					<div class="product-tile-footer">
					<div class="product-title"><?php echo $product_array[$key]["nameproduct"]; ?></div>
					<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
					<div class="cart-action">
						<input type="number" class="product-quantity" name="quantity" value="1" size="2" />
						<input type="submit" value="Add to Cart" class="btnAddAction" />
					</div>
					</div>
				</form>
			</div>
	<?php
		}
	}
	?>
</div>
</BODY>
</HTML>