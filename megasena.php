<!DOCTYPE html>
<?php
 define("NUM",6);
 define("CARTELAS",10);
?>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Megasena</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<form action="" method="post">
	<input type="submit" value="send"><br><br>
</form>
<?php
srand();
$vet = array();
	for ($x = 0; $x < NUM; $x++){
			$vet[$x] = rand(1, 60);
		}

sort($vet);// Ordena os números no vetor
echo "<h1>Números da sorte!</h1><h2><br>";
for ($x = 0; $x < NUM; $x++)
		echo $vet[$x] . " / ";
echo "</h2><br>";

// Sorteia cartelas e verifica acertos
for ($x = 0; $x < CARTELAS; $x++){
		$cartela = array();
		for ($y = 0; $y < NUM; $y++)
				$cartela[$y] = rand(1, 60);
		// Ordena os números no vetor
		sort($cartela);
		echo "<h4>".($x+1)."° ";
		for ($y = 0; $y < NUM; $y++){
				if (in_array($cartela[$y], $vet))
						echo " / ".$cartela[$y]."*";
				else
						echo " / ".$cartela[$y];
		}
		echo "</h4><br>";
}
?>
</body>
</html>
