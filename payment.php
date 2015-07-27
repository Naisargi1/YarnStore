<?php
require_once('lib/lib.php');
require_once('lib/dblibs.php');

output_html5_header(
  'Payment',
  array( "bootstrap/css/bootstrap.css","bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js", "js/carousel.js")
);

if (array_key_exists('loggedin', $_SESSION)){
	if (count($_GET) == 1 && array_key_exists('user_id', $_GET)){

output_page_menu();

$resub = false;
$errorCVC = false;
$errorMY = false;
$errorDate = false;

if (array_key_exists('name', $_SESSION) &&
	array_key_exists('cardNum', $_SESSION) &&
	array_key_exists('cvc', $_SESSION) &&
	array_key_exists('expM', $_SESSION) &&
	array_key_exists('expY', $_SESSION))
{
	$resub = true;
	if (array_key_exists('errorCVC', $_SESSION)){
		$errorCVC = true;
		unset($_SESSION['errorCVC']);
	}
	if (array_key_exists('errorMY', $_SESSION)){
		$errorMY = true;
		unset($_SESSION['errorMY']);
	}
	if (array_key_exists('errorDate', $_SESSION)){
		$errorDate = true;
		unset($_SESSION['errorDate']);
	}		
}

db_connect();
$user_id = $_GET['user_id'];
$cart = get_cart($user_id);
$total = total($cart);
?>
<h1>Payment</h1>

<div class="stepwizard">
    <div class="stepwizard-row">
        <div class="stepwizard-step">
            <a href="cart_page.php" class="btn btn-default btn-circle">1</a>
            <p>Cart</p>
        </div>
        <div class="stepwizard-step">
           <a href="checkout.php" class="btn btn-default btn-circle">2</a>
            <p>Shipping</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-primary btn-circle" >3</button>
            <p>Payment</p>
        </div> 
    </div>
</div>

<div class="container">
    <div class='row'>
		<div class='col-md-12'>&nbsp;</div>
		<div class='col-md-12'>&nbsp;</div>
        <div class='col-md-4'></div>
        <div class='col-md-4'>
          <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
          <form accept-charset="UTF-8" action="process.php" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_bQQaTxnaZlzv4FnnuZ28LFHccVSaj" id="payment-form" method="POST"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="?" /><input name="_method" type="hidden" value="PUT" /><input name="authenticity_token" type="hidden" value="qLZ9cScer7ZxqulsUWazw4x3cSEzv899SP/7ThPCOV8=" /></div>
            <div class='form-row'>
              <div class='col-xs-12 form-group required'>
                <label class='control-label'>Name on Card</label>
                <input class='form-control' size='4' type='text' name="name" id="name" required=""
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
            <div class='form-row'>
              <div class='col-xs-12 form-group card required'>
                <label class='control-label'>Card Number</label>
                <input autocomplete='off' class='form-control card-number' size='20' type='text' name="cardNum" id="cardNum" required=""
                <?php
					if ($resub){
						echo ' value="'.$_SESSION['cardNum'].'"></div>';
						unset($_SESSION['cardNum']);
					}
					else{
						echo '></div>';
					}
				?>
            </div>
            <div class='form-row'>
              <div class='col-xs-4 form-group cvc required'>
                <label class='control-label'>CVC</label>
                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' name="cvc" id="cvc" required=""
                <?php
					if ($resub){
						echo ' value="'.$_SESSION['cvc'].'"></div>';
						unset($_SESSION['cvc']);
						if ($errorCVC){
							echo '<span class="error">! invalid CVC number (enter a number with no spaces)</span>';
						}
					}
					else{
						echo '></div>';
					}
				?>
              </div>
              <div class='col-xs-4 form-group expiration required'>
                <label class='control-label'>Expiration</label>
                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' name="expM" id="expM" required=""
                <?php
					if ($resub){
						echo ' value="'.$_SESSION['expM'].'">';
						unset($_SESSION['expM']);
					}
					else{
						echo '>';
					}
				?>
              </div>
              <div class='col-xs-4 form-group expiration required'>
                <label class='control-label'> </label>
                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' name="expY" id="expY" required=""
                <?php
					if ($resub){
						echo ' value="'.$_SESSION['expY'].'"></div>';
						unset($_SESSION['expY']);
						if ($errorMY){
							echo '<span class="error">! invalid date</span>';
						}
						else if ($errorDate){
							echo '<span class="error">! your card has expired</span>';
						}
					}
					else{
						echo '></div>';
					}
				?>
            </div>
            <div class='form-row'>
              <div class='col-md-12'>
                <div class='form-control total btn btn-info'>
                  Total:
                  <span class='amount'>$<?php echo $total;?></span>
                </div>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 form-group'>
                <button class='form-control btn btn-primary submit-button' type='submit'>Pay »</button>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 error form-group hide'>
                <div class='alert-danger alert'>
                  Please correct the errors and try again.
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class='col-md-4'></div>
    </div>
</div>

<?php
	} else {
		die('Error processing');
	}
} else {
	message("bad", " You must be logged in to do this! <a href=\"login.php\">Log in</a>");
  }
  
output_page_footer();
output_html5_footer();

?>