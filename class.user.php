<?php
class USER
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }

    public function login($uname,$umail,$upass)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM customer WHERE username=:nameid OR email=:emailid LIMIT 1");
          $stmt->execute(array(":nameid"=>$uname, ":emailid"=>$umail));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if($userRow['password'] == $upass)
             {
                $_SESSION['user_session'] = $userRow['username'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   public function register($nama,$email,$username,$passwd,$ktp)
    {
      try
      {
       $stmt = $this->db->prepare("INSERT INTO `customer` (noktp,`nama`, `email`, `username`, `password`) VALUES (:ktp, :nama, :email, :username, :passwd)");

       $stmt->bindparam(":ktp",$ktp);
       $stmt->bindparam(":nama",$nama);
       $stmt->bindparam(":email",$email);
       $stmt->bindparam(":username",$username);
       $stmt->bindparam(":passwd",$passwd);
       $stmt->execute();
       return true;
      }
     catch(PDOException $e)
     {
       echo $e->getMessage(); 
       return false;
     }

    }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>