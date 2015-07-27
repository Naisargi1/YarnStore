<?php

require_once('config.php');

$db_connection_handle = NULL;

function db_connect()
{
  global $DBUSER, $DBPASS, $DBNAME, $db_connection_handle;

  $db_connection_handle = 
    new PDO("mysql:host=localhost;dbname=$DBNAME", $DBUSER, $DBPASS);
  $db_connection_handle->
    setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db_connection_handle->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
  $db_connection_handle->
    setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL);
}

function db_add_new_user($email, $password, $firstName, $lastName, $do_hash = TRUE)
{
  global $db_connection_handle;

  $adjusted_pass = $do_hash == TRUE ? md5($password) : $password;

  $user_array = array(':email' => $email, ':password' => $adjusted_pass, ':firstName' => $firstName, ':lastName' => $lastName);

  $sql = 'INSERT INTO Users (email, password, firstName, lastName) VALUES (:email, :password, :firstName, :lastName)';
  $st = $db_connection_handle->prepare($sql);
  $result = $st->execute($user_array);
}

function db_check_email($email)
{
	global $db_connection_handle;
	
	$user_array = array(':email' => $email);
	$sql = 'SELECT COUNT(email) FROM Users WHERE email=:email';
	
	try
	{
	$st = $db_connection_handle->prepare($sql);
    $st->execute($user_array);
    
    $result = $st->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count(email)'] == 1)
      return TRUE;
      
    else
		return FALSE;
  }
  catch (PDOException $e)
  {
    return FALSE;
  }
}	

function db_check_user($email, $password, $do_hash = TRUE)
{
  global $db_connection_handle;

  $adjusted_pass = $do_hash == TRUE ? md5($password) : $password;
  $user_array = array(':email' => $email);
  $sql = 'SELECT password FROM Users WHERE email=:email';

  try
  {
    $st = $db_connection_handle->prepare($sql);
    $st->execute($user_array);
    
    $result = $st->fetch(PDO::FETCH_ASSOC);
    
    if (strcmp($result['password'], $adjusted_pass) == 0)
      return TRUE;
  }
  catch (PDOException $e)
  {
    return FALSE;
  }
}

function db_select_all_products(){
	global $db_connection_handle;
	

	$getUsers = $db_connection_handle->prepare("SELECT * FROM Inventory");
	$getUsers->execute();
	$users = $getUsers->fetchAll();
	foreach ($users as $user) {
		echo $user['name'] . '<br />';
	}
}

function db_add_new_product($name, $brand, $price, $quantity, $colourway, $weight,
	$yards, $unitWeight, $fiber, $description, $image){
	global $db_connection_handle;

	$product_array = array(':name' => $name, ':brand'=>$brand, ':price'=>$price, ':quantity'=>$quantity, ':colourway'=>$colourway, ':weight'=>$weight,
	':yards'=>$yards, ':unitWeight'=>$unitWeight, ':fiber'=>$fiber, ':description'=>$description, ':image'=>$image);

	$sql = 'INSERT INTO Inventory (name, brand, price, quantity, colourway, weight,
	yards, unitWeight, fiber, description, image) VALUES (:name, :brand, :price, :quantity, :colourway, :weight,
	:yards, :unitWeight, :fiber, :description, :image)';
	$st = $db_connection_handle->prepare($sql);
	$result = $st->execute($product_array);
}

function is_admin($email){
	global $db_connection_handle;
	
	db_connect();
	
	$user_array = array(':email' => $email);
	$sql = 'SELECT admin FROM Users WHERE email=:email';
	
	try
	{
	$st = $db_connection_handle->prepare($sql);
    $st->execute($user_array);
    
    $result = $st->fetch(PDO::FETCH_ASSOC);
    
    if ($result['admin'] == 1)
      return TRUE;
      
    else
		return FALSE;
  }
  catch (PDOException $e)
  {
    return FALSE;
  }
}	

function db_get_product_by_id($id){

	global $db_connection_handle;
	db_connect();
	$sql = 'SELECT * FROM Inventory WHERE `item#`= "'.$id.'"';

	$getproduct = $db_connection_handle->prepare($sql);
	$getproduct->execute();

	$product1 = $getproduct->fetch(PDO::FETCH_ASSOC);
	
	if(isset($product1['item#'])){
		return $product1;
	}else{
		die("Product doesn't exist");
	}
}

function db_add_to_cart($user_id, $product_id, $quantity){
	global $db_connection_handle;
	
	$sql = 'INSERT INTO Cart (`user#`, `item#`, `quantity`) VALUES ('.$user_id.','.$product_id.','.$quantity.')';
	$st = $db_connection_handle->prepare($sql);
	$result = $st->execute();
	
}

function db_get_user_by_id($user){

	global $db_connection_handle;
	$sql = "SELECT * FROM Users WHERE `email`= '".$user."'";

	$getuser = $db_connection_handle->prepare($sql);
	$getuser->execute();
	
	$user = $getuser->fetch(PDO::FETCH_ASSOC);
	
	if(isset($user['user#'])){
		return $user;
	}else{
		die("User doesn't exist");
	}
}

function db_get_user_id($user){
	global $db_connection_handle;
	$sql = "SELECT * FROM Users WHERE `email`= '".$user."'";

	$getuser = $db_connection_handle->prepare($sql);
	$getuser->execute();
	
	$user = $getuser->fetch(PDO::FETCH_ASSOC);
	
	if(isset($user['user#'])){
		return $user['user#'];
	}else{
		die("User doesn't exist");
	}
}

function db_update_cart($user_id, $product_id, $quantity){
	global $db_connection_handle;

	$sql = 'UPDATE Cart SET `quantity`="'.$quantity.'" WHERE `user#`="'.$user_id.'" && `item#`="'.$product_id.'"';
	$st = $db_connection_handle->prepare($sql);
	$result = $st->execute();
}

function user_has_in_the_cart($user_id, $product_id){
	global $db_connection_handle;

	$sql = "SELECT * FROM Cart WHERE `user#`= '".$user_id."'&& `item#` ='".$product_id."' ";
	$getcart = $db_connection_handle->prepare($sql);
	$getcart->execute();
	$cart = $getcart->fetch(PDO::FETCH_ASSOC);

	if(isset($cart['quantity'])){
		return $cart['quantity'];
	}else{
		return 0;
	}
}

function get_cart($user_id){
	global $db_connection_handle;

	$sql = "SELECT * FROM Cart WHERE `user#`= '".$user_id."'";
	$getcart = $db_connection_handle->prepare($sql);
	$getcart->execute();
	$cart = $getcart->fetchAll();
	
	if(empty($cart)){
		return NULL;
	}else{
		return $cart;
	}
}

function db_select_brands_for_menu(){
	global $db_connection_handle;
	
	db_connect();
	
	$sql = 'SELECT DISTINCT brand FROM Inventory';
	
	try
	{
		$st = $db_connection_handle->prepare($sql);
		$st->execute();
		$st->setFetchMode(PDO::FETCH_ASSOC);
	
		while($result = $st->fetch()){
			echo '<li><a href="search_page.php?search='.$result['brand'].'">'.$result['brand'].'</a></li>';
		}
	}
	catch (PDOException $e)
	{
		echo ' ';
	}

}

function populate_edit_item_form($id){
	global $db_connection_handle;
	
	$item_array = array(':id' => $id);
	
	$sql = 'SELECT * FROM Inventory WHERE `item#`=:id';
	
	try
	{
		$st = $db_connection_handle->prepare($sql);
		$st->execute($item_array);
    
		$result = $st->fetch(PDO::FETCH_ASSOC);
    
		return $result;
		
	}
	catch (PDOException $e)
	{
		return array();
	}
}

function populate_edit_user_form($email){
	global $db_connection_handle;
	
	$user_array = array(':email' => $email);
	
	$sql = 'SELECT * FROM Users WHERE email=:email';
	
	try
	{
		$st = $db_connection_handle->prepare($sql);
		$st->execute($user_array);
    
		$result = $st->fetch(PDO::FETCH_ASSOC);
    
		return $result;
		
	}
	catch (PDOException $e)
	{
		return array();
	}
}

function db_edit_entry($item_array, $sql){
	global $db_connection_handle;
	
	$st = $db_connection_handle->prepare($sql);
	$result = $st->execute($item_array);
}

function is_in_carts($product_id){
	global $db_connection_handle;

	$sql = "SELECT * FROM Cart WHERE `item#`='".$product_id."'";
	$getcart = $db_connection_handle->prepare($sql);
	$getcart->execute();
	$cart = $getcart->fetchAll();
	
	if(empty($cart)){
		return FALSE;
	}else{
		return TRUE;
	}
}

function has_carts($user_id){
	global $db_connection_handle;

	$sql = "SELECT * FROM Cart WHERE `user#`='".$user_id."'";
	$getcart = $db_connection_handle->prepare($sql);
	$getcart->execute();
	$cart = $getcart->fetchAll();
	
	if(empty($cart)){
	}else{
		$sql = "DELETE FROM Cart WHERE `user#`='".$user_id."'";
		$getcart = $db_connection_handle->prepare($sql);
		$getcart->execute();	
	}
}

function db_image_exists($image){
	global $db_connection_handle;
	
	$image_array = array(':image' => $image);
	
	$sql = 'SELECT COUNT(image) FROM Inventory WHERE image=:image';
		
	try
	{
	$st = $db_connection_handle->prepare($sql);
    $st->execute($image_array);
    
    $result = $st->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count(image)'] == 1)
      return TRUE;
      
    else
		return FALSE;
  }
  catch (PDOException $e)
  {
    return FALSE;
  }
}

function db_get_current_amt($item){
	global $db_connection_handle;
	
	$item_array = array(':item' => $item);
	
	$sql = 'SELECT quantity FROM Inventory WHERE `item#`=:item';
		
	try
	{
	$st = $db_connection_handle->prepare($sql);
    $st->execute($item_array);
    
    $result = $st->fetch(PDO::FETCH_ASSOC);
    
    return $result['quantity'];
  }
  catch (PDOException $e)
  {
    return 0;
  }
}
?>
