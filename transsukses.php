<!DOCTYPE html>
<html lang="en">
<title>Bookstores</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>
/*form {
    position: absolute;
    content: '';
    top: 50%;
    left: 50%;
    margin: -225px 0 0 -180px;
    width: 360px;
    height: 450px;
  }*/
  footer {
      background-color: #f2f2f2;
      padding: 25px;
      bottom: 0;
      position: fixed;
      width: 100%;
  }
  /*footer {
    background-color: lightblue;
    padding: 25px;
    position: fixed;
    bottom: 0;
    width: 100%;
  }*/
</style>
<body>
  <!-- <?php
  if(isset($error))
    {
      ?>
      <div class="alert alert-danger">
        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
      </div>
      <?php
    }
    ?> -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href=""> Bookstore</a>
        </div>
        <div>
          <ul class="nav navbar-nav">
            <li><a href="index.php">Beranda</a></li>
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
                  <li><a href="#">Lihat</a></li>
                  <li><a href="#">Check out</a></li>
                </ul>
              </li>
              </ul>
            </div>
          </div>
        </div>
        <form class="login" method="POST">
        <div class="row" style="margin-top: 120px; margin-bottom: 130px">
          <div class="col-md-2"></div>
          <div class="col-md-8">
           <div style="margin-top: 30px; margin-bottom: 40px; text-align: center;">
             <div class="alert alert-success">
             	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  				<strong>Success!</strong> <a href="homepage.php"> click here</a> to back to Home.
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