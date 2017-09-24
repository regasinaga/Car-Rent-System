<?php
require 'php/dbmanager.php';
require 'php/customer.php';
session_start();
?>
<!DOCTYPE HTML>
<html>
<title>Famous Bookstore</title>
<head>
<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
<script src="bootstrap/js/tests/vendor/jquery.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
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
					  <li><a href="#">Lihat</a></li>
					  <li><a href="#">Check out</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<?php
						if(isset($_SESSION['user_session'])){
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
						else{
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
<div class="row" style="margin-left:50px;margin-right:50px;">
<div class="col-md-2">
<div class="panel panel-default">
		<div class="panel-body">Kategori</div>
		</div>
		<ul class="list-group">
		<?php
			$res = Customer::viewcategory();
			while($row = $res->fetch(PDO::FETCH_NUM))
			{
				$cat = $row[0];
				?>
				<li class="list-group-item">
					<a href="category.php?based=<?php echo $cat; ?>">
				<?php
					echo $cat;
				?>
					</a>
				</li>
				<?php
			}
		?>
		</ul>
</div>
<div class="col-md-10">
<h2 id="book-title">Kategori <?php echo $_GET['based'];?></h2>
<div class="panel panel-success">
		<div class="panel-heading">Paling Populer</div>
		<div class="panel-body">
			<?php
				$cat = $_GET['based'];
				$res = Customer::viewpopular("b.kategori = '$cat'");
				while($row = $res->fetch(PDO::FETCH_NUM))
				{
			?>
			<div class="col-md-2">
				<a href="book-detail.php?isbn=<?php echo $row[0];?>">
					<img src="../rpl/image/<?php echo $row[0];?>.jpg" width="150" height="225">
				</a>
				<div class="titlebook">
				<p><?php echo $row[1];?></p>
				</div>
				<p class="price"><strong><?php echo "Rp.".number_format($row[3]);?></strong><p> 
			</div>
			<?php
				}
			?>
		</div>
</div>
<br>
<h2 id="book-title">Lainnya</h2>
<?php
	$cat = $_GET['based'];
	$res = Customer::viewbookfromcategory($cat);
				
	$count = 0;
	while($row = $res->fetch(PDO::FETCH_NUM))
	{
		if($count % 5 == 0){
?>
			<div class="panel panel-default">
			<div class="panel-heading"></div>
			<div class="panel-body">
					
			<div class="col-md-2">
			<a href="book-detail.php?isbn=<?php echo $row[0];?>">
			<img src="../rpl/image/<?php echo $row[0];?>.jpg" width="150" height="225">
			</a>
			<div class="titlebook">
			<p><?php echo $row[1];?></p>
			</div>
			<p class="price"><strong><?php echo "Rp.".number_format($row[2]);?></strong><p> 
			</div>
<?php
		}
		else{
?>
			<div class="col-md-2">
			<a href="book-detail.php?isbn=<?php echo $row[0];?>">
			<img src="../rpl/image/<?php echo $row[0];?>.jpg" width="150" height="225">
			</a>
			<div class="titlebook">
			<p><?php echo $row[1];?></p>
			</div>
			<p class="price"><strong><?php echo "Rp.".number_format($row[2]);?></strong><p> 
			</div>
<?php
		}
		$count++;
	}
?>
</div>
</div>
</div>
</div>
</body>
</html>