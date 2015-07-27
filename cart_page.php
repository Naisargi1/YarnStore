<?php
require_once('lib/lib.php');
require_once('lib/dblibs.php');

output_html5_header(
  'Shopping Cart',
  array( "bootstrap/css/bootstrap.css","bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js", "js/carousel.js")
);

if (array_key_exists('loggedin', $_SESSION))
{
output_page_menu();

	db_connect();
	$user_id = db_get_user_id($_SESSION['loggedin']);
	$cart = get_cart($user_id);

?>

<?php ?>
<h1>Shopping Cart</h1>
<div class="row">
<table class="table table-hover cart_table">
	<thead>
		<th>Product</th>
		<th></th>
		<th>Price</th>
		<th>Quantity</th>
	</thead>
	<tbody>
	<?php
		$i=0;
		$s='s';
		$subtotal=0;
	if($cart!=NULL){
		$i=0;
		$s='s';
		foreach ($cart as $prod){
			$product = db_get_product_by_id($prod['item#']);
			$subtotal = total($cart);
			$quantity = $prod['quantity'];
		?>
			<tr>
				<td><img class="sml" src="<?php echo $product['image'];?>"/></td>
				<td>
					<h4><?php echo $product['brand'].' '.$product['name']; ?></h4>
					<p><?php echo $product['brand']; ?></p>
					<a href="delete_cart.php?product_id=<?php echo $product['item#'];?>&user_id=<?php echo $user_id;?>">Delete</a>
				</td>
				<td><strong><?php echo '$'.$product['price']; ?></strong></td>
				<td>
					<div class="form-group">
						<div class="col-md-3">
							<p><?php echo $quantity; ?></p>
						</div>
						<div class="col-md-2">
							<a href="delete_cart.php?product_id=<?php echo $product['item#'];?>&user_id=<?php echo $user_id;?>" class="btn btn-block btn-default btn-default"><i class="glyphicon glyphicon-trash"> </i></a></div>
						</div>
					</div>
				</td>		
			</tr>
			<?php
				$i++;
				if ($i==1) $s='';
				else $s='s';
				
				}
				

			}else{
				echo '<tr><td>Cart empty</td></tr>';
			}
			?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>
				<h4>Subtotal<?php echo '('.$i.' item'.$s.'): $'.$subtotal;?></h5>
			</td>
		</tr>
	</tbody>
</table>
<?php if($cart!=NULL){?>
<div class="row">
	<div class="col-md-3 pull-right"> </div>
	<div class="col-md-3 pull-right"><a href="check_items.php?user_id=<?php echo $user_id;?>" class="btn btn-block btn-primary">Checkout</a></div>
	<div class="col-md-2 pull-right"><a href="index.php" class="btn btn-block btn-default">Continue Shopping</a></div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12">&nbsp;</div>
</div>
</div>

<?php
}
}
else
{
	message("bad", " You must be logged in to do this! <a href=\"login.php\">Log in</a>");
}

output_page_footer();
output_html5_footer();

?>