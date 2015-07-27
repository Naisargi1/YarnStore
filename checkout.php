<?php
require_once('lib/lib.php');
require_once('lib/dblibs.php');

output_html5_header(
  'Checkout',
  array( "bootstrap/css/bootstrap.css","bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js", "js/carousel.js")
);

if (array_key_exists('loggedin', $_SESSION)){
	if (count($_GET) == 1 && array_key_exists('user_id', $_GET)){

output_page_menu();

?>
<h1>Checkout</h1>

<div class="stepwizard">
    <div class="stepwizard-row">
        <div class="stepwizard-step">
            <a href="cart_page.php" class="btn btn-default btn-circle">1</a>
            <p>Cart</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-primary btn-circle">2</button>
            <p>Shipping</p>
        </div>
        <div class="stepwizard-step">
            <button type="button" class="btn btn-default btn-circle" disabled="disabled">3</button>
            <p>Payment</p>
        </div> 
    </div>
</div>

<div class="row">
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12">&nbsp;</div>    
	<div class="col-md-8 col-md-offset-1">
      <form class="form-horizontal" role="form">
        <fieldset>

          <legend>Shipping Address</legend>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Line 1</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Address Line 1" class="form-control" required=""/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Line 2</label>
            <div class="col-sm-10">
              <input type="text" placeholder="Address Line 2" class="form-control"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">City</label>
            <div class="col-sm-10">
              <input type="text" placeholder="City" class="form-control" required="" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">State</label>
            <div class="col-sm-4">
              <input type="text" placeholder="State" class="form-control" required=""/>
            </div>

            <label class="col-sm-2 control-label" for="textinput">Postcode</label>
            <div class="col-sm-4">
              <input type="text" placeholder="Post Code" class="form-control" required=""/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Country</label>
            <div class="col-sm-4">
               <select id="country" name="country" class="form-control">
				 <option value="United States">United States</option>
				 <option value="Canada" selected>Canada</option>
				</select> 
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-right">
                <a href="index.php" class="btn btn-default">Cancel</a>
                <a href="payment.php?user_id=<?php echo $_GET['user_id'];?>" class="btn btn-success">Next</a>
              </div>
            </div>
          </div>

        </fieldset>
      </form>
    </div>
</div>


<?php
} else {
	header('Location: index.php');
}
} else {
	message("bad", " You must be logged in to do this! <a href=\"login.php\">Log in</a>");
}

output_page_footer();
output_html5_footer();
?>