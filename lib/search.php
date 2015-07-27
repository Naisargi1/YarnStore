<?php
require_once('lib/dblibs.php');
require_once('lib/lib.php');


function search($atribute, $term, $max){
global $db_connection_handle;
db_connect();

$sql = "";

switch($term){
	case "brand":
		$sql = 'WHERE brand = "'.$_GET['brand'].'"';
		break;
	case "*":
		$sql = 'WHERE name LIKE "'.$atribute.'%" OR brand LIKE "'.$atribute.'%" OR description LIKE "'.$atribute.'%" OR colourway LIKE "'.$atribute.'%" OR fiber LIKE "'.$atribute.'%"';
		break;
	case '':
		break;
	default: 
		$sql = '';
}

if ($max>0){
	$sql=$sql.' LIMIT '.$max;
}



$getproducts = $db_connection_handle->prepare("SELECT * FROM Inventory ".$sql);
$getproducts->execute();
$products = $getproducts->fetchAll();

	if(empty($products)){
		echo '<div class="well"><strong>Sorry.</strong> We couldn&apos;t find a match. <a onClick="window.history.back();"> ← Go back. </a></div>';
	}
	echo '<div class="row">';
	foreach ($products as $product) {
		echo '<div class="col-xs-18 col-sm-6 col-md-2">';
        echo '	<div class="thumbnail">';
        echo '    <img src="'.$product['image'].'">';
        echo '      <div class="caption">';
        echo '        <h4>'.$product['brand'].' '.$product['name'].'</h4>';
        echo '        	<form class="form-inline" role="form" action="add_to_cart.php" method="POST">
		
							<input type="hidden" name="qtd" value="1" />
							<input type="hidden" name="product" value="'.$product['item#'].'" />
							
							<a href="product.php?id='.$product['item#'].'" class="btn btn-default btn-xs" role="button">View details</a> 
							<button type="submit" class="btn btn-primary btn-xs">Add to Cart</button>
						</form>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
	}
	echo '</div>';

}
?>
