<?php 

$valores = $_POST['valores']; 
$peso_item = $_POST['pesos'];
$maximo = $_POST['peso_maximo'];
$qtd = count($valores); 
echo CapacidadeMochila($maximo, $peso_item, $valores, $qtd); 

function CapacidadeMochila($maximo, $peso_item, $valores, $qtd) 
{ 
    if ($qtd == 0 || $maximo == 0) 
        return 0; 

    if ($peso_item[$qtd - 1] > $maximo) 
        return CapacidadeMochila($maximo, $peso_item, $valores, $qtd - 1); 
    else
        return max($valores[$qtd - 1] +  
               CapacidadeMochila($maximo - $peso_item[$qtd - 1],  
               $peso_item, $valores, $qtd - 1),  
               CapacidadeMochila($maximo, $peso_item, $valores, $qtd-1)); 
} 
  
?>