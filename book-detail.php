<?php
include_once 'config.php';
require_once 'php/dbmanager.php';
require_once 'php/customer.php';

session_start();

$username = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM customer WHERE username=:username");
$stmt->execute(array(":username"=>$username));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$ktp = $userRow['username'];



if(isset($_GET['isbn']))
{
	$isbn = $_GET['isbn'];
}

$stmt = Customer::viewbookinfo($isbn);
$res = $stmt->fetch(PDO::FETCH_NUM);


if(isset($_POST['tambah']))
{
	$jmlh = $_POST['itmbh'];
	$isbn = $_GET['isbn'];
	$total = $res[2]*$jmlh;
	if($crud->inskeranjang($ktp,$isbn,$jmlh,$total))
 	{
  		//$user->redirect('book-detail.php');
		header('Location: book-detail.php?isbn='.$isbn);
 	}

}
?>

<!DOCTYPE HTML>
<html>
<title>Bookstore</title>
<head>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href=""> Bookstore</a>
		</div>
		<div>
			<ul class="nav navbar-nav">
				<li><a href="homepage.php">Beranda</a></li>
				<li><a href="sewa.php">Bantuan</a></li>
				<li><a href="sewa.php">Kategori</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
				<form class="form-inline" role="form" action="search-book.php" method="post">
				<div class="input-group" style="margin-left:2%;padding-top:5px;float:left;margin-right:50px;">
					<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
					<input type="text" class="form-control" placeholder="judul buku, pengarang" name="keyword">
				</div>
				</form>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown"><strong>
					<span class="glyphicon glyphicon-shopping-cart"></span>
					<?php
						
					?></strong>
					<ul class="dropdown-menu">
					  <li><a href="cart1.php">Lihat</a></li>
					  <li><a href="cart1.php">Check out</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<?php
						if(isset($_SESSION['user_session']))
						{
					?>
					<a class="dropdown-toggle" data-toggle="dropdown"><strong>
					<span class="glyphicon glyphicon-user"></span>
					<?php echo $_SESSION['user_session'];?>
					</strong>
					<ul class="dropdown-menu">
					  <li><a href="#">Settings</a></li>
					  <li><a href="#">Menuju Kasir</a></li>
					  <li><a href="logout.php?logout=true">Logout</a></li>
					</ul>
					<?php
						}
						else
						{
					?>
						<a href="login.php">Login</a>
					<?php
						}
					?>
				</li>
			</ul>
		</div>
	</div>
</div>
<br><br><br><br>
<div class="row">
<div id="book-section">
<div class="col-md-7" id="book-sect">
	<h2 id="book-title"><?php echo $res[1];?></h2>
	<div class="row">
	<div class="col-md-6" style="text-align:center;">
		<img src="../rpl/image/<?php echo $_GET['isbn']?>.jpg">
	</div>
	
	<div class="col-md-6" id="book-info">
		<div class="panel-group">
			<div class="panel panel-primary">
				<div class="panel-heading" id="price"><?php echo "Rp.".number_format($res[2]);?></div>
			</div>
		</div>
		<form class="form-horizontal" role="form" method="POST">
		<div class="panel-body">
				
			<p>Pengarang :<strong><?php echo $res[3];?></strong></p>
			<p>Penerbit:<strong>-</strong></p>
			<p>Tahun terbit:<strong><?php echo $res[4];?></strong></p>
			<p>Kategori:<strong><?php echo $res[5];?></strong></p>
			<p>ISBN:<strong><?php echo $res[0];?></strong><p>
			<br>
			<input id="count" type="number" min="1" name="itmbh">
			<button class="btn btn-default btn-sm" role="button" id="addcart" type="submit" name="tambah">
			<span class="glyphicon glyphicon-shopping-cart"></span>
			Tambah</button>
			<br><br>
			<a href="cart1.php" class="btn btn-success btn-md" role="button" id="buy" type="submit" name="beli">
			<span class="glyphicon glyphicon-ok"></span>
			Beli&nbsp</a>
		</div>
		</form>
	</div>
	</div>
	<br><br><br><br><br><br>
	
</div>
</div>

<div class="col-md-4">	
	<div id="right-sect">
		<div class="panel panel-primary">
			<div class="panel-heading">Rekomendasi</div>
		</div>
		<ul class="list-group">
		<?php
		$res2 = Customer::viewrecommend($isbn,$res[5]);
		while($row = $res2->fetch(PDO::FETCH_NUM))
		{
		?>
		<li class="list-group-item"><a href="book-detail.php?isbn=<?php echo $row[0];?>"><?php echo $row[1];?></a></li>
		<?php
		}
		?>
		</ul>
	</div>
</div>
</div>

<br>
<div class="row">
	<div class="col-md-7" id="book-synopsis">
	<h3 id="book-title">Sinopsis</h3>
	<p>
	<?php echo $res[6];?>
	</p>
	</div>
</div>
</body>
</html>