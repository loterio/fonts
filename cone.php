<!DOCTYPE html>
<?php
$title='Cálculo de área de um cone';

// Recolhimento dos dados de entrada do usuário
$r=isset($_POST['raio']) ? $_POST['raio'] : 0;
$z=isset($_POST['altura']) ? $_POST['altura'] : 0;
$tipo=isset($_POST['tp']) ? $_POST['tp'] : 0;

//Constantes e Variáveis
define('pi', pi());
define('valorUm', 238.90);
define('valorDois', 467.98);
define('valorTres', 758.34);

$litros=0;
$preco=0;
$latas=1;

// Cálculos
// Área do cone= pi*r(r+g)  Área do círculo= pi*r²
$g=sqrt(($r*$r)+($z*$z));
$area=(pi*$r*($r+$g))+(pi*$r*($r+$g))-(pi*($r*$r));
$litros=ceil($area/3.45);
$latas=ceil($litros/18);
?>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title><?php  ?></title>
	<link rel="stylesheet" href="MyselfCSS/assets/css/basico.css">
</head>
<body>
<h3>Informe todas as medidas em metros</h3>
<form class="" action="" method="post">
	Raio 	<input type="text" name="raio" id="raio"><br>
	Altura <input type="text" name="altura" id="altura"><br>
	Escolha um tipo de tinta<br>
	<b class="um">Tipo 1</b> <input type="radio" name="tp" value="1">
	<b class="dois">Tipo 2</b><input type="radio" name="tp" value="2">
	<b class="tres">Tipo 3</b><input type="radio" name="tp" value="3"><br>
	<input type="submit" value="send"><br><br>
</form>
<?php
if($tipo==1){
	$preco=$latas*valorUm;
	echo '<h3 class="um">Área: '.number_format($area,5,',','.').' m²<br>';
	echo 'Litros necessários: '.$litros.'<br>';
	echo 'Latas: ',$latas.'<br>';
	echo 'Preço total: R$'.$preco.'<br></h3>';
}elseif($tipo==2){
	$preco=$latas*valorDois;
	echo '<h3 class="dois">Área: '.number_format($area,5,',','.').' m²<br>';
	echo 'Litros necessários: '.$litros.'<br>';
	echo 'Latas: ',$latas.'<br>';
	echo 'Preço total: R$'.$preco.'<br></h3>';
}elseif($tipo==3){
	$preco=$latas*valorTres;
	echo '<h3 class="tres">Área: '.number_format($area,5,',','.').' m²<br>';
	echo 'Litros necessários: '.$litros.'<br>';
	echo 'Latas: ',$latas.'<br>';
	echo 'Preço total: R$'.$preco.'<br></h3>';
}
?>
</body>
</html>
