<?php
require_once 'config.php';

session_start();

if($user->is_loggedin()!="")
{
 $user->redirect('index.php');
 //$_SESSION['user_session'] = $uname;
 //echo $_SESSION['user_session'] = $uname;
}

if(isset($_POST['login']))
{
 $uname = $_POST['txtuser'];
 $umail = $_POST['txtuser'];
 $upass = $_POST['txtpass'];
  
 if($user->login($uname,$umail,$upass))
 {
  //$user->redirect('index.php');
  header('Location: http://localhost/rploot/homepage.php');
  $_SESSION['user_session'] = $uname;
//  echo $_SESSION['user_session'] = $uname;
 }
 else
 {
  $error = "Wrong Details !";
 } 
}

if(isset($_POST['regis']))
{
 $nama = $_POST['txtNamareg'];
 $email = $_POST['txtmailreg'];
 $username = $_POST['txtUserreg'];
 $passwd = $_POST['txtpassreg'];
 $ktp = $_POST['txtktp'];
  
 if($user->register($nama,$email,$username,$passwd,$ktp))
 {
  $user->redirect('regsuccess.php');
 }
 else
 {
  $error = "Wrong Details !";
 } 
}
?>

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
          <div class="col-md-8" style="border-style: groove; border-radius: 10px 10px 10px 10px">
            <!-- <div id=logo style="font-style: inherit; font-family: Informal Roman; font-size: 30px; margin-bottom: -20px">Asset Management System</div> -->
           <div style="margin-top: 30px; margin-bottom: 40px; text-align: center;">
             <h2>Bookstores ID</h2>
           </div>
          <div class="row">
          <div class="col-md-6" style="border-color: black; border-right: solid;">
          <div class="col-md-12">
            <div>
             <h3 style="margin-top: -5px"><strong>Login</strong></h3>
             <p> Login with your personal Bookstores ID below</p>
            </div>
            <div class="form-group" style="margin-top: 20px">
              <label for="usr">Username</label>
              <input type="text" class="form-control" id="user" name="txtuser" placeholder="Username/Email Address" style="height: 50px">
            </div>
            <div class="form-group" style="margin-top: 20px">
              <label for="passwd">Password</label>
              <input type="password" class="form-control" id="pass" name="txtpass" placeholder="Password" style="height: 50px">
            </div>
            <div class="form-group" style="margin-top: 20px">
              <button type="submit" class="btn btn-info btn-lg" name="login" style="height: 50px; background-color: lightblue; font-size: 20px; width: 120px">Login</button>
            </div>   
          </div>
         </div>
         <div class="col-md-6">
           <div class="col-md-12">
             <div>
             <h3 style="margin-top: -5px"><strong>Create</strong></h3>
             <p> A new free account <a data-toggle="collapse" href="#reg"> click here</a></p>
             <div id="reg" class="collapse">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group" style="margin-top: 12px">
                    <label for="usr">Username</label>
                    <input type="text" class="form-control" id="user" name="txtUserreg" placeholder="Username">
                  </div>
                  <div class="form-group" style="margin-top: -10px">
                    <label for="passwd">Choose a Password</label>
                    <input type="password" class="form-control" id="pass" name="txtpassreg" placeholder="Password">
                  </div>
                  <div class="form-group" style="margin-top: -10px">
                    <label for="passwd">Re-enter Password</label>
                    <input type="password" class="form-control" id="repass" name="txtrepassreg" placeholder="Re-enter Password">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group" style="margin-top: 20px">
                    <label for="usr">Your Name</label>
                    <input type="text" class="form-control" id="nama" name="txtNamareg" placeholder="Name">
                  </div>
                  <div class="form-group" style="margin-top: -10px">
                    <label for="passwd">Current Email Address</label>
                    <input type="text" class="form-control" id="mail" name="txtmailreg" placeholder="Email Address">
                  </div>
                  <div class="form-group" style="margin-top: -10px">
                    <label for="passwd">Nomor KTP</label>
                    <input type="text" class="form-control" id="remail" name="txtktp" placeholder="Nomor KTP">
                  </div>  
                </div>
              </div>
             <div class="form-group" style="margin-top: 20px; text-align: right;">
              <button type="submit" class="btn btn-success btn-lg" name="regis" style="height: 50px; font-size: 20px;">Join Bookstores</button>
            </div>   
             </div>
            </div>
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