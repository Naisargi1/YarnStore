<?php
require_once('lib/dblibs.php');
require_once('lib/lib.php');
?>
<?php
function carousel(){
global $db_connection_handle;
db_connect();
$sql = "SELECT * FROM Inventory ORDER BY 'item#' DESC LIMIT 0,4";

$getproducts = $db_connection_handle->prepare($sql);
$getproducts->execute();
$products = $getproducts->fetchAll();

	if(empty($products)){
		echo '<div class="well"><strong>Sorry.</strong> There are no products registred.</div>';
	}
	
	echo ' <div class="container-fluid">';
	echo '	<div id="custom_carousel" class="carousel slide" data-ride="carousel" data-interval="2500">';
	echo '		<div class="carousel-inner">';
	$i=0;
	$c="item active";
	foreach ($products as $product) {
		echo '<div class="'.$c.'">';
        echo '        <div class="container-fluid">';
        echo '            <div class="row">';
        echo '                <div class="col-md-3"><img src="'.$product['image'].'" class="thumb img-responsive"></div>';
        echo '                <div class="col-md-9">';
        echo '                    <h2>'.$product['brand'].' '.$product['name'].'</h2>';
        echo '                    <p>'.$product['description'].'</p>';
		echo '        			<p><a href="product.php?id='.$product['item#'].'" class="btn btn-primary" role="button">View details</a></p>';
        echo '                </div>';
        echo '            </div>';
        echo '        </div>';            
		echo '</div>'; 
		$i++;
		if($i>0) $c="item";
	}
	echo '</div>';
        echo '<div class="controls">';
            echo '<ul class="nav">';
			$i=0;
			$c="active";
			foreach ($products as $product) {
                echo '<li data-target="#custom_carousel" data-slide-to="'.$i.'" class="'.$c.'"><a href="#"><img class="mini" src="'.$product['image'].'"><small>'.$product['brand'].' '.$product['name'].'</small></a></li>';
				$i++;
				if($i>0) $c="#";
			}
            echo '</ul>';
        echo '</div>';
    echo '</div>';
	
	
}
?>
