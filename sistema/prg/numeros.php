<?php
class numeros
{
//-The_dark_roy 27 Oct 2004
//actualizado Marvin Abrego 2013

var $numeros 		=array("-", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve");
var $numerosX 		=array("-", "un", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve");
var $numeros100 	=array("-", "ciento", "doscientos", "trecientos", "cuatrocientos", "quinientos", "seicientos", "setecientos", "ochocientos", "novecientos");
var $numeros11 		=array("-", "once", "doce", "trece", "catorce", "quince", "dieciseis", "diecisiete", "dieciocho", "diecinueve");
var $numeros10 		=array("-", "-", "-", "treinta", "cuarenta", "cincuenta", "sesenta", "setenta", "ochenta", "noventa");



public function tresnumeros($n, $last) {
//global $numeros100, $numeros10, $numeros11, $numeros, $numerosX;

if ($n == 100) return "cien ";
if ($n == 0) return "cero ";
$r = "";
$cen = floor($n / 100);
$dec = floor(($n % 100) / 10);
$uni = $n % 10;
if ($cen > 0) $r .= $this->numeros100[$cen] . " ";

switch ($dec) {
case 0: $special = 0; break;
case 1: $special = 10; break;
case 2: $special = 20; break;
default: $r .= $this->numeros10[$dec] . " "; $special = 30; break;
}
if ($uni == 0) {
if ($special==30);
else if ($special==20) $r .= "veinte ";
else if ($special==10) $r .= "diez ";
else if ($special==0);
} else {
if ($special == 30 && !$last) $r .= "y " . $this->numerosX[$n%10] . " ";
else if ($special == 30) $r .= "y " . $this->numeros[$n%10] . " ";
else if ($special == 20) {
if ($uni == 3) $r .= "veintitrés ";
else if (!$last) $r .= "veinti" . $this->numerosX[$n%10] . " ";
else $r .= "veinti" . $this->numeros[$n%10] . " ";
} else if ($special == 10) $r .= $this->numeros11[$n%10] . " ";
else if ($special == 0 && !$last) $r .= $this->numerosX[$n%10] . " ";
else if ($special == 0) $r .= $this->numeros[$n%10] . " ";
}
return $r;
}

public function seisnumeros($n, $last) {
if ($n == 0) return "cero ";
$miles = floor($n / 1000);
$units = $n % 1000;
$r = "";
if ($miles == 1) $r .= "mil ";
else if ($miles > 1) $r .= $this->tresnumeros($miles, false) . "mil ";
if ($units > 0) $r .= $this->tresnumeros($units, $last);
return $r;
}

public function numero_texto($n) {
if ($n == 0) return "cero ";
$millo = floor($n / 1000000);
$units = $n % 1000000;
$r = "";
if ($millo == 1) $r .= "un millón ";
else if ($millo > 1) $r .= $this->seisnumeros($millo, false) . "millones ";
if ($units > 0) $r .= $this->seisnumeros($units, true);
return strtoupper($r);
}



}
?>