<?php
//---------------------==={Variaveis}===--------------------------
  //=================== Cadastros Json ===========================
    $cadastros = array();//Array que estarão sendo salvos os cadastros do arquivo Json
    $quantidadeCadastros = 0;//será salvo aqui o número de pessoas cadastradas
  //===================Inputs das Buscas==========================
    $mesAniversario = null;//váriavel que recebe o mês para busca
    $emailPesquisa = '@';//váriavel que recebe o dominio para busca
    $aproximacao = null;//váriavel que recebe a string  para busca
  //=======================Formulários============================
    $nomeFormulario = null;//váriavel que recebe nome dos formulários
    $telefoneFormulario = null;//váriavel que recebe telefone dos formulários
    $emailFormulario = null;//váriavel que recebe email dos formulários
    $dataNascimentoFormulario = null;//váriavel que recebe data_nascimento dos formulários
  //=====================Botões===================================
    $botaoInserir = null;//váriavel que recebe o valor do botão inserir quando ele for clicado
    $pesquisasAvancadas = null;//váriavel que puxa um formulário das pesquisas
    $botaoListar = null;//váriavel que recebe o valor do botão
    $submitFormulario = null;//váriavel que recebe o valor do indice em que será salvo os dados
    $cancelarCadastro = null;//váriavel que recebe o valor pra voltar a ultima pagina
    $botaoAlterar = null;//váriavel que recebe o valor do botão alterar quando ele for clicado
    $botaoExcluir = null;//váriavel que recebe o valor do botão excluir quando ele for clicado
    $botaoBuscar = null;
    $botaoVoltar = null;
    $botaoFechaTabela = null;
    $botaoExcluiTodos = null;
  //========================Ultima pagina de pesquisa==============
    $ultimaPagina = null;
    $ultimaPesquisa = null;
  //========================Erro no cadastro=======================
    $mandaMensagem = false;
    $mensagem = "<strong>Ooops!</strong> Problemas no preenchido, siga as instruções: <ul>";
    $primeiroInput = null;
    $segundoInput = null;
    $terceiroInput = null;
    $quartoInput = null;
//----------------------------------------------------------------

//----------Pega Cadastros Json e a quantidade Cadastros----------
  function dadosCadastros(){//função geral que será chamada na index
      pegaCadastrosJson();//pega os valores dos cadastros do arquivo JSON e salva em um array
      contaNumeroCadastros();//conta Quantos cadastros existem
    }
  function pegaCadastrosJson(){//pega os valores dos cadastros do arquivo JSON e salva em um array
      $arquivo = file_get_contents('json/cadastros.json');//arquivo Json que será pego
      $GLOBALS['cadastros'] = json_decode($arquivo);//salva no array global cadastros os cadastros
      $cadastrosLocal = $GLOBALS['cadastros'];
    }
  function contaNumeroCadastros(){//conta Quantos cadastros existem
      if ($GLOBALS['cadastros'] == null) {//se não tiver nenhum cadastro
        $GLOBALS['quantidadeCadastros'] = 0;//numero de pessoas cadastradas = 0
      }else{
      $GLOBALS['quantidadeCadastros'] = count($GLOBALS['cadastros']);//salva na variavel global quantidadeCadastros o número de cadastros
      }
    }
//----------------------------------------------------------------

//------------------Ultima Pagina---------------------------------
  function pegaUltimaPagina(){
    $arquivo = file_get_contents('json/ultimaPagina.json');//arquivo Json que será pego
    $GLOBALS['ultimaPagina'] = json_decode($arquivo);//salva no array global cadastros os cadastros
    // echo "ultima Pagina: ", $GLOBALS['ultimaPagina'];
  }
  function salvaUltimaPagina($ultimaPaginaAberta){
    if ($ultimaPaginaAberta == "menuInicial" or
        $ultimaPaginaAberta == "menuLista" or
        $ultimaPaginaAberta == "pesquisasInicial" or
        $ultimaPaginaAberta == "pesquisasLista") {
      $ultimaPaginaAberta = json_encode($ultimaPaginaAberta);//converte os ultimaPagina em json
      $fp = fopen("json/ultimaPagina.json","w");//abre arquivo json em que ele será salvo
      fwrite($fp, $ultimaPaginaAberta);//salva os cadastros no arquivo json
      fclose($fp);//fecha o arquivo
      $GLOBALS['ultimaPagina'] = json_decode($ultimaPaginaAberta);//transforma em um arrai os cadastros novamente
    }else{
      echo "<h1>PARAMENTO ERRADO ULTIMA PAGINA INEXISTENTE</h1>";
    }
  }
//----------------------------------------------------------------
//------------------Ultima Pesquisa-------------------------------
  function pegaUltimaPesquisa(){
    $arquivo = file_get_contents('json/ultimaPesquisa.json');//arquivo Json que será pego
    $GLOBALS['ultimaPesquisa'] = json_decode($arquivo);//salva no array global cadastros os cadastros
    // echo "<br>ultima Pesquisa: ";
  }
  function salvaUltimaPesquisa($ultimaPesquisa){
    $ultimaPesquisa = json_encode($ultimaPesquisa);//converte os ultimaPagina em json
    $fp = fopen("json/ultimaPesquisa.json","w");//abre arquivo json em que ele será salvo
    fwrite($fp, $ultimaPesquisa);//salva os cadastros no arquivo json
    fclose($fp);//fecha o arquivo
    $GLOBALS['ultimaPesquisa'] = json_decode($ultimaPesquisa);//transforma em um arrai os cadastros novamente
  }
  function novaPesquisa($indiceCaiFora){
    $aux = array();
    $novaPesquisa = excluiElementoArray($GLOBALS['ultimaPesquisa'],$GLOBALS['botaoExcluir']);
    for ($i=0; $i < $indiceCaiFora ; $i++) {
      $aux[$i] = $novaPesquisa[$i];
    }
    for ($i=$indiceCaiFora; $i <count($GLOBALS['ultimaPesquisa'])-1 ; $i++) {
      $aux[$i] = $novaPesquisa[$i]-1;
    }
    $novaPesquisa = $aux;
    salvaUltimaPesquisa($novaPesquisa);
  }
//----------------------------------------------------------------

//-----------------------Recebe Dados-----------------------------
  function recebeDados(){
    recebeBotoes();
    recebeDadosCadastro();
    recebeDadosPesquisa();
  }
  function recebeBotoes(){
    if (isset($_POST['botaoInserir'])) {
      $GLOBALS['botaoInserir'] = $_POST['botaoInserir'];
    }
    if (isset($_POST['pesquisasAvancadas'])) {
      $GLOBALS['pesquisasAvancadas'] = $_POST['pesquisasAvancadas'];
    }
    if (isset($_POST['botaoListar'])) {
      $GLOBALS['botaoListar'] = $_POST['botaoListar'];
    }
    if (isset($_POST['submitFormulario'])) {
      $GLOBALS['submitFormulario'] = $_POST['submitFormulario'];
    }
    if (isset($_POST['cancelarCadastro'])) {
      $GLOBALS['cancelarCadastro'] = $_POST['cancelarCadastro'];
    }
    if (isset($_POST['botaoAlterar'])) {
      $GLOBALS['botaoAlterar'] = $_POST['botaoAlterar'];
    }
    if (isset($_POST['botaoExcluir'])) {
      $GLOBALS['botaoExcluir'] = $_POST['botaoExcluir'];
    }
    if (isset($_POST['botaoBuscar'])) {
      $GLOBALS['botaoBuscar'] = $_POST['botaoBuscar'];
    }
    if (isset($_POST['botaoVoltar'])) {
      $GLOBALS['botaoVoltar'] = $_POST['botaoVoltar'];
    }
    if (isset($_POST['botaoFechaTabela'])) {
      $GLOBALS['botaoFechaTabela'] = $_POST['botaoFechaTabela'];
    }
    if (isset($_POST['botaoExcluiTodos'])) {
      $GLOBALS['botaoExcluiTodos'] = $_POST['botaoExcluiTodos'];
    }
  }
  function recebeDadosCadastro(){
    if (isset($_POST['nomeFormulario'])) {//se o objeto nomeFormulario existir
      $GLOBALS['nomeFormulario'] = $_POST['nomeFormulario'];//salva na variável global nomeFormulario o valor do objeto
    }
    if (isset($_POST['telefoneFormulario'])) {//se o objeto telefoneFormulario existir
      $GLOBALS['telefoneFormulario'] = $_POST['telefoneFormulario'];//salva na variável global telefoneFormulario o valor do objeto
    }
    if (isset($_POST['emailFormulario'])) {//se o objeto emailFormulario existir
      $GLOBALS['emailFormulario'] = $_POST['emailFormulario'];//salva na variável global emailFormulario o valor do objeto
    }
    if (isset($_POST['dataNascimentoFormulario'])) {//se o objeto dataNascimentoFormulario existir
      $GLOBALS['dataNascimentoFormulario'] = $_POST['dataNascimentoFormulario'];//salva na variável global dataNascimentoFormulario o valor do objeto
    }

  }
  function recebeDadosPesquisa(){
      if (isset($_POST['mesAniversario'])) {//se o objeto mesAniversario existir
        $GLOBALS['mesAniversario'] = $_POST['mesAniversario'];//salva na variável global mesAniversario o valor do objeto
      }
      if (isset($_POST['emailPesquisa'])) {//se o objeto email existir
        $GLOBALS['emailPesquisa'] = $_POST['emailPesquisa'];//salva na variável global email o valor do objeto
      }
      if (isset($_POST['aproximacao'])) {//se o objeto aproximacao existir
        $GLOBALS['aproximacao'] = $_POST['aproximacao'];//salva na variável global aproximacao o valor do objeto
      }

      // echo "Mes Aniversario pesquisa: ",$GLOBALS['mesAniversario'],"<br>";
      // echo "Email da pesquisa: ",$GLOBALS['emailPesquisa'],"<br>";
      // echo "String da pesquisa : ",$GLOBALS['aproximacao'],"<br>";
  }
//----------------------Páginas-----------------------------------
  function formularioCadastro($numeroCadastro, $primeiroInput, $segundoInput, $terceiroInput, $quartoInput){ #EXEMPLO CERTO
        //$cadastrosLocal = $GLOBALS['cadastros'];//Salva os cadastros globais em um array
        if ($primeiroInput == null) {
          $primeiroInput = "<input type='text' class='form-control'
                             name='nomeFormulario' id='inputName'
                             placeholder='Nome' autocomplete='off'>";

        }
        if ($segundoInput == null) {
          $segundoInput = "<input type='text' class='form-control'
                            pattern='\(\d{2}\) \d{5}-\d{4}' name='telefoneFormulario'
                            id='inputTel' placeholder='(DD) nnnnn-nnnn' autocomplete='off'>";

        }
        if ($terceiroInput == null) {
          $terceiroInput = "<input type='email' class='form-control'
                             name='emailFormulario' id='inputEmail'
                             placeholder='Email' autocomplete='off'>";

        }
        if ($quartoInput == null) {
          $quartoInput = "<input type='date' class='form-control'
                          name='dataNascimentoFormulario' id='inputDataNasc' autocomplete='off'>";
        }

        echo "<form method='post'>";
          echo "
            <div class='form-group row'>
              <label for='inputName' class='col-sm-2 col-form-label'>Nome</label>
              <div class='col-sm-10'>
                ".$primeiroInput."
              </div>
            </div>
          ";
          echo "
            <div class='form-group row'>
              <label for='inputTel' class='col-sm-2 col-form-label'>Telefone</label>
              <div class='col-sm-10'>
                ".$segundoInput."
              </div>
            </div>
          ";
          echo "
            <div class='form-group row'>
              <label for='inputEmail' class='col-sm-2 col-form-label'>Email</label>
              <div class='col-sm-10'>
                ".$terceiroInput."
              </div>
            </div>
          ";
          echo "
            <div class='form-group row'>
              <label for='inputDataNasc' class='col-sm-2 col-form-label'>Data de Nasc.</label>
              <div class='col-sm-10'>
                ".$quartoInput."
              </div>
            </div>
          ";
          echo "<center><button type='submit' class='btn btn-primary btn-lg' name='submitFormulario' value='".$numeroCadastro."'>Enviar</button>
          <button type='submit' class='btn btn-secondary btn-lg' name='cancelarCadastro' value='cancelarCadastro'>Cancelar</button><br></center>";
          //O botão recebe o valor do indice do cadastro em que os dados inseridos serão salvos
        echo "</form>";
  }
  function menuInicial(){
    botaoInserir();
    botaoPesquisasAvancadas();
    botaoListar();
    salvaUltimaPagina("menuInicial");
  }
  function menuLista(){
    botaoInserir();
    botaoPesquisasAvancadas();
    listarTodos();
    salvaUltimaPagina("menuLista");
  }
  function pesquisasInicial(){
    formuluarioPesquisas();
    salvaUltimaPagina("pesquisasInicial");
  }
  function pesquisasLista(){
    formuluarioPesquisas();
    $indices = $GLOBALS['ultimaPesquisa'];
    tabela($GLOBALS['cadastros'], $indices);
    salvaUltimaPagina("pesquisasLista");
  }
  function abreUltimaPagina(){
    if ($GLOBALS['ultimaPagina'] == "menuInicial") {
      menuInicial();
    }elseif ($GLOBALS['ultimaPagina'] == "menuLista") {
      menuLista();
    }elseif ($GLOBALS['ultimaPagina'] == "pesquisasLista") {
      pesquisasLista();
    }
  }
//----------------------------------------------------------------

//---------------------------Formulário pesquisas-----------------
  function formuluarioPesquisas(){//formulario com um select para os meses, e input para dominio e aproximação
    echo "<form method='post'>";
        echo "
              <div class='form-group'>
                ".criaSelectMeses()."
              </div>
              <div class='form-group'>
                ".criaSelectComDominio()."
              </div>
              <div class='form-group'>
                ".criaInputBuscaAproximacao()."
                <center>
                  <button type='submit' name='botaoBuscar' class='btn btn-primary btn-lg' value='buscar' autocomplete='off'>Buscar</button>
                  <button type='' class='btn btn-secondary btn-lg ' name='botaoVoltar' value='voltar'>Voltar</button>
                </center>
              </div>";
      echo "</form>";
    }
  //=========================Auxiliares===========================
    function criaSelectMeses(){
        echo "
        <div class='form-group row'>
          <label for='mesAniversario' class='col-sm-2 col-form-label'>Meses</label>
          <div class='col-sm-10'>
            <select name='mesAniversario' class='form-control'>
              <option value=''>Nenhum</option>
              <option value='01'>Janeiro</option>
              <option value='02'>Fevereiro</option>
              <option value='03'>Março</option>
              <option value='04'>Abril</option>
              <option value='05'>Maio</option>
              <option value='06'>Junho</option>
              <option value='07'>Julho</option>
              <option value='08'>Agosto</option>
              <option value='09'>Setembro</option>
              <option value='10'>Outubro</option>
              <option value='11'>Novembro</option>
              <option value='12'>Dezembro</option>
            </select>
          </div>
        </div>

        ";
      }
    function criaInputBuscaAproximacao() {
        echo "
        <div class='form-group row'>
          <label for='inputDataNasc' class='col-sm-2 col-form-label'>Pesquisa</label>
          <div class='col-sm-10'>
            <input type='text' class='form-control medial' autocomplete='off' placeholder='pesquisa por aproximação' name='aproximacao' value=''>
          </div>
        </div>
        <br>
        ";
      }
    function criaSelectComDominio(){
        $dominios = criaVetorComDominios();
        echo "
        <div class='form-group row'>
          <label for='inputDataNasc' class='col-sm-2 col-form-label'>Domínios</label>
          <div class='col-sm-10'>
          <select name='emailPesquisa' class='form-control'>
            <option value='@'>Nenhum</option>";
            foreach ($dominios as $key) {
              echo "<option value='$key'>$key</option>";
            }
            echo "</select>
          </div>
        </div>";

      }
    function criaVetorComDominios(){
        if ($GLOBALS['quantidadeCadastros']!=0) {
          $emails = array();
          $dominios = array();
          $cadastrosLocal = $GLOBALS['cadastros'];
          for ($i=0; $i < $GLOBALS['quantidadeCadastros']; $i++) {
            $aux = explode("@", $cadastrosLocal[$i][2]);
            $emails[$i] = "@".$aux[1];
          }
          // var_dump($emails);
          $dominios = array_unique($emails);
          return $dominios;
        }
      }
//----------------------------------------------------------------
//-----------------------------Botões-----------------------------
  function botaoInserir(){//Cria o objeto button Inserir
    echo "
    <form method='post'>
      <button type='submit' class='btn btn-secondary btn-lg btn-block botao' name='botaoInserir' value='Inserir'>Novo</button>
    </form>";//só irá existir um botão iserir que vai executar a mesma função por isso o valor 'Inserir'
  }
  function botaoAlterar($indiceCadastro){//Cria o objeto button Alterar que recebe o indice do cadastro que vai alterar
    echo "
    <form method='post'>
      <button type='submit' class='btn btn-outline-warning btn-sm' name='botaoAlterar' value='$indiceCadastro'><i class='material-icons'>create</i></button>
    </form>";//o botão vai receber o valor do indice correspondente a sua linha na tabela de cadastros
  }
  function botaoExcluir($indiceCadastro){//Cria o objeto button Excluir que recebe o indice do cadastro que vai exluir
    echo "
    <form method='post'>
      <button type='submit' class='btn btn-outline-danger btn-sm' name='botaoExcluir' value='$indiceCadastro'><i class='material-icons'>delete</i></button>
    </form>";//o botão vai receber o valor do indice correspondente a sua linha na tabela de cadastros
  }
  function botaoPesquisasAvancadas(){//Cria o objeto button pesquisasAvancadas
    echo "
    <form method='post'>
      <button type='submit' class='btn btn-secondary btn-lg btn-block botao' name='pesquisasAvancadas' value='pesquisar'>Pesquisar</button>
    </form>";//só irá existir um botão iserir que vai executar a mesma função por isso o valor 'Inserir'
  }
  function botaoListar(){//Cria o objeto button botaoListar{
    echo "
    <form method='post'>
      <button type='submit' class='btn btn-secondary btn-lg btn-block botao' name='botaoListar' value='listar'>Listar</button>
    </form>";
  }//cria botão
//----------------------------------------------------------------

//-----------------------------Lista------------------------------
  function listarTodos(){
        $vetorComIndices = array();
        for ($i=0; $i < $GLOBALS['quantidadeCadastros'] ; $i++) {
          $vetorComIndices[$i] = $i;
        }
        tabela($GLOBALS['cadastros'], $vetorComIndices);
      }

    //Cria tabela com todos os cadastros
  function tabela($vetorComcadastros, $vetorComIndices){//Função que cria a tabela/lista recebe o vetor cos os cadsastros e outro com os indices
      retornaEscolhidos($vetorComcadastros, $vetorComIndices);//escreve a tabela
    }
  function cabeçalhoTabela(){//Cria o cabeçalho da Tabela
      echo "
      <form align='right' method='post'>
        ";
      if ($GLOBALS['ultimaPagina'] == "menuLista" or
          $GLOBALS['ultimaPagina'] == "menuInicial") {
        if ($GLOBALS['quantidadeCadastros']>0) {
          echo "<button type='submit' id='thanos' class='btn btn-outline-danger btn-sm' name='botaoExcluiTodos' value='x'>Excluir todos</button>";
        }
      }elseif ($GLOBALS['ultimaPagina'] == "pesquisasLista" or
               $GLOBALS['ultimaPagina'] == "pesquisasInicial") {
        if (count($GLOBALS['ultimaPesquisa'])>0) {
          echo "<button type='submit' id='thanos' class='btn btn-outline-danger btn-sm' name='botaoExcluiTodos' value='x'>Excluir todos</button>";
        }
      }
      echo "
        <button type='submit' class='btn btn-danger btn-sm' name='botaoFechaTabela' value='x'>
          <i class='material-icons'>clear</i>
        </button>
      </form>
      <br>
      <table class='table table-hover'>
        <caption>Lista de Contatos</caption>
        <thead>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>Nome</th>
            <th scope='col'>Telefone</th>
            <th scope='col'>E-mail</th>
            <th scope='col'>Data Nasc.</th>
            <th scope='col'>Alterar</th>
            <th scope='col'>Excluir</th>
          </tr>
        </thead>
        <tbody>";
      }
  function retornaEscolhidos($vetorComcadastros, $vetorComIndices){//recebe os cadastros e os indices para imprimir a tabela
      $limite = count($vetorComIndices);//limite conta quantos indices tem
        cabeçalhoTabela();//imprime o cabeçalho da tabela
          for($x=0; $x<$limite; $x++){//executa um for que percorre todos os indices do Vetor com os indices
            $y = $vetorComIndices[$x];//$y é igual indice do primeiro cadastro
            echo "<tr>";//cria linha na tabela
            echo "<th scope='row'>$y</th>";//escreve qual é o indice
            foreach ($vetorComcadastros[$y] as $string){//percorre todos os dados do cadastro com indice $y
              echo "<td>$string</td>";//cria uma celula e dentro escreve o dado
            }
            echo "<td>",botaoAlterar($y),"</td>";//cria uma celula e põe dentro o botão alterar com o indice que ele deve alterar caso clicado
            echo "<td>",botaoExcluir($y),"</td>";
            echo "</tr>";//finaliza a linha
          }
          echo "</tbody>";//encerra o corpo da tabela
          echo "</table>";//encerra a tabela
    }
//----------------------------------------------------------------
//-------------------Ultimo botao CLicado-------------------------
  function ultimoBotaoClicado(){
    clicadoInserir();
    clicadoPesquisasAvancadas();
    clicadoListar();
    clicadoSubmitFormulario();
    clicadoCancelarCadastro();
    clicadoAlterar();
    clicadoExcluir();
    clicadoBuscar();
    clicadoVoltar();
    clicadoFechaTabela();
    clicadoExcluiTodos();
    nenhumClicado();
  }
  function clicadoInserir(){
    if ($GLOBALS['botaoInserir'] == "Inserir") {
      formularioCadastro($GLOBALS['quantidadeCadastros'],null,null,null,null);
    }
  }
  function clicadoPesquisasAvancadas(){
    if ($GLOBALS['pesquisasAvancadas'] == "pesquisar") {
      pesquisasInicial();
    }
  }
  function clicadoListar(){
    if ($GLOBALS['botaoListar'] == "listar") {
      menuLista();
    }
  }
  function clicadoSubmitFormulario(){
    if ($GLOBALS['submitFormulario'] != null) {
      $numeroCadastro = $GLOBALS['submitFormulario'];
      $cadastrosLocal = $GLOBALS['cadastros'];//Salva os cadastros globais em um array
      $nomeCobaia = $GLOBALS['nomeFormulario'];
      fazMensagemErroCadastro($nomeCobaia);
      if (!$GLOBALS['mandaMensagem']){//se todos os cadastros foram preechidos
        salvaCadastro();
        abreUltimaPagina();
      }else{
        mandaMensagem();
        formularioCadastro($numeroCadastro, $GLOBALS['primeiroInput'], $GLOBALS['segundoInput'], $GLOBALS['terceiroInput'], $GLOBALS['quartoInput']);
      }
    }
  }
  function clicadoCancelarCadastro(){
    if ($GLOBALS['cancelarCadastro'] == "cancelarCadastro") {
      abreUltimaPagina();
    }
  }
  function clicadoAlterar(){
    if ($GLOBALS['botaoAlterar'] != null) {
      $cadastrosLocal = $GLOBALS['cadastros'];
      $numeroCadastro = $GLOBALS['botaoAlterar'];
      $primeiroInput = "<input type='text' class='form-control'
                         name='nomeFormulario' id='inputName'
                         placeholder='Nome' value='".$cadastrosLocal[$numeroCadastro][0]."'autocomplete='off'>";
      $segundoInput = "<input type='text' class='form-control'
                        pattern='\(\d{2}\) \d{5}-\d{4}' name='telefoneFormulario'
                        id='inputTel' placeholder='(DD) nnnnn-nnnn' value='".$cadastrosLocal[$numeroCadastro][1]."'autocomplete='off'>";
      $terceiroInput = "<input type='email' class='form-control'
                        name='emailFormulario' id='inputEmail'
                        placeholder='Email' value='".$cadastrosLocal[$numeroCadastro][2]."'autocomplete='off'>";
      $quartoInput = "<input type='date' class='form-control'
                        name='dataNascimentoFormulario' id='inputDataNasc' value='".$cadastrosLocal[$numeroCadastro][3]."'autocomplete='off'>";
      formularioCadastro($numeroCadastro,$primeiroInput,$segundoInput,$terceiroInput,$quartoInput);
    }
  }
  function clicadoExcluir(){
    if ($GLOBALS['botaoExcluir'] != null) {
      excluir($GLOBALS['botaoExcluir']);
      if ($GLOBALS['ultimaPesquisa'] != null) {
        novaPesquisa($GLOBALS['botaoExcluir']);
      }
      abreUltimaPagina();
    }
  }
  function clicadoBuscar(){
    if ($GLOBALS['botaoBuscar'] == "buscar") {
      verificaFormularioPesquisa($GLOBALS['mesAniversario'],$GLOBALS['emailPesquisa'],$GLOBALS['aproximacao']);
    }
  }
  function clicadoVoltar(){
    if ($GLOBALS['botaoVoltar'] == "voltar") {
      menuInicial();
    }
  }
  function clicadoFechaTabela(){
    if ($GLOBALS['botaoFechaTabela'] == "x") {
      if ($GLOBALS['ultimaPagina'] == "menuLista") {
        menuInicial();
      }else if ($GLOBALS['ultimaPagina'] == "pesquisasLista") {
        pesquisasInicial();
      }
    }
  }
  function clicadoExcluiTodos(){
    if($GLOBALS['botaoExcluiTodos'] != null){
      if ($GLOBALS['ultimaPagina'] == "menuLista") {
        $aux = array();
        $GLOBALS['cadastros'] = $aux;
        $GLOBALS['cadastros'] = json_encode($GLOBALS['cadastros']);//converte os cadastros em json
        $fp = fopen("json/cadastros.json","w");//abre arquivo json em que ele será salvo
        fwrite($fp, $GLOBALS['cadastros']);//salva os cadastros no arquivo json
        fclose($fp);//fecha o arquivo
        $GLOBALS['cadastros'] = json_decode($GLOBALS['cadastros']);//transforma em um arrai os cadastros novamente
        dadosCadastros();
        menuInicial();
      }else if ($GLOBALS['ultimaPagina'] == "pesquisasLista") {
        for ($i=count($GLOBALS['ultimaPesquisa']); $i > 0 ; $i--) {
          excluir($GLOBALS['ultimaPesquisa'][$i-1]);
        }
        pesquisasInicial();
        echo "<center><img src='assets/loading.gif' width='20%'></center>";
      }
    }
  }
  function nenhumClicado(){
    if ($GLOBALS['botaoInserir'] == null and
        $GLOBALS['pesquisasAvancadas'] == null and
        $GLOBALS['botaoListar'] == null and
        $GLOBALS['submitFormulario'] == null and
        $GLOBALS['cancelarCadastro'] == null and
        $GLOBALS['botaoAlterar'] == null and
        $GLOBALS['botaoExcluir'] == null and
        $GLOBALS['botaoBuscar'] == null and
        $GLOBALS['botaoVoltar'] == null and
        $GLOBALS['botaoFechaTabela'] == null and
        $GLOBALS['botaoExcluiTodos'] == null) {
        menuInicial();
    }
  }
  //--------------------------Validação Formulario----------------
  function fazMensagemErroCadastro($nomeCobaia){
    if (!validaNome($nomeCobaia)) {
      $GLOBALS['mandaMensagem'] = true;
      $GLOBALS['mensagem'] = $GLOBALS['mensagem']."<li>Informe nome somente com Letras</li>";
    }
    if ($GLOBALS['nomeFormulario'] == null) {
      $GLOBALS['mandaMensagem'] = true;
      $GLOBALS['mensagem'] = $GLOBALS['mensagem']."<li>Informe um nome no campo Nome</li>";
    }else{
      $GLOBALS['primeiroInput'] = "<input type='text' class='form-control' name='nomeFormulario'
                        placeholder='nome' value='".$GLOBALS['nomeFormulario']."'>";
    }
    if ($GLOBALS['telefoneFormulario'] == null) {
      $GLOBALS['mandaMensagem'] = true;
      $GLOBALS['mensagem'] = $GLOBALS['mensagem']."<li>Informe um telefone no campo telefone</li>";
    }else{
      $GLOBALS['segundoInput'] = "<input type='text' pattern='\(\d{2}\) \d{5}-\d{4}' class='form-control'
                        name='telefoneFormulario' id='inputTel' placeholder='(DD) nnnnn-nnnn'
                        value='".$GLOBALS['telefoneFormulario']."'>";
    }
    if ($GLOBALS['emailFormulario'] == null) {
      $GLOBALS['mandaMensagem'] = true;
      $GLOBALS['mensagem'] = $GLOBALS['mensagem']."<li>Informe um email no campo Email</li>";
    }else{
      $GLOBALS['terceiroInput'] = "<input type='email' class='form-control' name='emailFormulario'
                        placeholder='e-mail' value='".$GLOBALS['emailFormulario']."'>";
    }
    if ($GLOBALS['dataNascimentoFormulario'] == null) {
      $GLOBALS['mandaMensagem'] = true;
      $GLOBALS['mensagem'] = $GLOBALS['mensagem']."<li>Informe uma data de nascimento no campo Data de Nasc.</li>";
    }else{
      $GLOBALS['quartoInput'] = "<input type='date' class='form-control' name='dataNascimentoFormulario'
                      value='".$GLOBALS['dataNascimentoFormulario']."'>";
    }
  }
  function salvaCadastro(){
    $dadosCadastro =//encapsula os dados em um array
    array($GLOBALS['nomeFormulario'],
          $GLOBALS['telefoneFormulario'],
          $GLOBALS['emailFormulario'],
          $GLOBALS['dataNascimentoFormulario']);
    if ($GLOBALS['submitFormulario']<$GLOBALS['quantidadeCadastros']) {//se o indice passado for menor que o número de pessoas cadastradas signica que o cadastro existe
      $GLOBALS['cadastros'][$GLOBALS['submitFormulario']]=$dadosCadastro;//pega o array cadastro global no idice informado e salva os novos dados
    }else{//caso seja um valor maior não existem cadastros com esse indice logo é um novo cadastro
    array_push($GLOBALS['cadastros'], $dadosCadastro);//cria nova posição nos cadastros e salva esses novos dados
    }
    $GLOBALS['cadastros'] = json_encode($GLOBALS['cadastros']);//converte os cadastros em json
    $fp = fopen("json/cadastros.json","w");//abre arquivo json em que ele será salvo
    fwrite($fp, $GLOBALS['cadastros']);//salva os cadastros no arquivo json
    fclose($fp);//fecha o arquivo
    $GLOBALS['cadastros'] = json_decode($GLOBALS['cadastros']);//transforma em um arrai os cadastros novamente
    dadosCadastros();
  }
  function mandaMensagem(){
    echo "
      <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        ".$GLOBALS['mensagem']."
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
    ";
  }
  function validaNome($nome){
    return (filter_var($nome, FILTER_SANITIZE_NUMBER_INT) === '' ? true : false);
  }
  //--------------------------------------------------------------
  //---------------------Exclui os dados--------------------------
  function excluir($indiceCadastro){//função que pega o indice do cadastro e exclui aquele cadastro
          $GLOBALS['cadastros'] = excluiElementoArray($GLOBALS['cadastros'], $indiceCadastro);//exclui um elemento recebido por parametro dos cadastros
          $GLOBALS['cadastros'] = json_encode($GLOBALS['cadastros']);//codifica para json
          $fp = fopen("json/cadastros.json","w");//abre o arquivo json em que será salvo o cadastro
          fwrite($fp, $GLOBALS['cadastros']);//salva a alteração no arquivo json
          fclose($fp);//fecha o arquivo json
          $GLOBALS['cadastros'] = json_decode($GLOBALS['cadastros']);//decodifica os cadastro para um array php novamente
          dadosCadastros();
      }
  function excluiElementoArray($vetor, $indice){//função que exlui um elemento do array, ela recebe o array base, e o indice que vai alterar
        $novoArray = array();//array que recebera os dados e será retornado
        for ($i=0; $i <$indice ; $i++) {//repetição ate o ultimo termo antes daquele que será excluido
          $novoArray[$i] = $vetor[$i];//salva o termo do vetor recebido no novo $i em $i
        }
        for ($i=$indice; $i < (count($vetor)-1) ; $i++) {//repetição que começa no indice que será excluido e termina no número de elementos que o novo array terá que é o antigo array -1
          $novoArray[$i] = $vetor[$i+1];//novo array continua com os indices sequentemente, e o $vetor pula o idice excluido para continual
        }//$i em $i+1
        return $novoArray;//retorna o novo array
      }
    //---Botão pesquisasAvançadas----
  //--------------------------------------------------------------
  //---------------------Pesquisas Avançadas------------------------
    function verificaFormularioPesquisa($mes, $dominio, $caracteresAproximacao){//Recebe o valor do mês, dominio e string aproximacao
      $criaTabela = false;
      $indicesComMes = indicesComMes($mes);
      $indicesDominio = indicesComDominio($dominio);
      $indicesString = indicesComString($caracteresAproximacao);
      $indicesFinal = null;

      //=================VERIFICA SE TODOS ENVIADOS===============
      if ($mes != null and $dominio != '@' and $caracteresAproximacao != null) {//se todos enviados
        $indicesTresVetores = indicesTresVetores($indicesComMes, $indicesDominio, $indicesString);
        if ($indicesTresVetores != false) {
          $indicesFinal = $indicesTresVetores;
          $criaTabela = true;
        }
      }else
      //=================VERIFICA SE DOIS EMVIADOS================
      if($mes != null and $dominio != '@' and $caracteresAproximacao == null){//se o mes e dominio foram enviados
        $indicesDoisVetores = indicesDoisVetores($indicesComMes, $indicesDominio);
        if ($indicesDoisVetores != false) {
          $indicesFinal = $indicesDoisVetores;
          $criaTabela = true;
        }
      }else
      if($mes != null and $dominio == '@' and $caracteresAproximacao != null){//se o mes e a os caracteres foram enviados
        $indicesDoisVetores = indicesDoisVetores($indicesComMes, $indicesString);
        if ($indicesDoisVetores != false) {
          $indicesFinal = $indicesDoisVetores;
          $criaTabela = true;
        }
      }else
      if($mes == null and $dominio != '@' and $caracteresAproximacao != null){//se o dominio e a os caracteres foram enviados
        $indicesDoisVetores = indicesDoisVetores($indicesString, $indicesDominio);
        if ($indicesDoisVetores != false) {
          $indicesFinal = $indicesDoisVetores;
          $criaTabela = true;
        }
      }else
      //============VERIFICA SE SÓ UM ENVIADO=====================
      if($mes != null and $dominio == '@' and $caracteresAproximacao == null){//se o mes foi enviados
        if ($indicesComMes != false) {
          $indicesFinal = $indicesComMes;
          $criaTabela = true;
        }
      }else
      if($mes == null and $dominio != '@' and $caracteresAproximacao == null){//se o dominio foi enviados
        if ($indicesDominio != false) {
          $indicesFinal = $indicesDominio;
          $criaTabela = true;
        }
      }else
      if($mes == null and $dominio == '@' and $caracteresAproximacao != null){//se os caracteres foram enviados
        if ($indicesString != false) {
          $indicesFinal = $indicesString;
          $criaTabela = true;
        }
      }

      if ($criaTabela == true) {
        salvaUltimaPesquisa($indicesFinal);
        pesquisasLista();
      }else{
        nenhumCadastroEncontrado();
        pesquisasInicial();
      }
    }
    //================funções da aniversariantes====================
    function indicesComMes($mes){//função que filtra os indices
      $indices = array();//declara o arry que vai receber os indices
      $cont = 0;//indice do array indices
      $cadastrosLocal = $GLOBALS['cadastros'];//para facilitar a manipulação cadastros Global é passado para um array Local
      for ($i=0; $i <$GLOBALS['quantidadeCadastros'] ; $i++) {//passa por todos os cadastros
          $data = explode("-",$cadastrosLocal[$i][3]);//pega a data de aniversario e separa em dia, mes, e ano
          $mesCadastro = $data[1];//pega a posição em que está o mês
          if($mesCadastro == $mes){//se o mês em que a pessoa nasceu for igual ao informado
            $indices[$cont] = $i;//salva o número de cadastro dessa pessoa
            $cont++;//passa pra proxima posição do vetor
          }
      }
      if(count($indices) == null){//se ela não receber nenhum indice
        return false;//a função retorna o valor booleano falso
      }else{//se tiver algum cadastro
        return $indices;//retorna o vetor com os indices
      }
    }
    //=================funções da dominioEmail======================
    function indicesComDominio($dominio){//filtra os indices
      $indices = array();//declara o array onde os indices serão salvos
      $cont = 0;//contador responsável pelos indices do array Indices
      $cadastrosLocal = $GLOBALS['cadastros'];//para facilitar a manipulação cadastros Global é passado para um array Local
      for ($i=0; $i <$GLOBALS['quantidadeCadastros'] ; $i++) {//passa por todos os cadastros
          $email = explode('@', $cadastrosLocal[$i][2]);//separa o email da pessoa cadastrada a partir do @ tudo depoi dela será o dominio
          $dominioCadastro = "@".$email[1];//como o arroba faz parte do domino ela é posta de novo
          if($dominioCadastro == $dominio){//se o diminio do cadastro for igual ao informado
            $indices[$cont] = $i;//salva o indice do cadastro no array indices
            $cont++;//prepara a próxima posição do vetor
          }
      }
      if(count($indices) == null){//se o arry indices não tiver recebido nenhum array
        return false;//função retor o valor bolleano falso
      }else{//casso exista algum cadastro com esse dominio
        return $indices;//retorna o array com os indices
      }
    }
    //============funções da busca por aproximação==================
    function indicesComString($string){//função que filtra os indices
      $indices = array();//array em que os indices serão salvos
      $cont = 0;//indice do array indices
      $cadastrosLocal = $GLOBALS['cadastros'];//para facilitar a manipulação cadastros Global é passado para um array Local
      $stringSeparada = str_split($string);//Pega a string informada e transforma em um array onde cada posição ira conter um carcter da string original
      $numCaracteresString = count($stringSeparada);//conta quantos carcteres a string informada tem
      for ($i=0; $i <$GLOBALS['quantidadeCadastros']; $i++) {//percorre todos os cadastros
        $nome = $cadastrosLocal[$i][0];//salva em uma váriavel o nome do usuário $i
        $nome = str_split($nome);//separa o nome em carcteres
        $numCaracteresNome = count($nome);//conta o numero de caracteres que o nome tera
        $repeticoes = $numCaracteresNome - $numCaracteresString;//a operação vai rodar enquanto tiver um número de carteres no nome maior que a string informada
        for ($x=0; $x <= $repeticoes ; $x++) {//laço de repetição respomsável por percorrer todo o nome
          $stringAux = '';//icia a string que será formada a partir do nome
          for ($q=$x; $q < ($x+$numCaracteresString) ; $q++) {//for responsável por colocar os carcteres na string
           $stringAux = $stringAux.$nome[$q];//contatenação dos carteres
          }
          if ($string == $stringAux) {//se a string formada for igual a que o usuário informou
            // echo "String informada: $string<br>";
            // echo "String feita pelo nome: $string<br>";
            $indices[$cont] = $i;//salva o indice do cadastro no array indices
            $cont++;//prepara a próxima posição do vetor
            $x = $repeticoes;//para a execução do for para que ele vá para o próximo cadastro
          }
        }
      }
      if ($indices != null) {//se algum cadastro tiver se encaixado na busca
        return $indices;//ele retorna o array $indices
      }else{
        return false;//caso não tenha nenhum cadastro o valor informdo a função retorna o valor boleano falso
      }
    }
    //==========função que cria um único vetor com os indices=======
    function indicesDoisVetores($vetor1, $vetor2){
      $indices = array();
      $cont = 0;
      if ($vetor1 != false and $vetor2 != false) {
        for ($i=0; $i < count($vetor1) ; $i++) {
          $auxiliar = $vetor1[$i];
          for ($q=0; $q < count($vetor2) ; $q++) {
            if($auxiliar==$vetor2[$q]){
              $indices[$cont] = $auxiliar;
              $cont++;
              $q = count($vetor2)+1;
            }
          }
        }
        if ($indices != null) {
          return $indices;
        }else{
          return false;
        }
      }else{
        return false;
      }

    }
    function indicesTresVetores($vetor1, $vetor2, $vetor3){
      if ($vetor1 != false and $vetor2 != false and $vetor3 != false) {
        $vetor1Mais2 = indicesDoisVetores($vetor1, $vetor2);
        if ($vetor1Mais2 != false) {
          $indices = array();
          $cont = 0;
          for ($i=0; $i < count($vetor1Mais2) ; $i++) {
            $auxiliar = $vetor1Mais2[$i];
            for ($q=0; $q < count($vetor3) ; $q++) {
              if($auxiliar==$vetor2[$q]){
                $indices[$cont] = $auxiliar;
                $cont++;
                $q = count($vetor3)+1;
              }
            }
          }
          if ($indices != null) {
            return $indices;
          }else{
            return false;
          }
        }else {
          return false;
        }
      }else{
        return false;
      }
    }
    function nenhumCadastroEncontrado(){
      echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Ooops!</strong> Nenhum cadastro encontrado.
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
      ";
    }
  //----------------------------------------------------------------


?>
