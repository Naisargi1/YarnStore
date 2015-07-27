<?php
require_once('lib/lib.php');
require_once('lib/dblibs.php');

output_html5_header(
  'Contact Us',
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js", "js/tinymce/tinymce.min.js","js/ajax.js" )
);

?>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>
<?php

output_page_menu();
?>

<h1>Contact Us</h1>
<form class="form-horizontal" action="contact_send.php" method="POST">
  <fieldset>
    <div class="form-group">
      <label class="col-md-4 control-label" for="name">Name</label>
      <div class="col-md-4">
        <input id="name" name="name" type="text" placeholder="Insert your full name" class="form-control input-md" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="email">Email</label>
      <div class="col-md-4">
        <input id="email" name="email" type="email" placeholder="example@example.ca" class="form-control input-md" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="message">Your Message</label>
      <div class="col-md-4">
        <textarea name="message" id="message"></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success">Send</button>
      </div>
    </div>
  </fieldset>
</form>
<div class="row">
  <div class="col-md-4"></div>
  <strong>Or call us at: </strong><span id="myDiv">XXX-XXX-XXXX
  <button type="button" class="btn btn-default" onclick="loadXMLDoc()">Show Contact Info</button>
  </span> 
</div>
<?php
output_page_footer();
output_html5_footer();
?>
