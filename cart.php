<!DOCTYPE html>
<?php 
  require('db.php'); 
  isLoggedin();
  if(isset($_POST['remove'])){
    $cartId=$_POST['cartId'];
    $mysqli->query("DELETE FROM `cart` WHERE `id`='$cartId'");
    $_SESSION['danger']['data']="Product Removed from Cart Successfully";
  }
  $user_id = $_SESSION['id'];
  $cartCount = $mysqli->query("SELECT COUNT(`id`) AS `cnt` FROM `cart` WHERE `user_id`='$user_id'");
  foreach($cartCount as $cnt){
    if($cnt['cnt']==0){
      header('location:index.php');
      exit();
    }
  }
  
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
</head>
<body>
    <header id="site-header">
        <div class="container">
          <h1>Shopping cart </h1>
        </div>
        <?php include 'session.php'; ?>
      </header>
      <div class="container">
        <section id="cart"> 
          <?php
          $user_id = $_SESSION['id'];
          $subtotal = 0;
          $carts = $mysqli->query("SELECT c.`id`,s.`name`,s.`image`,s.`price`,c.`quantity` FROM `cart` AS `c` LEFT JOIN `seeds` AS `s` ON `s`.`id`=`c`.`seed_id` WHERE `user_id`='$user_id'");
          foreach($carts as $cart){
            $subtotal+=$cart['price']*$cart['quantity'];
          ?>
            <article class="product">
              <header>
                  <img class="img-fluid "
                    src="./img/seeds/<?= $cart['image'] ?>" alt="Sample">
              </header>
      
              <div class="content">
      
                <h1><?= $cart['name'] ?></h1>
      
                Apple seeds are recognized fairly commonly. These small seeds, found in the core of every apple, measure about an inch long, a little over 1/4-inch wide and about 1/8-inch thick. The outside of the seed has a strong seed coat that protects the embryo inside.
      
            
              </div>

              <footer class="content">
                Quantity <?= $cart['quantity'] ?>
              <!-- <span class="qt-minus">Quantity </span><span class="qt"><?= $cart['quantity'] ?></span> -->
              <span class="qt">
                <form action="cart.php" method="post">
                  <input type="hidden" name="cartId" value="<?= $cart['id'] ?>">
                  <button type="submit" name='remove'>Remove</button>
                </form>
              </span>
                <h2 class="full-price">
                  Rs.<?= $cart['price']*$cart['quantity'] ?> /-
                </h2>

              </footer>
            </article>
          <?php } ?>
    
        </section>
    
      </div>
    
      <footer id="site-footer">
        <div class="container clearfix">
    
          <div class="left">
            <h2 class="subtotal">Subtotal: <span>Rs.<?= $subtotal ?> /-</span></h2>
            <h3 class="tax">Taxes (5%): <span>Rs.<?= $subtotal*0.05 ?> /-</span></h3>
            <h3 class="shipping">Shipping: <span>Rs.0 /-</span> (Free Delivery) </h3>
          </div>
    
          <div class="right">
            <h1 class="total">Total: <span>Rs.<?= $subtotal+($subtotal*0.05) ?></span></h1>
            <a class="btn" href="checkout.php">Checkout</a>
          </div>
    
        </div>
      </footer>
</body>
<style>
    body {
  background: #eee;
  margin: 0;
  padding: 0;
  overflow-x: hidden;
}

.clearfix {
  content: "";
  display: table;
  clear: both;  
}

#site-header, #site-footer {
  background: #fff;
}

#site-header {
  margin: 0 0 30px 0;
}

#site-header h1 {
  font-size: 31px;
  font-weight: 300;
  padding: 40px 0;
  position: relative;
  margin: 0;
}

a {
  color: #000;
  text-decoration: none;

  -webkit-transition: color .2s linear;
  -moz-transition: color .2s linear;
  -ms-transition: color .2s linear;
  -o-transition: color .2s linear;
  transition: color .2s linear;
}

a:hover {
  color: #53b5aa;
}

#site-header h1 span {
  color: #53b5aa;
}

#site-header h1 span.last-span {
  background: #fff;
  padding-right: 150px;
  position: absolute;
  left: 217px;

  -webkit-transition: all .2s linear;
  -moz-transition: all .2s linear;
  -ms-transition: all .2s linear;
  -o-transition: all .2s linear;
  transition: all .2s linear;
}

#site-header h1:hover span.last-span, #site-header h1 span.is-open {
  left: 363px;
}

#site-header h1 em {
  font-size: 16px;
  font-style: normal;
  vertical-align: middle;
}

.container {
  font-family: 'Open Sans', sans-serif;
  margin: 0 auto;
  width: 980px;
}

#cart {
  width: 100%;
}

#cart h1 {
  font-weight: 300;
}

#cart a {
  color: #53b5aa;
  text-decoration: none;

  -webkit-transition: color .2s linear;
  -moz-transition: color .2s linear;
  -ms-transition: color .2s linear;
  -o-transition: color .2s linear;
  transition: color .2s linear;
}

#cart a:hover {
  color: #000;
}

.product.removed {
  margin-left: 980px !important;
  opacity: 0;
}

.product {
  border: 1px solid #eee;
  margin: 20px 0;
  width: 100%;
  height: 195px;
  position: relative;

  -webkit-transition: margin .2s linear, opacity .2s linear;
  -moz-transition: margin .2s linear, opacity .2s linear;
  -ms-transition: margin .2s linear, opacity .2s linear;
  -o-transition: margin .2s linear, opacity .2s linear;
  transition: margin .2s linear, opacity .2s linear;
}

.product img {
  width: 100%;
  height: 100%;
}

.product header, .product .content {
  background-color: #fff;
  border: 1px solid #ccc;
  border-style: none none solid none;
  float: left;
}

.product header {
  background: #000;
  margin: 0 1% 20px 0;
  overflow: hidden;
  padding: 0;
  position: relative;
  width: 24%;
  height: 195px;
}

.product header:hover img {
  opacity: .7;
}

.product header:hover h3 {
  bottom: 73px;
}

.product header h3 {
  background: #53b5aa;
  color: #fff;
  font-size: 22px;
  font-weight: 300;
  line-height: 49px;
  margin: 0;
  padding: 0 30px;
  position: absolute;
  bottom: -50px;
  right: 0;
  left: 0;

  -webkit-transition: bottom .2s linear;
  -moz-transition: bottom .2s linear;
  -ms-transition: bottom .2s linear;
  -o-transition: bottom .2s linear;
  transition: bottom .2s linear;
}

.remove {
  cursor: pointer;
}

.product .content {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 140px;
  padding: 0 20px;
  width: 75%;
}

.product h1 {
  color: #53b5aa;
  font-size: 25px;
  font-weight: 300;
  margin: 17px 0 20px 0;
}

.product footer.content {
  height: 50px;
  margin: 6px 0 0 0;
  padding: 0;
}

.product footer .price {
  background: #fcfcfc;
  color: #000;
  float: right;
  font-size: 15px;
  font-weight: 300;
  line-height: 49px;
  margin: 0;
  padding: 0 30px;
}

.product footer .full-price {
  background: #53b5aa;
  color: #fff;
  float: right;
  font-size: 22px;
  font-weight: 300;
  line-height: 49px;
  margin: 0;
  padding: 0 30px;

  -webkit-transition: margin .15s linear;
  -moz-transition: margin .15s linear;
  -ms-transition: margin .15s linear;
  -o-transition: margin .15s linear;
  transition: margin .15s linear;
}

.qt, .qt-plus, .qt-minus {
  display: block;
  float: left;
}

.qt {
  font-size: 19px;
  line-height: 50px;
  width: 70px;
  text-align: center;
}

.qt-plus, .qt-minus {
  background: #fcfcfc;
  border: none;
  font-size: 30px;
  font-weight: 300;
  height: 100%;
  padding: 0 20px;
  -webkit-transition: background .2s linear;
  -moz-transition: background .2s linear;
  -ms-transition: background .2s linear;
  -o-transition: background .2s linear;
  transition: background .2s linear;
}

.qt-plus:hover, .qt-minus:hover {
  background: #53b5aa;
  color: #fff;
  cursor: pointer;
}

.qt-plus {
  line-height: 50px;
}

.qt-minus {
  line-height: 47px;
}

#site-footer {
  margin: 30px 0 0 0;
}

#site-footer {
  padding: 40px;
}

#site-footer h1 {
  background: #fcfcfc;
  border: 1px solid #ccc;
  border-style: none none solid none;
  font-size: 24px;
  font-weight: 300;
  margin: 0 0 7px 0;
  padding: 14px 40px;
  text-align: center;
}

#site-footer h2 {
  font-size: 24px;
  font-weight: 300;
  margin: 10px 0 0 0;
}

#site-footer h3 {
  font-size: 19px;
  font-weight: 300;
  margin: 15px 0;
}

.left {
  float: left;
}

.right {
  float: right;
}

.btn {
  background: #53b5aa;
  border: 1px solid #999;
  border-style: none none solid none;
  cursor: pointer;
  display: block;
  color: #fff;
  font-size: 20px;
  font-weight: 300;
  padding: 16px 0;
  width: 290px;
  text-align: center;

  -webkit-transition: all .2s linear;
  -moz-transition: all .2s linear;
  -ms-transition: all .2s linear;
  -o-transition: all .2s linear;
  transition: all .2s linear;
}

.btn:hover {
  color: #fff;
  background: #429188;
}

.type {
  background: #fcfcfc;
  font-size: 13px;
  padding: 10px 16px;
  left: 100%;
}

.type, .color {
  border: 1px solid #ccc;
  border-style: none none solid none;
  position: absolute;
}

.color {
  width: 40px;
  height: 40px;
  right: -40px;
}

.red {
  background: #cb5a5e;
}

.yellow {
  background: #f1c40f;
}

.blue {
  background: #3598dc;
}

.minused {
  margin: 0 50px 0 0 !important;
}

.added {
  margin: 0 -50px 0 0 !important;
}
</style>
</html>