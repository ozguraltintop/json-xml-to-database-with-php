<?php

require_once('file.php');
class Encode
{
	public function encodeXml($request,$sirket)
	{
		$file  =  new Fileprocess;
		$veri    = simplexml_load_file($request);
		$json    = json_encode($veri);
		$array   = json_decode($json,TRUE);
		//echo var_dump($array);
		
		if(isset($array['product']))
		{
				foreach($array['product'] as $va)
			{
				$name    =  $va['@attributes']['name'];
				$price   =  $va['@attributes']['price'];
				$image   =  $va['@attributes']['image'];
				$fix     =  $sirket."&&".$name."&&".$price."&&".$image;
				$file->store($fix);
			}		
			
		}
		else
		{
				foreach($array['urunler'] as $va)
			{
				$name    =  $va['@attributes']['isim'];
				$price   =  $va['@attributes']['fiyat'];
				$image   =  $va['@attributes']['resim'];
				$fix     =   $sirket."&&".$name."&&".$price."&&".$image;
				$file->store($fix);	
			}
			
		}		
	}

	public function encodeJson($request,$sirket)
	{
		$file  =  new Fileprocess;
		$jsonCont = file_get_contents($request); 
		$content  = json_decode($jsonCont, true); 
		//print_r(var_dump($content));

		if(isset($content['urunler']))
		{
				foreach($content['urunler'] as $va)
			{
				$name    =  $va['isim'];
				$price   =  $va['fiyat'];
				$image   =  $va['resim'];
				$fix     =  $sirket."&&".$name."&&".$price."&&".$image;
				$file->store($fix);
			}
		}
		else
		{
				foreach($content['products'] as $va)
			{
				$name    =  $va['name'];
				$price   =  $va['price'];
				$image   =  $va['image'];
				$fix     =  $sirket."&&".$name."&&".$price."&&".$image;
				$file->store($fix);
			}
		}				
	}

	public function fileSearch($dosyalar,$toplamDosya)
	{
			for ($i = 0; $i < $toplamDosya; $i++)
			{
				echo "<b>".stristr($dosyalar[$i], ".",false)." </b>dosya türü yükleniyor.<br />";
				echo "<p style='color:green'>".$dosyalar[$i] . "</p> ";
				

				$dosya    = $dosyalar[$i];
				$dosyaTur = stristr($dosyalar[$i], ".",false);
				$firma    = stristr($dosyalar[$i], ".",true);
				$sirket   = stristr($firma , "/",false);
				if ($dosyaTur == '.json')
				{
					$result = $this->encodeJson($dosya,$sirket);
					echo $result;
				}

				else if ($dosyaTur == '.xml')
				{
					$result = $this->encodeXml($dosya,$sirket);
					echo $result;
				}

				else
				{
					echo $dosya." <b style='color:red'>uygun tipte bir dosya değil.</b>";
				}
				echo "<hr>";
			}			
	}
}


?>