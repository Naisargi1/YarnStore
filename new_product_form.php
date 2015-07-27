<?php
require_once('lib/lib.php');

output_html5_header(
  'New Product',
  array( "bootstrap/css/bootstrap.css","bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js", "js/carousel.js")
);

if (array_key_exists('loggedin', $_SESSION))
{
	if (is_admin($_SESSION['loggedin'])){

output_page_menu();

$resub = false;
$errorP = false;
$errorQ = false;
$errorY = false;
$errorUW = false;


if (array_key_exists('name', $_SESSION) &&
	array_key_exists('brand', $_SESSION) &&
	array_key_exists('price', $_SESSION) &&
	array_key_exists('quantity', $_SESSION) &&
	array_key_exists('colourway', $_SESSION) &&
	array_key_exists('weight', $_SESSION) &&
	array_key_exists('yards', $_SESSION) &&
	array_key_exists('unitWeight', $_SESSION) &&
	array_key_exists('fiber', $_SESSION) &&
	array_key_exists('description', $_SESSION))
{
	$resub = true;
	if (array_key_exists('errorP', $_SESSION)){
		$errorP = true;
		unset($_SESSION['errorP']);
	}
	if (array_key_exists('errorQ', $_SESSION)){
		$errorQ = true;
		unset($_SESSION['errorQ']);
	}
	if (array_key_exists('errorY', $_SESSION)){
		$errorY = true;
		unset($_SESSION['errorY']);
	}
	if (array_key_exists('errorUW', $_SESSION)){
		$errorUW = true;
		unset($_SESSION['errorUW']);
	}
}

?>

<h1>New Product</h1>
<form class="form-horizontal" action="new_product.php" enctype="multipart/form-data"  method="POST">
  <fieldset>
    <div class="form-group">
    <label class="col-md-4 control-label" for="name">Name</label>
    <div class="col-md-4"> <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required=""		
	  <?php
			if ($resub){
				echo ' value="'.$_SESSION['name'].'"></div>';
				unset($_SESSION['name']);
			}
			else{
				echo '></div>';
			}
		?>
	</div>
    <div class="form-group">
    <label class="col-md-4 control-label" for="brand">Brand</label>
    <div class="col-md-4"> <input id="brand" name="brand" type="text" placeholder="" class="form-control input-md" required=""
		<?php
			if ($resub){
				echo ' value="'.$_SESSION['brand'].'"></div>';
				unset($_SESSION['brand']);
			}
			else{
				echo '></div>';
			}
		?>

	</div>
    <div class="form-group">
    <label class="col-md-4 control-label" for="quantity">Quantity</label>
    <div class="col-md-1">
      <input id="quantity" name="quantity" type="text" placeholder="" class="form-control input-md" required="" type="number "
		<?php
			if ($resub){
				echo ' value="'.$_SESSION['quantity'].'"></div>';
				unset($_SESSION['quantity']);
				if ($errorQ){
					echo '<span class="error">! invalid quantity (enter an integer)</span>';
				}
			}
			else{
				echo '></div>';
			}
		?>
	
    </div>
    <div class="form-group">
    <label class="col-md-4 control-label" for="price">Price</label>
    <div class="col-md-2">
      <input id="price" name="price" type="text" placeholder="" class="form-control input-md" required="" type="number "
		<?php
			if ($resub){
				echo ' value="'.$_SESSION['price'].'"></div>';
				unset($_SESSION['price']);
				if ($errorP){
					echo '<span class="error">! invalid price (enter an integer)</span>';
				}
			}
			else{
				echo '></div>';
			}
		?>
	
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="description">Description</label>
      <div class="col-md-4">
        <textarea class="form-control" id="description" name="description"><?php
				if ($resub){
					echo $_SESSION['description'];
				}
			?>
</textarea>
      </div>
    </div>
    <div class="form-group">
    <label class="col-md-4 control-label" for="content">Fiber Content</label>
    <div class="col-md-4"> <input id="fiber" name="fiber" type="text" placeholder="" class="form-control input-md" required=""
		<?php
			if ($resub){
				echo ' value="'.$_SESSION['fiber'].'"></div>';
				unset($_SESSION['fiber']);
			}
			else{
				echo '></div>';
			}
		?>
	</div>
    <div class="form-group">
    <label class="col-md-4 control-label" for="colorway">Colorway</label>
    <div class="col-md-4"> <input id="colourway" name="colourway" type="text" placeholder="" class="form-control input-md" required=""
		<?php
			if ($resub){
				echo ' value="'.$_SESSION['colourway'].'"></div>';
				unset($_SESSION['colourway']);
			}
			else{
				echo '></div>';
			}
		?>

	</div>
    <div class="form-group">
    <label class="col-md-4 control-label" for="weight">Yarn Weight</label>
    <div class="col-md-4"> <input id="weight" name="weight" type="text" placeholder="" class="form-control input-md" required=""
		<?php
			if ($resub){
				echo ' value="'.$_SESSION['weight'].'"></div>';
				unset($_SESSION['weight']);
			}
			else{
				echo '></div>';
			}
		?>

	</div>
    <div class="form-group">
    <label class="col-md-4 control-label" for="unitWeight">Unit Weight (g)</label>
    <div class="col-md-1">
      <input id="unitWeight" name="unitWeight" type="text" placeholder="" class="form-control input-md" required="" type="number"
		<?php
			if ($resub){
				echo ' value="'.$_SESSION['unitWeight'].'"></div>';
				unset($_SESSION['unitWeight']);
				if ($errorUW){
					echo '<span class="error">! invalid weight (enter an integer)</span>';
				}
			}
			else{
				echo '></div>';
			}
		?>

	
    </div>
    <div class="form-group">
    <label class="col-md-4 control-label" for="yards">Yardage</label>
    <div class="col-md-1">
      <input id="yards" name="yards" type="text" placeholder="" class="form-control input-md" required="" type="number"
		<?php
			if ($resub){
				echo ' value="'.$_SESSION['yards'].'"></div>';
				unset($_SESSION['yards']);
				if ($errorY){
					echo '<span class="error">! invalid yardage (enter an integer)</span>';
				}
			}
			else{
				echo '></div>';
			}
		?>

	
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="exampleInputFile">Image</label>
      <div class="col-md-4">
        <input type="file" accept="image/*" id="image" name="image" >
        <span class="help-block">Upload an image .png or .jpeg</span> </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-8"> <a href="my_page.php" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </div>
  </fieldset>
</form>
<div class="col-md-12">&nbsp;</div>
<div class="col-md-12">&nbsp;</div>
<div class="col-md-12">&nbsp;</div>
<?php

  }
  else{
	message("bad", "You do not have permission to view this page. <a href=\"index.php\">Go Home</a>");
  }
}
else
{
	message("bad", " You must be a logged in administrator to do this! <a href=\"login.php\">Log in</a>");
}

output_page_footer();
output_html5_footer();
?>