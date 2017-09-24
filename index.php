<?php
include_once 'config.php';

session_start();

// if(!$user->is_loggedin())
// {
//  $user->redirect('login.php');
// }
$username = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM customer WHERE username=:username");
$stmt->execute(array(":username"=>$username));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

$ktp = $userRow['noktp'];
 print $ktp;
 echo "index berhasil";
 ?>
 <a href="logout.php?logout=true" name="logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>