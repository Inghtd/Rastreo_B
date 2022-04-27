<?php
     $const="11AFM33ZWKMOP4TT8";
     $test=base64_encode("prc=con&accion=cons_qr&gui=7547&ref=301950289");

	echo base64_decode($test)."<br>";

	$llave_parte1=substr($test,0,10);
	$llave_parte3=substr($test,10,1000);
	$llave_url=$llave_parte1.$const.$llave_parte3;
	echo $llave_url."<br>";
	echo base64_decode($llave_url)."<br>";
		
     $trozo_llave=explode($const,$test);
     echo $trozo_llave[0]."<br>";
     $llave=base64_decode($trozo_llave[0].$trozo_llave[2]);

     echo $test."<br>";
     echo $llave;
?>