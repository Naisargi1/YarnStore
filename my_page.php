<?php
require_once('lib/lib.php');
require_once('lib/dblibs.php');

if (array_key_exists('loggedin', $_SESSION)){

output_html5_header(
  'User Page',
  array( "bootstrap/css/bootstrap.css","bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js", "js/carousel.js")
);

output_page_menu();

db_connect();
$user= db_get_user_by_id($_SESSION['loggedin']);


?>

<div class="container">
  <div class="row">
    <div class="col-md-12">&nbsp;</div>
    <div class="col-md-3">
      <ul class="nav nav-pills nav-stacked list-group">
        <li ><a class="disabled well" ><i class="glyphicon glyphicon-cog"></i> Configurations</a></li>
        <li><a href="edit_user.php"><i class="glyphicon glyphicon-user"></i> Edit Profile</a></li>
        <?php
					if(is_admin($_SESSION['loggedin'])){
						echo'<li><a href="new_product_form.php"><i class="glyphicon glyphicon-plus"></i> Add a Product</a></li>';

					} else{
						echo'<li><a href="are_you_sure.php?type=delete&string='.$user['name'].'&id='.$user['user#'].'&subject=user"><i class="glyphicon glyphicon-trash"></i> Delete Profile</a></li>';
					}
				?>
      </ul>
    </div>
    <div class="col-md-9">
      <h1>User Page</h1>
      <div class="container"> <svg width="100%" height="30%" version="1.1"
			xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(10,10)">
          <text id="TextElement" x="0" y="0" class="svgt"> Welcome <?php echo $user['firstname'];?>!
            <set attributeName="visibility" attributeType="CSS" to="visible" begin="1s" dur="5s" fill="freeze"/>
            <animateMotion path="M 0 0 L 100 100" begin="1s" dur="5s" fill="freeze"/>
            <animateTransform attributeName="transform" attributeType="XML" type="rotate" from="-30" to="0" begin="1s" dur="5s" fill="freeze"/>
            <animateTransform attributeName="transform" attributeType="XML" type="scale" from="1" to="3" additive="sum" begin="1s" dur="5s" fill="freeze"/>
          </text>
        </g>
        </svg>
        <p>Select an option in the left menu.</p>
      </div>
    </div>
  </div>
</div>
<?php

output_page_footer();
output_html5_footer();

}
  else
  {
	header('Location: login.php');
  }
?>
