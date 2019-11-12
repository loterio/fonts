<!DOCTYPE html>
<?php
// dados usuário
$STPar=isset($_POST['startPar'])?$_POST['startPar']:0;
$STImpar=isset($_POST['startImpar'])?$_POST['startImpar']:0;
$caracter=isset($_POST['crc'])?$_POST['crc']:'';
$corPar=isset($_POST['corPar'])?$_POST['corPar']:'';
$corImpar=isset($_POST['corImpar'])?$_POST['corImpar']:'';
$line=isset($_POST['lin'])?$_POST['lin']:0;
$col=isset($_POST['col'])?$_POST['col']:0;

// variáveis e pá
$aux=0;

?>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<title><?php  ?></title>
		<link rel="stylesheet" href="style.css">
		<style media="screen">
			.unity{
				margin: 10px;
				padding: 10px;
				background: black;
				width: 40px;
				height: 40px;
				font-family: monospace;
				color: white;
			}
			.unity:hover{
				background: #fafafa;
				color: royalblue;
				transition: .1s;
				border: 4px dotted royalblue;
				margin: 6px;
				/* padding: 6px; */
			}
			.container{
				padding: 5px;
				margin: 0px;
				width: auto;
				height: auto;
			}
			.container .unity{
				position: relative;
				display: inline;
			}
			.emoji{
				background: black;
				color: white;
				border-radius: 100px;
				font-weight: bold;
			}
			.par{
				background: <?php echo $corPar ?>;
			}
			.impar{
				background: <?php echo $corImpar ?>;
			}
		</style>
	</head>
<body>
		<form class="" action="" method="post">
			Início pares <input type="text" name="startPar" value="<?php echo $STPar; ?>"><br>
			Início ímpares <input type="text" name="startImpar" value="<?php echo $STImpar; ?>"><br>
			Caracter separador <input type="text" name="crc" value="<?php echo $caracter; ?>"><br>
			Cor pares <input type="text" name="corPar" value="<?php echo $corPar; ?>"><br>
			Cor ímpares <input type="text" name="corImpar" value="<?php echo $corImpar; ?>"><br>
			Linhas <input type="text" name="lin" value="<?php echo $line; ?>"><br>
			Colunas <input type="text" name="col" value="<?php echo $col; ?>"><br>
			<input type="submit" name="" value="send"><br><br>
		</form>

<?php
if($STPar%2==0){
	echo "";
}else{
	echo "<script>alert('Erro - Início Pares');</script>";
	$STPar++;
}

if($STImpar%2==1){
	echo "";
}else{
	echo "<script>alert('Erro - Início Ímpares');</script>";
	$STImpar++;
}

for ($i=0; $i < 1; $i++) {
	echo "<div class='container'>";
	for ($x=0; $x < $col; $x++) {
		echo "<div class='unity par'>".$STPar."</div>";
			$STPar+=2;
		echo $caracter;
	}
	echo "</div><br>";
}

for ($i=2; $i < $line; $i++) {
	echo "<div class='container'>";
	for ($x=0; $x < $col; $x++) {
		echo "<div class='unity emoji'>:P</div>";
	}
	echo "</div><br>";
}

for ($i=0; $i < 1; $i++) {
	echo "<div class='container'>";
	for ($x=0; $x < $col; $x++) {
		echo "<div class='unity impar'>".$STImpar."</div>";
			$STImpar+=2;
		echo $caracter;
	}
	echo "</div><br>";
}
// echo "Início par: ".$STPar."<br>";
// echo "Impar: ".$STImpar."<br>";
// echo "Caracter: ".$caracter."<br>";
// echo "Cor par: ".$corPar."<br>";
// echo "Impar: ".$corImpar."<br>";
// echo "linha: ".$line."<br>";
// echo "colunas: ".$col."<br>";
?>
</body>
</html>
