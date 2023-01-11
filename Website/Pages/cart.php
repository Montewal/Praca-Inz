<?php
	namespace Classess;
	session_start();
	error_reporting(~E_WARNING & ~E_NOTICE);
	$status="";
	if (isset($_POST['action']) && $_POST['action']=="remove")
	{
		if(!empty($_SESSION["cart"])) 
		{
			foreach($_SESSION["cart"] as $key => $value) 
			{
				if($_POST["tag"] == $key)
				{
					unset($_SESSION["cart"][$key]);
					$status = "<div class='box' style='color:red;'>
							   Usunięto z koszyka</div>";
				}

				if(empty($_SESSION["cart"])) 
				{		
					unset($_SESSION["cart"]);
				}
			}		
		}
	}

	if (isset($_POST['action']) && $_POST['action']=="change")
	{
		foreach($_SESSION["cart"] as &$value)
		{
			if($value['tag'] === $_POST["tag"])
			{
				$value['quantity'] = $_POST["quantity"];
				break; 
			}
		}		
	}
?>
<html>
<head>
	<title>IT World</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="../Content/JS/init_buy.js"></script>
	<link rel="stylesheet" href="../Content/CSS/cart.css" />
</head>
<body>
	<a id="back" href="../Pages/Shop.php"><img src="../Content/Pictures/arrow-left.png" width="70px" height="70px"></a>
	<div style="width:700px; margin:50 auto;">
		<h2>
		<?php
		if(!empty($_SESSION["cart"])) 
		{
			$cart_count = count(array_keys($_SESSION["cart"]));
		?>
		<div class="cart_div">
		<a>
		<img src="../Content/Pictures/cart.png" width="35px" height="35px"/>
		<span><?php echo $cart_count; ?></span>
		</div>
		<?php
		}
		?>
		</h2>   
		

		<div class="cart">
			<?php
			if(isset($_SESSION["cart"]))
			{
				$total_price = 0;
			?>	
			<table class="table">
				<tbody>
					<tr>
						<td></td>
						<td>ITEM NAME</td>
						<td>QUANTITY</td>
						<td>UNIT PRICE</td>
						<td>ITEMS TOTAL</td>
					</tr>	
				<?php		
				foreach ($_SESSION["cart"] as $product)
				{
				?>
					<tr>
						<td> <img src="<?php echo $product["image"]; ?>" width="50px" height="50px" /> </td>
						<td>
							<?php echo $product["name"]; ?> <br/>
							<form method='post' action=''>
								<input type='hidden' name='tag' value="<?php echo $product["tag"]; ?>" />
								<input type='hidden' name='action' value="remove" />
								<button type='submit' class='remove'>Usuń z koszyka</button>
							</form>
						</td>
						<td>
							<form method='post' action=''>
								<input type='hidden' name='tag' value="<?php echo $product["tag"]; ?>" />
								<input type='hidden' name='action' value="change" />
								<select name='quantity' class='quantity' onchange="this.form.submit()">
								<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
								<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
								<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
								<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
								<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
								</select>
							</form>
						</td>
						<td><?php echo $product["price"]."zł"; ?></td>
						<td><?php echo sprintf("%.2f",$product["price"]*$product["quantity"])."zł"; ?></td>
					</tr>
				<?php
					$total_price += ($product["price"]*$product["quantity"]);
					
				}
				$_SESSION["total_price"] = $total_price; 
				?>
					<tr>
						<td colspan="5" align="right">
							<strong>Podsumowanie: <?php echo sprintf("%.2f",$total_price)."zł"; ?></strong>
						</td>
					</tr>
				</tbody>
			</table>		
			<?php
			}
			else
			{
				echo "<h3>Koszyk jest pusty</h3>";
			}
			?>
		</div>
		<div style="clear:both;"></div>
		<div class="message">
		<?php
			if(!empty($_SESSION["cart"]))
				echo "<input type='submit' id='buy' value='Kupuję i płacę'>";
		?>
		<?php echo $status; ?>
		</div>
	</div>
</body>
</html>