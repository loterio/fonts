<!DOCTYPE html>
<?php
 define("NUM",6);
 define("CARTELAS",10);
?>
<html>
<head>
<meta charset="UTF-8">
<title>Sorteio Milionário</title>
</head>
<body>
<form method="post">
<input type="submit" value="Calcular">
</form>
<?php
	// Sorteia os 6 números e armazena no vetor ($vet)
    srand();
	$vet = array();
    for ($x = 0; $x < NUM; $x++) {
        $vet[$x] = rand(1, 60);
    }
    // Ordena os números no vetor
    sort($vet);
	echo "<h1>";
	for ($x = 0; $x < NUM; $x++)
        echo $vet[$x] . " | ";
	echo "</h1><br>";

	// Sorteia cartelas e verifica acertos
    for ($x = 0; $x < CARTELAS; $x++) {
        $cartela = array();
        for ($y = 0; $y < NUM; $y++)
            $cartela[$y] = rand(1, 60);
        // Ordena os números no vetor
        sort($cartela);
        echo "<h4>";
        for ($y = 0; $y < NUM; $y++) {
            if (in_array($cartela[$y], $vet))
                echo $cartela[$y] . "* | ";
            else
                echo $cartela[$y] . " | ";
        }
        echo "</h4><br>";
    }
?>
</body>
</html>
