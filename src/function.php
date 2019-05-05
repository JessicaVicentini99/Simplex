<html>
<head>
	<title>simplex</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
</body>
</html>
<script type="text/javascript">
	console.log(this.FormData.get)
</script>
<?php
	$variaveis = $_POST["variaveis"];
    $restricoes = $_POST["restricoes"];

	echo '<form action="/simplex/src/function_part2.php" method="POST">';
	//Funcao
	for($j = 1; $j <= $variaveis; $j++){
			if($j == $variaveis){
                echo '<input type="hidden" name=restricoes[0][linha] value="Z">';
				echo '<input type="number"  name=restricoes[0][colunas][X' . $j . ']> X' . $j . '<br><br><br>';
			}else {
				echo '<input type="number" name=restricoes[0][colunas][X' . $j . ']> X' . $j . " + ";
			}
		}
	//Restrições
	for($i = 1; $i <= $restricoes; $i++){
		for($j = 1; $j <= $variaveis; $j++){
			if($j == $variaveis){
                echo '<input type="hidden" name=restricoes['.$i.'][linha] value="F'. $i .'">';
				echo '<input type="number" name=restricoes['.$i.'][colunas][X' . $j . ']> X' . $j . " ≤ " . '<input type="number" name=restricoes['.$i.'][colunas][B]>';
				echo '<input type="hidden" name=restricoes['.$i.'][colunas][F' . $i . '] value="1">';
			}else {
				echo '<input type="number" name=restricoes['.$i.'][colunas][X' . $j . ']> X' . $j . " + ";
			}
		}
		echo '<br><br>';
	}
	echo '<button type="submit" class="btn btn-primary">Continuar</button><form>';
?>