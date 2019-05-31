<?php 
error_reporting(0);

	function knapSolveFast2($w, $v, $i, $aW, &$m) {
	 
		global $numcalls;
		$numcalls ++;

		if (isset($m[$i][$aW])) {
			return array( $m[$i][$aW], $m['picked'][$i][$aW] );
		} else {
	 
			if ($i == 0) {
				if ($w[$i] <= $aW) { 
					$m[$i][$aW] = $v[$i]; 
					$m['picked'][$i][$aW] = array($i); 
					return array($v[$i],array($i)); 
	 
				} else {
					$m[$i][$aW] = 0; 
					$m['picked'][$i][$aW] = array(); 
					return array(0,array()); 
				}
			}	
	 
			list ($without_i, $without_PI) = knapSolveFast2($w, $v, $i-1, $aW, $m);
	 
			if ($w[$i] > $aW) { 
	 
				$m[$i][$aW] = $without_i; 
				$m['picked'][$i][$aW] = $without_PI; 
				return array($without_i, $without_PI);
	 
			} else {
	 			list ($with_i,$with_PI) = knapSolveFast2($w, $v, ($i-1), ($aW - $w[$i]), $m);
				$with_i += $v[$i]; 
	 
				if ($with_i > $without_i) {
					$res = $with_i;
					$picked = $with_PI;
					array_push($picked,$i);
				} else {
					$res = $without_i;
					$picked = $without_PI;
				}
	 
				$m[$i][$aW] = $res;
				$m['picked'][$i][$aW] = $picked; 
				return array ($res,$picked); 
			}	
		}
	}

	$repeat = array_count_values( $_POST['pesos']);

	foreach($repeat as $key => $value){
	    if($value > 1){
	        header('Location: mochila.php?repetido');
	    }
	}
 
	$items4 = $_POST['nomes'];
	$w4 = $_POST['pesos'];
	$v4 = $_POST['valores'];
	 
	$numcalls = 0; $m = array(); $pickedItems = array();
	 
	list ($m4,$pickedItems) = knapSolveFast2($w4, $v4, sizeof($v4) -1, $_POST['peso_maximo'], $m);

	require_once("header.php");	 
?>
	<style type="text/css">
	  #imagem-topo{
	    height: 199px !important;
	  }
	</style>
	<div class="main main-raised" id="campos-restricoes">
	  <div class="container">
	    <div class="section  margin-top" style="display: block;" id="step-two">
	      <div class="row text-center">
	        <h3 class="centralizado">Itens selecionados para levar na Mochila (<?php print $_POST['peso_maximo']?> Kg):</h3>
	      </div> 
	      <br>
	      <div class="row text-center">
	        <?php
	        	echo "<table class='table table-bordered'>";
	        	echo "<thead><th>Item</th><th>Valor</th><th>Peso</th></thead>";
	        	$totalVal = $totalWt = 0;
	        	foreach($pickedItems as $key) {
	        		$totalVal += $v4[$key];
	        		$totalWt += $w4[$key];
	        		echo "<tr><td>".$items4[$key]."</td><td>".$v4[$key]."</td><td>".$w4[$key]."</td></tr>";
	        	}
	        	echo "<tr><td><b>Total</b></td><td>$totalVal</td><td>$totalWt</td></tr>";
	        	echo "</table>";
	        ?>
	      </div>
	      <div class="row">
	        <div class="col-md-12">
	          <center>
	            <a href="mochila.php">
	              <button class="btn btn-primary btn-round" style="margin-top: 29px;">Começar de novo!</button>
	            </a>
	      	  </center>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

<?php
require_once("footer.php");
?>

