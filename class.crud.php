<?php

class crud
{
 private $db;
 
  function __construct($DB_con)
  {
    $this->db = $DB_con;
  }

public function datakeranjang($query,$ktp)
 {
  $stmt = $this->db->prepare($query);
  $stmt->bindparam(":nktp",$ktp);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
    ?>
                <tr>
                <td><?php print($row['judul']); ?></td>
                <td></td>
                <td><?php print('Rp '.$row['harga']); ?></td>
                <td><?php print($row['jumlah']); ?></td>
                <td><?php print('Rp '.($row['harga'] * $row['jumlah'])); ?></td>
                <td></td>
                <td align="center">
                  <a href="cart1.php?delete_judulbuku=<?php print($row['judul']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </td>
                </tr>
                <?php
   }
  }
  else
  {
   ?>
            <tr>
            <td>Tidak Ada Data</td>
            </tr>
            <?php
  }
  
 }

 public function datakeranjang3($query,$ktp)
 {
  $stmt = $this->db->prepare($query);
  $stmt->bindparam(":nktp",$ktp);
  $stmt->execute();
 
  if($stmt->rowCount()>0)
  {
   while($row=$stmt->fetch(PDO::FETCH_ASSOC))
   {
    ?>
                <tr>
                <td></td>
                <td><?php print($row['judul']); ?></td>
                <td></td>
                <td><?php print('Rp '.$row['harga']); ?></td>
                <td><?php print($row['jumlah']); ?></td>
                <td></td>
                <td></td>
                <td><?php print('Rp '.($row['harga'] * $row['jumlah'])); ?></td>
                <td></td>
                </td>
                </tr>
                <?php
   }
  }
  else
  {
   ?>
            <tr>
            <td>Tidak Ada Data</td>
            </tr>
            <?php
  }
  
 }

public function transaksi($isbn,$tanggal,$notrans,$idpeg,$noktp,$jmlh,$harga)
{
  try
  {
   $stmt = $this->db->prepare("INSERT INTO `rpl-oot`.`transaksi` (`isbn`, `tanggal`, `no_transaksi`, `id_peg`, `username`, `jumlah`, `harga`, `status`) VALUES (:isbn, :tanggal, :notrans, :idpeg, :noktp, :jmlh, :harga, 0);");

   $stmt->bindparam(":isbn",$isbn);
   $stmt->bindparam(":tanggal",$tanggal);
   $stmt->bindparam(":notrans",$notrans);
   $stmt->bindparam(":idpeg",$idpeg);
   $stmt->bindparam(":noktp",$noktp);
   $stmt->bindparam(":jmlh",$jmlh);
   $stmt->bindparam(":harga",$harga);
   $stmt->execute();
   return true;
  }
 catch(PDOException $e)
 {
   echo $e->getMessage(); 
   return false;
 }

}

public function inskeranjang($ktp,$isbn,$jmlh,$total)
{
  try
  {
   $stmt = $this->db->prepare("INSERT INTO `keranjang` (`username`, jumlah, `isbn`, totalharga) VALUES (:nktp, :jmlh, :isbn, :total)");

   $stmt->bindparam(":nktp",$ktp);
   $stmt->bindparam(":jmlh",$jmlh);
   $stmt->bindparam(":isbn",$isbn);
   $stmt->bindparam(":total",$total);
   $stmt->execute();
   return true;
  }
 catch(PDOException $e)
 {
   echo $e->getMessage(); 
   return false;
 }

}

}
?>