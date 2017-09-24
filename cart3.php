<?php
include_once 'config.php';

session_start();

$username = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM customer WHERE username=:username");
$stmt->execute(array(":username"=>$username));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$ktp = $userRow['username'];

$stmt = $DB_con->prepare("SELECT isbn FROM keranjang where username=:nktp");
$stmt->execute(array(":nktp"=>$ktp));
$isbnarr=array();
while($userRow = $stmt->fetch(PDO::FETCH_ASSOC)){
	$isbnarr[] = $userRow['isbn'];
}

$stmt = $DB_con->prepare("select b.harga, k.jumlah from buku b,keranjang k where b.isbn = k.isbn and k.username=:nktp");
$stmt->execute(array(":nktp"=>$ktp));
$hargaarr=array();
$jmlharr=array();
while($userT = $stmt->fetch(PDO::FETCH_ASSOC)){
	$hargaarr[] = $userT['harga'];
	$jmlharr[] = $userT['jumlah'];
}


/* $fname = $_POST['fname'];
$lname = $_POST['lname'];
$apart = $_POST['apart'];
$country = $_POST['country'];
$provin = $_POST['provin'];
$email = $_POST['email'];

$city = $_POST['city'];
$postcode = $_POST['postcode'];
$phone = $_POST['phone'];
*/

$tanggal = date('Y-m-d');
$idpeg = 0;
$notrans = round(rand()*10000)+10;

if(!isset($_POST['address']) && !isset($_POST['address'])){
	$address = $_SESSION['address'];
	$payment = $_SESSION['payment'];
}
else{
	$address = $_POST['address'];
	$payment = $_POST['payment'];
	
	$_SESSION['address'] = $_POST['address'];
	$_SESSION['payment'] = $_POST['payment'];
}

if(isset($_POST['purchase']))
{
	for($i=0;$i<count($isbnarr);$i++){
		if($crud->transaksi($isbnarr[$i],$tanggal,$notrans,$idpeg,$ktp,$jmlharr[$i],$hargaarr[$i]))
		{
		}
		else
		{
			header('Location: cart2.php');
		} 
	}
	$stmt = $DB_con->prepare("DELETE FROM `keranjang` WHERE username=:nktp");
	$stmt->execute(array(":nktp"=>$ktp));
    header('Location: transsukses.php');
}

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
      position: fixed;
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
              <li><a href="#" style="pointer-events: none; cursor: default">2. Shipping & Payment</a></li>
              <li class="active"><a href="#" style="pointer-events: none; cursor: default">3. Review + Purchase</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
</div>
<form class="login" method="POST">
<div class="row" style="margin-right: 0px; margin-bottom: 20px">
    <div class="col-md-2"></div>
    <div class="col-md-6">
        <div class="col-md-12" style="border-style: groove; border-radius: 10px 10px 10px 10px; padding-right: 30px">
            <div class="row" style="margin-top: 20px; border-bottom-style: solid; border-color: black; border-width: 2px">
                <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <?php
                              $query = "select b.judul, b.harga, k.jumlah from buku b,keranjang k where b.isbn = k.isbn and k.username=:nktp";
                              $crud->datakeranjang3($query,$ktp);
                            ?>
                            </tbody>
                        </table>
                        </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-3" style="vertical-align: middle; border-bottom-style: solid; border-color: black; border-width: 2px">
                  <div style="text-align: right">
                  <?php
                      $stmt = $DB_con->prepare("SELECT SUM(totalharga) AS Total FROM keranjang where username=:nktp");
                      $stmt->execute(array(":nktp"=>$ktp));
                      $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
                      $total = $userRow['Total'];
                  ?>
                        <div><h5>Subtotal:</h5></div>
                        
                    </div>
                </div>
                <div class="col-md-3" style="vertical-align: middle; border-bottom-style: solid; border-color: black; border-width: 2px">
                  <div style="text-align: right">
                        <div><h5><?php echo 'Rp '.$total.'.00'; ?></h5></div>
                        
                    </div>
                </div>
            </div>
            <div class="row" style="border-bottom-style: solid; border-color: black; border-width: 2px">
                <div class="col-md-6">
                </div>
                <div class="col-md-3" style="vertical-align: middle">
                  <div style="text-align: right">
                        <div><h5>Total:</h5></div>
                    </div>
                </div>
                <div class="col-md-3" style="vertical-align: middle">
                  <div style="text-align: right">
                        <div><h5><?php echo 'Rp '.$total.'.00'; ?></h5></div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-md-12">
                <div style="display: inline-block">
                <div><h5>Payment method:</h5></div>
                <div><h5>Bookstores account:</h5></div>
                <div><h5>Alamat:</h5></div>
                </div>
                <div style="display: inline-block; margin-left: 10px"> 
                <div><h5><?php echo $payment; ?></h5></div>
                <div><h5><?php echo $username; ?></h5></div>
                <div><h5><?php echo $address; ?></h5></div>
                </div>
                </div>
            </div>
            <div class="row" style="margin-top: 15px; margin-bottom: 20px">
          <div class="col-md-12" style="text-align: right">
            <button type="submit" class="btn btn-success btn-sm" name="purchase" style="margin: 0 auto">Purchase</button>
          </div>
        </div>
    </div>
    <h6 style="margin: 0px 0px 0px 0px">Confirmation will be emailed to your address at gmail.com<h6>
</div>
<div class="col-md-2">
    <div class="col-md-12" style="border-style: groove; border-radius: 10px 10px 10px 10px">
     <h4>Purchasing on Bookstores</h4>   
<div class="row" style="margin-top: 5px">
    <div class="col-md-12">
        <p style="font-size: 12px">Once you've completed this transaction, you'll receive on email message confirming receipt of your purchase</p>
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