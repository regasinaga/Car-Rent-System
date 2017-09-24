<?php
include_once 'config.php';

session_start();

$username = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM customer WHERE username=:username");
$stmt->execute(array(":username"=>$username));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$ktp = $userRow['username'];




?>

<!DOCTYPE html>
<html lang="en">
<title>Bookstores</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>
  footer {
      background-color: #f2f2f2;
      padding: 25px;
      bottom: 0;
      position: relative;
      width: 100%;
  }
</style>
<body>
  <div class="row">
    <div class="col-md-12">
      <nav class="navbar navbar-inverse" style="border-radius: 10px 10px 10px 10px">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Bookstores</a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#" style="pointer-events: none; cursor: default">1. Sign In</a></li>
              <li class="active"><a href="#" style="pointer-events: none; cursor: default">2. Shipping & Payment</a></li>
              <li><a href="#" style="pointer-events: none; cursor: default">3. Review + Purchase</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <form class="login" method="POST" action="cart3.php">
  <div class="row" style="margin-right: 0px; margin-bottom: 20px">
    <div class="col-md-2"></div>
    <div class="col-md-6">
      <div class="col-md-12" style="padding-right: 30px">
        <h4>BILLING ADDRESS</h4>
        <div class="row">
          <div class="col-md-6">
            <div class="col-md-12" style="margin-top: 15px">
              <div class="form-group">
                <label for="usr">First Name:</label>
                <input type="text" class="form-control" id="fname" name="fname">
              </div>
              <div class="form-group">
                <label for="usr">Apartment/Suite:</label>
                <input type="text" class="form-control" id="apart" name="apart">
              </div>
              <div class="form-group">
                <label for="usr">State/Province:</label>
                <input type="text" class="form-control" id="provin" name="provin">
              </div>
              <div class="form-group">
                <label for="usr">Country:</label>
                <input type="text" class="form-control" id="country" name="country">
              </div>
              <div class="form-group">
                <label for="usr">Email Address:</label>
                <input type="text" class="form-control" id="email" name="email">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="col-md-12" style="margin-top: 15px">
              <div class="form-group">
                <label for="usr">Last Name:</label>
                <input type="text" class="form-control" id="lname" name="lname">
              </div>
              <div class="form-group">
                <label for="usr">Address:</label>
                <input type="text" class="form-control" id="address" name="address">
              </div>
              <div class="form-group">
                <label for="usr">City:</label>
                <input type="text" class="form-control" id="city" name="city">
              </div>
              <div class="form-group">
                <label for="usr">ZIP/Post Code:</label>
                <input type="text" class="form-control" id="postcode" name="postcode">
              </div>
              <div class="form-group">
                <label for="usr">Phone Number:</label>
                <input type="text" class="form-control" id="phone" name="phone">
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="margin-top: 15px">
          <div class="col-md-12">
            <h4>PAYMENT METHOD</h4>
            <div class="col-md-12" style="margin-top: -10px">
              <div class="radio">
                <label><input type="radio" name="payment" value="Cash On Delivery">Cash On Delivery</label>
              </div>
              <div class="radio">
                <label><input type="radio" name="payment" value="Transfer ATM">Transfer ATM</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="margin-top: 15px">
          <div class="col-md-12">
            <h4>SHIPPING METHOD</h4>
            <div class="col-md-12" style="margin-top: -10px">
              <div class="radio">
                <label><input type="radio" name="shipmethod">Economy (5-7 Business days) Free Shipping</label>
              </div>
              <div class="radio">
                <label><input type="radio" name="shipmethod">Priority (3-5 Business days)</label>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="margin-top: 25px; margin-bottom: 10px">
          <div class="col-md-12">
            <button type="submit" class="btn btn-success btn-sm" name="contcart2" style="display: block; margin: 0 auto">Continue<span class="glyphicon glyphicon-menu-right"></span></button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="col-md-12" style="border-style: groove; border-radius: 10px 10px 10px 10px">
       <h4>CART SUMMARY</h4>
       <div class="row">
         <div class="col-md-12">
           <div style="display: inline-block">
            <div><h5>Subtotal*:</h5></div>
            <div><h5>Fee Shipping*:</h5></div>
            <div><h5>Tax:</h5></div>
            <div style="margin-top: 15px"><h4>Total:</h4></div>
          </div>
          <div style="display: inline-block; text-align: right; margin-left: 30px">
          <?php
              $stmt = $DB_con->prepare("SELECT SUM(totalharga) AS Total FROM keranjang where username=:nktp");
              $stmt->execute(array(":nktp"=>$ktp));
              $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
              $total = $userRow['Total'];
          ?>
            <div><h5><?php echo 'Rp '.$total.'.00'; ?></h5></div>
            <div><h5>Rp0.00</h5></div>
            <div><h5>Rp0.00</h5></div>
            <div style="margin-top: 15px"><h4><?php echo 'Rp '.$total.'.00'; ?></h4></div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 5px">
        <div class="col-md-12">
          <p style="font-size: 11.5px; text-align: justify">Actual sales tax and shipping fee will be calculated later upon entry of your shipping address.
            *Excluding TAX</p>
          </div>
        </div>
      </div>   
    </div>
    <div class="col-md-2"></div>
  </div>
  </form>
  <footer class="container-fluid text-center">
    <p>BookStore Copyright</p>  
  </footer>
</body>
</html>