<?php
require('db.php'); 
isLoggedin();
$user_id = $_SESSION['id'];
$cartCount = $mysqli->query("SELECT COUNT(`id`) AS `cnt` FROM `cart` WHERE `user_id`='$user_id'");
foreach($cartCount as $cnt){
  if($cnt['cnt']==0){
    header('location:index.php');
    exit();
  }
}
if(isset($_POST['checkout'])){
    $user_id = $_SESSION['id'];
    $name = $_POST['firstname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $cardname = $_POST['cardname'];
    $cardnumber = $_POST['cardnumber'];
    $expmonth = $_POST['expmonth'];
    $expyear = $_POST['expyear'];
    $cvv = $_POST['cvv'];
    $sameadr = 0;
    if(isset($_POST['sameadr'])){
        $sameadr = 1;
    }
    $cartIdsarr = array();
    $total=0;
    $carts = $mysqli->query("SELECT c.`id`,s.`name`,s.`image`,s.`price`,c.`quantity` FROM `cart` AS `c` LEFT JOIN `seeds` AS `s` ON `s`.`id`=`c`.`seed_id` WHERE `c`.`user_id`='$user_id'");
      foreach($carts AS $cart){
        $total += $cart['price']*$cart['quantity'];
        array_push($cartIdsarr,$cart['id']);
      }
      $gst = $total*0.05;
      $grandTotal = $total+$gst;
     
    $mysqli->query("INSERT INTO `order`(`user_id`, `name`, `email`, `address`, `city`, `state`, `zip`, `cardname`, `cardnumber`, `expmonth`, `expyear`, `cvv`, `sameadr`, `subtotal`, `gst`, `totalAmount`) VALUES ('$user_id','$name','$email','$address','$city','$state','$zip','$cardname','$cardnumber','$expmonth','$expyear','$cvv','$sameadr','$total','$gst','$grandTotal')");
    $order_id = $mysqli->insert_id;
    $cartIds = implode(',',$cartIdsarr);
    if($order_id!=''){
        $carts = $mysqli->query("SELECT c.`id`,s.`id`,s.`price`,c.`quantity` FROM `cart` AS `c` LEFT JOIN `seeds` AS `s` ON `s`.`id`=`c`.`seed_id` WHERE `c`.`id` IN ($cartIds)");
        foreach($carts AS $cart){
            $mysqli->query("INSERT INTO `order_items`(`user_id`, `order_id`, `seed_id`, `price`,`quantity`) VALUES ('$user_id','$order_id','".$cart['id']."','".$cart['price']."','".$cart['quantity']."')");
        }
        $mysqli->query("DELETE FROM `cart` WHERE `id` IN ($cartIds)");
    }
    $_SESSION['success']['data']="Thank You your products will be delivered by this week";
    header('location:index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>

<h2> Checkout Way</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="checkout.php" method="POST">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Aditya Bohade">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="abcd@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="XIE,Mahim">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="MUMBAI">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="MH">
              </div>
              <div class="col-50">
                <label for="zip">Pin Code</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="Aditya Bohade">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="password" id="cvv" name="cvv" placeholder="***">
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" value="Continue to checkout" name="checkout" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <h4>Cart <span class="price" style="color:black"></span></h4>
      <?php
      $user_id=$_SESSION['id'];
      $total=0;
      $carts = $mysqli->query("SELECT c.`id`,s.`name`,s.`image`,s.`price`,c.`quantity` FROM `cart` AS `c` LEFT JOIN `seeds` AS `s` ON `s`.`id`=`c`.`seed_id` WHERE `user_id`='$user_id'");
      foreach($carts AS $cart){
        $total += $cart['price']*$cart['quantity'];
      ?>
        <p><?= $cart['name'] ?> <span class="price">Rs. <?= $cart['price']*$cart['quantity'] ?></span></p>
      <?php } ?>
      <hr>
      <p>SubTotal <span class="price" style="color:black"><b>Rs. <?= $total ?></b></span></p>
      <p>GST <span class="price" style="color:black"><b>Rs. <?= $total*0.05 ?></b></span></p>
      <p>Grand Total <span class="price" style="color:black"><b>Rs. <?= $total+($total*0.05) ?></b></span></p>
    </div>
  </div>
</div>

</body>
</html>
