<!DOCTYPE html>
<?php
$num1=0;
if(isset($_POST['num1']))
	$num1=$_POST['num1'];

$num2=0;
if(isset($_POST['num2']))
	$num2=$_POST['num2'];

$num3=0;
if(isset($_POST['num3']))
	$num3=$_POST['num3'];
?>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title><?php  ?></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<form class="" action="" method="post">
	1° número -<input type="text" name="num1" id="num1"><br>
	2° número -<input type="text" name="num2" id="num2"><br>
	3° número -<input type="text" name="num3" id="num3"><br>
	<input type="submit" name="" value="send"><br><br>
</form>
<?php
if($num1 >= 0 and $num2 >= 0 and $num3 >= 0){
	if($num1 < $num2 and $num2 < $num3){
		echo "Contaminação acima dos limites permitidos.";
	}elseif($num1 > $num2 and $num2 > $num3){
		echo "Contaminação abaixo dos limites permitidos.";
	}elseif($num1 == $num2 and $num2 == $num3){
		echo "Sem contaminação.";
	}
}else{
	echo "Erro, digite novamente";
}
?>
</body>
</html>
