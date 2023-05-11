<?php 

require_once('class/encode.php');

$code         = new Encode;
$dosyalar     = glob("data/*");
$toplamDosya  = count($dosyalar);


echo "<div align='center'>";
echo "<h1>log ekranı</h1>";
$code->fileSearch($dosyalar,$toplamDosya);

echo  "</div>";


?>