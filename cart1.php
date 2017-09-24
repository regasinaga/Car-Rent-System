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
      position: fixed;
      width: 100%;
    }

    .table-responsive, .table{
        broder: none;
    }


</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).attr("value")=="promocod"){
                $("#promocode").toggle();
            }
        });
    });
</script>

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
                        <a class="navbar-brand" href="homepage.php">Bookstores</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="homepage.php">Continue Shopping</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <form class="form-horizontal" role="form" method="POST">
    <div class="row" style="margin-right: 0px; margin-bottom: 20px">
        <div class="col-md-2"></div>
            <div class="col-md-6">
                <div class="col-md-12" style="border-style: groove; border-radius: 10px 10px 10px 10px; padding-right: 30px">
                    <h4>SHOPPING CART</h4>
                    <div class="row" style="margin-top: 30px">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th></th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th align="center"></th>
                            </tr>
                            </thead>
                            <tbody>	
                            <?php
                              $query = "select b.judul, b.harga, k.jumlah from buku b,keranjang k where b.isbn = k.isbn and k.username=:nktp";
                              $crud->datakeranjang($query,$ktp);
                            ?>
                            </tbody>
                        </table>
                        </div>
                        <!-- <div class="col-md-4">
                            <div style="display: inline-block">
                                <img src="..." class="img-responsive" style="width: 80px; height: 100px">
                            </div>
                            <div style="display: inline-block; vertical-align: top; margin-left: 10px">
                                <div><h4>Judul</h4></div>
                                <div><h4>Pengarang</h4></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div style="text-align: right">
                                <div><h5>Rp Harga</h5></div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div style="display: inline-block">
                                <div class="form-group">
                                    <input class="form-control" id="focusedInput" type="text" placeholder="Qty" style="width: 50px">
                                </div>
                            </div>
                            <div style="display: inline-block; margin-left: 15px">
                                <button type="button" style="background: transparent; border: none !important"><span class="glyphicon glyphicon-repeat"></span></button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div style="text-align: right;">
                                <div><h4>Rp Total</h4></div>
                                <div><button type="button" class="btn btn-xs" style="background: transparent; border: none !important"><h6 style="margin: 0px 0px 0px 0px">Remove<h6></button></div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row" style="margin-bottom: 15px">
                        <div class="col-md-12">
                            <div class="checkbox" style="display: inline-block;">
                                <label><input type="checkbox" value="promocod">Enter Promo Code<span class="glyphicon glyphicon-lock" style="margin-left: 3px"></span></label>
                            </div>
                            <div id="promocode" class="collapse">
                                <div style="display: inline-block; margin-left: 35px">
                                    <div class="form-group">
                                        <input class="form-control" id="focusedInput" type="text" value="">
                                    </div>
                                </div>
                                <div style="display: inline-block; margin-left: 15px">
                                    <button type="button" class="btn btn-primary btn-sm">Apply Code</button>
                                </div>
                            </div>
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
        <div class="row" style="margin-top: 5px; margin-bottom: 10px">
            <div class="col-md-12">
                <a href="cart2.php" button type="button" class="btn btn-success btn-sm" style="display: block; margin: 0 auto">Proceed To Checkout<span class="glyphicon glyphicon-menu-right"></span></button></a>
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