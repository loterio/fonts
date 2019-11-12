<!DOCTYPE html>
<?php
$title="Atividade avaliativa";
$num=0;
$cem=0;
$cinq=0;
$dez=0;
$cinco=0;
$um=0;

$valor=0;
if(isset($_POST['valor']))
	$valor=$_POST['valor'];
?>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title ?></title>
</head>
<body>
<form method="post" action="">
	Insira o valor: <input type="number" name="valor" id="valor">
	<input type="submit" value="send">
</form>
<?php
if($valor<=0){
	echo "<h1>Valor inválido</h1>";
}
if($valor > 0){
	if ($valor<10 and$valor>1000){
		echo "<h1>Valor de saque fora dos limites</h1>";
	}else{
		$aux=$valor;

		$cem=floor($aux/100);
		$aux=$valor-($cem*100);

		$cinq=floor($aux/50);
		$aux=$aux-($cinq*50);

		$dez=floor($aux/10);
		$aux=$aux-($dez*10);

		$cinco=floor($aux/5);
		$aux=$aux-($cinco*5);

		if($aux == 0){
			$um = 0;
		}else{
			$um=$aux;
		}
//=====================================
		echo "Valor: R$". $valor."<br>";
		if($cem != 0){
			echo "$100: ". $cem."<br>";
		}
		if($cinq != 0){
			echo "$50: ". $cinq."<br>";
		}
		if($dez != 0){
			echo "$10: ". $dez."<br>";
		}
		if($cinco != 0){
			echo "$5: ". $cinco."<br>";
		}
		if($um != 0){
			echo "$1: ". $um."<br>";
		}
	}
}

?>
</body>
</html>
