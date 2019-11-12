<!DOCTYPE html>
<?php
// valores Usuário
$turno=isset($_POST['turn'])?$_POST['turn']:array();
$turnos=array('Matutino','Vespertino','Noturno','Integral');

$formacao=isset($_POST['selFormacao'])?$_POST['selFormacao']:array();
$opcoes=array('Fundamental 1', 'Fundamental 2', 'Ensino Médio', 'Graduação', 'Pós-Graduação', 'Mestrado', 'Doutorado');

$estados=array("Santa Catarina","Rio Grande do Sul","Paraná","São Paulo","Rio de Janeiro");
$estado=isset($_POST['state'])?$_POST['state']:array();

$curso=array('PHP','Python','Java','JavaScript');
$linguagem=isset($_POST['selLing'])?$_POST['selLing']:array();

$texto=isset($_POST['obs'])?$_POST['obs']:'';
?>

<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Salva Contexto</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<form class="" action="" method="post">
<fieldset>
	<legend>Turno</legend>
	<?php
	for ($i=0; $i < count($turnos); $i++) {
		if(in_array($turnos[$i],$turno)){
			echo "<input type='radio' name='turn[]' id='turn[]' value='$turnos[$i]' checked>$turnos[$i]";
		}else{
			echo "<input type='radio' name='turn[]' id='turn[]' value='$turnos[$i]'>$turnos[$i]";
		}
	}
	?>
</fieldset>

<fieldset>
	<legend>Curso</legend>
	<?php
	for ($i=0; $i < count($opcoes); $i++) {
		if(in_array($opcoes[$i], $formacao)){
			echo "<input type='checkbox' name='selFormacao[]' id='selFormacao[]'".
			" value='$opcoes[$i]' checked>$opcoes[$i]";
		}else{
			echo "<input type='checkbox' name='selFormacao[]' id='selFormacao[]'".
			" value='$opcoes[$i]'>$opcoes[$i]";
		}
	}
	?>
</fieldset>

<fieldset>
	<legend>Estado</legend>
	<select id="state[]" name="state[]">
			<option value="">				</option>
			<?php
				for ($x=0; $x < count($estados); $x++) {
					if(in_array($estados[$x], $estado)){
						echo "<option value='$estados[$x]' selected>$estados[$x]</option>";
					}else{
						echo "<option value='$estados[$x]'>$estados[$x]</option>";
					}
				}
			?>
	</select>
</fieldset>

<fieldset>
	<legend>Linguagens</legend>
	<select name="selLing[]" id="selLing[]" multiple="multiple" size="5">
		<option value="">			</option>
		<?php
		for ($i=0; $i < count($curso); $i++) {
			if(in_array($curso[$i],$linguagem))
				echo "<option value='$curso[$i]' selected>$curso[$i]</option>";
			else
				echo "<option value='$curso[$i]'>$curso[$i]</option>";
		}
		?>
	</select>
</fieldset>
	<input type="submit" name="" value="send">
</form>
<?php

?>
</body>
</html>
