<?php
require_once('lib/lib.php');
require_once('lib/dblibs.php');


$product = db_get_product_by_id($_GET['id']);

output_html5_header(
  "Product",
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css","css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

output_page_menu();



?>

<h1><?php echo $product['brand'].' '.$product['name']?></h1>

<div class="row">
	<div class="col-md-4">
		<div class="img">
			<img class="img-responsive"  src="<?php echo $product['image'];?>" />
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="description">
			<p><strong>Description: </strong><?php echo $product['description'];?></p>
			<p><strong>Colour: </strong><?php echo $product['colourway'];?></p>
			<p><strong>Content: </strong><?php echo $product['fiber'];?></p>
			<p><strong>Weight: </strong><?php echo $product['weight'];?></p>
			<p><strong>Weight (g): </strong><?php echo $product['unitweight'];?></p>
			<p><strong>Yardage: </strong><?php echo $product['yards'];?></p>
			<?php if(array_key_exists('loggedin', $_SESSION)){
				if(is_admin($_SESSION['loggedin'])){
					echo'  <div class="form-group">';
					echo'	<a href="edit_product.php?id='.$product['item#'].'" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>';
					echo'	<a href="are_you_sure.php?type=delete&string='.$product['name'].'&id='.$product['item#'].'&subject=product" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></a>';
					echo'	</div>';
				}
			}
			?>
			
		</div>
		<div class="main-price">
			<p class="price">Price: $<?php echo $product['price'];?></p>
			<form role="form"  action="add_to_cart.php" method="POST">
				<fieldset>
					<div class="form-group">
						<label class="col-md-1 control-label" for="qtd">Qtd: </label>  
						<div class="col-md-2">
							<input id="qtd" name="qtd" type="number" min="1" max="<?php echo $product['quantity'];?>" required="" class="form-control input-md" value="1">
						</div>
						<input type="hidden" name="product" value="<?php echo $product['item#'];?>" />
						<button type="submit" class="btn btn-primary">Add to Cart</button>
					</div>
				</fieldset>
			</form>
			
		</div>
	</div>
</div>

<?php

output_page_footer();
output_html5_footer();
?>