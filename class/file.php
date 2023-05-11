<?php 
require_once('dbclass.php');

class Fileprocess
{
	public function store($a)
	{
		ob_start();
		$dat = new db(); 

		$array1 = explode("&&", $a);
		//var_dump($array1);

		$sirket = $array1[0];
		$isim   = $array1[1];
		$fiyat  = $array1[2];
		$url    = $array1[3];
		
		$dat->ekle("product", "name,price,url,sirket", array($isim,$fiyat,$url,$sirket));
		echo $isim.'<u>  eklendi</u></br>';
		$dat->kapat();
		ob_end_flush();
	}
}


?>