<!DOCTYPE html>
<?php
$number=0;
if (isset($_POST['number']))
	$number= $_POST['number'];
?>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Título</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>O POBREMÃO</h1>
<p>Joãozinho muito alegre, para a escola se dirigia, mal sabia ele que uma <br>
surpresa encontraria, a caminho do local, o menino muito legal, com um robô <br>
se encontrou e naquele momento inoportuno, o mesmo lhe perguntou: <br>
-ROB: Joãozinho, você que tanto estuda, me conceda sua ajuda,<br>
apenas sei calcular mal, então tu poderia converter um número para hexadecimal? <br>
-JAO: Mas é claro Sr. Robô, lhe ajudo com esse impasse, apenas basta me informar o número em que pensaste: <br>
<h3>*número que o robô pensou*</h3></p>
<form action="" method="post">
	<input type="text" name="number" id="number">
	<input type="submit" name="" value="send">
</form>
<p>Após o robô o número informar, foi Joãozinho a calcular e em poucos <br>
instantes, com o robô saltitante, a resposta revelou: <br><br>
-Seu robô, eis aqui sua resposta: </p>
<?php
echo "A partir do seu número pensado, sua pergunta respondi, e <b>".$number."</b> em hexadecimal é: <b>".dechex($number)."</b><br><br>";
echo "Como contigo me preocupo e caso precises, calculei também <b>".$number."</b> em binário se for necessário: <b>".decbin($number)."</b>";
?>
</body>
</html>
