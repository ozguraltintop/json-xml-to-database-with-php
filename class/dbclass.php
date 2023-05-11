<?php

class db {
 
protected $baglan;

public function __construct() {

    $dbhost = "localhost"; 
		$dbuser = "root"; 
		$dbpass = ""; 
		$dbdata = "testozgur";

	  try {
			$this->baglan = new PDO("mysql:host={$dbhost};dbname={$dbdata}",$dbuser,$dbpass,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	  	} 
	  	catch (PDOException $e) 
	  	{
	   echo "<b>HATA:Baglantı hatası</b> ". $e->getMessage();
	   $this->kapat(); exit;
	   }
}

public function kapat() 
{
    if($this->baglan) 
    	{ 
    		$this->baglan = null; 
    	}
}

public function ekle($tabloAdi, $sutunlar, $degerler) {
	$deger = "";
    foreach ($degerler as $d) {
      $deger .= ($deger == "") ? "" : ","; $deger .= "?";
    }
	   try {
    $sql = "INSERT INTO $tabloAdi ($sutunlar) VALUES ($deger)";
	$sonuc = $this->baglan->prepare($sql);
	$sonuc->execute($degerler);
    if($sonuc) { return $this->baglan->lastInsertId(); }else{ return false; }
	   } catch (PDOException $e) {
	   echo $this->hatabul($e->getTrace(), $e->getCode(), $e->getMessage(), $sql);
	   $this->kapat(); exit;
	   }
}

}
?>