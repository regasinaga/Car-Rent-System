<?php
class Customer{
	public $nama;
	public $email;
	public $username;
	public $password;
	
	public function __construct($nama,$email,$username,$password){
		$this->nama = $nama;
		$this->email = $email;
		$this->username = $username;
		$this->passtword = $password;
	}
	
	public static function viewbookfromcategory($category){
		require_once('dbmanager.php');
		$dbmanager = dbmanager::getInstance();
		
		$query = "select isbn,judul,harga from buku where kategori = :kategori";
		$stmt = $dbmanager->prepare($query);
		$stmt->bindParam(':kategori',$category);
		$stmt->execute();
		
		return $stmt;
	}
	
	public static function viewcategory(){
		require_once('dbmanager.php');
		$dbmanager = dbmanager::getInstance();
		
		$query = "select distinct kategori from buku order by kategori";
		$stmt = $dbmanager->prepare($query);
		$stmt->execute();
		
		return $stmt;
	}
	
	public static function viewbookinfo($isbn){
		require_once('dbmanager.php');
		$dbmanager = dbmanager::getInstance();
		
		$query = "select isbn,judul,harga,pengarang,tahun,kategori,sinopsis from buku where isbn = :isbn";
		$stmt = $dbmanager->prepare($query);
		$stmt->bindParam(':isbn',$isbn);
		$stmt->execute();
		
		return $stmt;
	}
	
	public static function viewlatestbook(){
		require_once('dbmanager.php');
		$dbmanager = dbmanager::getInstance();
		
		//five latest
		$query = "select isbn,judul,pengarang,harga,kategori from buku ".
					"order by tahun desc limit 5";
		$stmt = $dbmanager->prepare($query);
		$stmt->execute();
		
		return $stmt;
	}
	
	public static function viewpopular($categorystmt){
		require_once('dbmanager.php');
		$dbmanager = dbmanager::getInstance();
		
		//five most popular
		$query = "select b.isbn,b.judul,(select sum(t.jumlah) from transaksi t where t.isbn = b.isbn)as penjualan,harga ".
					"from buku b ".
					"where $categorystmt ".
					"order by penjualan desc limit 5";
		$stmt = $dbmanager->prepare($query);
		$stmt->execute();
		
		return $stmt;
	}
	
	public static function viewrecommend($notisbn,$kategori){
		require_once('dbmanager.php');
		$dbmanager = dbmanager::getInstance();
		
		$query = "select isbn,judul from buku where isbn <> :isbn and kategori = :kategori";
		$stmt = $dbmanager->prepare($query);
		$stmt->bindParam(':isbn',$notisbn);
		$stmt->bindParam(':kategori',$kategori);
		$stmt->execute();
		
		return $stmt;
	
	}
}
?>