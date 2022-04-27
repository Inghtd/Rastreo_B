<?php
function multiply($x, $y ,$i)
{
	$objResponse = new xajaxResponse();
	$objResponse->assign("gui_volumen", "value", $x*$y*$i);
	return $objResponse;
}

function mayor($vol, $peso)
{
if (($vol/6000) > $peso){
  $peso_calc=round(($vol/6000),2);

}
else
{
$peso_calc=$peso;
}
	$objResponse = new xajaxResponse();
	$objResponse->assign("gui_peso_calc", "value", $peso_calc);
	return $objResponse;
}
?>