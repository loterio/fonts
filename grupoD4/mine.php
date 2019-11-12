<!DOCTYPE html>
<?php
/* Cria o arquivo valores.jsonagenda-bs/index.php
‘w’ : Cria o arquivo e escreve os dados,
      se o arquivo já existir será substituído pelo novo;
‘a’ : Cria o arquivo e escreve os dados,{"codigo":"003","nome":"Maria","telefone":"013 3434-4444"}
      se o arquivo já existir 1,4,7,9,2,5,0);os dados novos serão
      adicionados ao arquivo existente;
‘r’ : Abre o arquivo que já existe para leitura,
      e somente leitura;
*/

$nome=isset($_POST['nombre'])?$_POST['nombre']:'';

$idiomas=isset($_POST['lg'])?$_POST['lg'] : array();

$formacao=isset($_POST['school'])?$_POST['school']:'';

$sistema=isset($_POST['opera'])?$_POST['opera']:'';

$tecnology=isset($_POST['tec'])?$_POST['tec']:array();

?>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Formulario - tudo em json</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<form class="" action="" method="post">

		Nome
		<input type="text" name="nombre" value="<?php echo $nome;?>">

		Escolaridade
		<select name='school'>
			<option value=''>		</option>
			<?php
			$arquivo = file_get_contents('select.json');
			$poo = json_decode($arquivo);

			for ($i=0; $i < count($poo); $i++) {
				if($formacao==$poo[$i])
					echo "<option value='$poo[$i]' selected>$poo[$i]</option>";
				else
					echo "<option value='$poo[$i]'>$poo[$i]</option>";
			}

			?>
		</select>
		<br><br>

		Idiomas<br>
		<?php
		$arquivo = file_get_contents('checkbox.json');
		$doCHKB = json_decode($arquivo);

		for ($i=0; $i < count($doCHKB); $i++) {
			if(in_array($doCHKB[$i],$idiomas)){
				echo "<input name='lg[]' type='checkbox' value='$doCHKB[$i]' checked>$doCHKB[$i]";
			}else{
				echo "<input name='lg[]' type='checkbox' value='$doCHKB[$i]'>$doCHKB[$i]";
			}
		}
		?>
		<br><br>

		Sistema Operacional<br>
		<?php
		$arquivo = file_get_contents('radio.json');
		$json = json_decode($arquivo);

		for ($i=0; $i < count($json); $i++) {
			if($sistema==$json[$i])
				echo "<input type='radio' name='opera' value='$json[$i]'checked>$json[$i]</option>";
			else
				echo "<input type='radio' name='opera' value='$json[$i]'>$json[$i]</option>";
		}
		?>
		<br><br>

		Tecnologias<br>
		<select multiple="multiple" name="tec[]">
			<option value=''></option>
			<?php
				$arquivo = file_get_contents('selectM.json');
				$tec = json_decode($arquivo);

				for ($i=0; $i < count($tec); $i++) {
					if(in_array($tec[$i], $tecnology))
						echo "<option value='$tec[$i]' selected>$tec[$i]</option>";
					else
						echo "<option value='$tec[$i]'>$tec[$i]</option>";
				}
			?>
		</select>
		<br><br>
		<input type="submit" name="envia" value="cadastrar">
		<br><br>
		<?php

		// 1- Pegar os dados do arquivo json e salvar em um array;
		$dados_json=file_get_contents('contatos.json');
		$decode=json_decode($dados_json);
		// echo var_dump($dados_json)."<br><br>";

		// 2- Pega os dados do formulário e passa pra um array
		$dados_formulario=array($nome, $idiomas, $formacao, $sistema, $tecnology);
		// echo var_dump($dados_formulario);

		// 3- Coloca os dados do formulário dentro do json (array_push);
		if($decode == null){
			$decode[0]=$dados_formulario;
		}else{
			array_push($decode, $dados_formulario);
		}

		// 4- Preenche a tabela;
		echo "<table>";
			echo "<tr>";
				echo "<th>Nome</th>";
				echo "<th>Idiomas</th>";
				echo "<th>Escolaridade</th>";
				echo "<th>Sistema Operacional</th>";
				echo "<th>Tecnologias</th>";
			echo "<tr>";
		for($x=0;$x<count($decode);$x++){
			echo "<tr>";
				echo "<td>".$decode[$x][0]."</td>";
				echo "<td>";
					foreach($decode[$x][1] as $key)
						echo $key.",";
				echo "</td>";
				echo "<td>".$decode[$x][2]."</td>";
				echo "<td>".$decode[$x][3]."</td>";
				echo "<td>";
					foreach($decode[$x][4] as $key)
						echo $key.",";
				echo "</td>";
			echo "<tr>";
		}
		echo "</table>";

		// // 5- Codifica os dados do formulário para json e envia (json_encode);
		$salva_json=json_encode($decode);
		$file = fopen("contatos.json", "w");
		fwrite($file, $salva_json);
		fclose($file);


		?>
	</form>
</body>
</html>
