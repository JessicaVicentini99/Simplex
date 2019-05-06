<?php
error_reporting(0);

$restricoes = $_POST['restricoes'];

//variavel global q armazena todas as interações realizadas
$interacoes = [];
$contador = 0;
$tabelas  = [];
$valores_iniciais = [];
$qtd_variaveis = 0;

//chama função inicial
echo montarTabela($restricoes);

/**
 * Função inicial que prepara todas as variaveis antes de dar inicio a logica
 * @param $restricoes
 */
function montarTabela($restricoes)
{   
    $restricoes = adicionarFolgas($restricoes);
    
    $GLOBALS['valores_iniciais'] = retornaValorInicial($restricoes);

    if($_POST['type-function'] != 'min'){
        $restricoes = inverteSinalZ($restricoes);
    }

    $pos = $GLOBALS['contador'];
    $GLOBALS['interacoes'][$pos]['entra'] = null;
    $GLOBALS['interacoes'][$pos]['sai'] = null;
    $GLOBALS['interacoes'][$pos]['base'] = $restricoes;
    verificacao($restricoes);
}

/**
 * Método adiciona folgas que não existem com valor 0
 */
function adicionarFolgas($restricoes)
{
    $qtdFolgas =  count($restricoes)-1; //verifica quantas folgas são necessarias o numero de restriçoes-1
    $GLOBALS['qtd_variaveis'] = $qtdFolgas;

    $restricoes[0]['colunas']['B'] = 0;

    foreach ($restricoes as $key => $value) {
        for($numeroFolga = 1; $numeroFolga  <= $qtdFolgas; $numeroFolga ++) {
            //verica se a folga ja existe se não adiciona 0
            if(array_key_exists('F'.$numeroFolga , $value['colunas']) == null){
                $value['colunas']+= ['F'.$numeroFolga=>0];
                $restricoes[$key]['colunas'] = $value['colunas'];
            }
        }
        ksort($restricoes[$key]['colunas']);
    }
    return $restricoes;
}

/*
 * Método que monta a tabela da iteração
 * @param $interacao
 */
function montarTabelaView($interacoes)
{
    $html = '';
    $html .= "<table class='table table-bordered'>";

    /**
     * Monta a primeira linha da tabela
     */

    $col = array_reverse($interacoes['base'][0]['colunas']);

    $html .= "<thead>";
    $html .= "<tr>";
    $html .= "<th>";
    $html .= "Base";
    $html .= "</th>";

    foreach ($col as $key => $value) {
        $html .= "<th>";
        $html .= $key;
        $html .= "</th>";
    }

    $html .= "</tr>";
    $html .= "<thead>";

    /**
     * Fim primeira linha
     */

    /**
     * Restante da tabela
     */

    $html .= "<tbody>";
    foreach ($interacoes["base"] as $key => $value) {
        $colunas =  array_reverse($value["colunas"]);

        $html .= "<tr>";
        $html .= "<td class='td-first-col'>";
        $html .= $value["linha"];
        $html .= "</td>";

        foreach ($colunas as $i => $col) {
            $html .= "<td>";
            $html .= $col;
            $html .= "</td>";
        }

        $html .= "</tr>";
    }
    $html .= "</tbody>";

    $html .= "</table>";
    /**
     * Fim restante da tabela
     */


    return $html;
}

/*
 * Método inverte o sinal da função objetiva Z
 */
function inverteSinalZ($restricoes)
{
    foreach ($restricoes[0]['colunas'] as $key => $value) {
        $restricoes[0]['colunas'][$key] = (-$value);
    }
    return $restricoes;
}

function retornaColunaB($interacoes){
    $aux = [];
    $pos = 0;

    $last = count($interacoes)-1;

    foreach ($interacoes[$last]['base'] as $key => $value) {
       $aux[$pos] = $value['colunas']['B']; 
       $pos++;
    }

    unset($aux[0]);
    $aux = array_values($aux);

    return $aux;
}

/**
 * Função que retornará o valor final de todas as variáveis
 * @param $restricoes
 */
function retornaValorFinal($interacoes){
    $aux = [];
    $pos = 0;

    $last = count($interacoes)-1;

    foreach ($interacoes[$last]['base'] as $key => $value) {
       $aux[$value['linha']] = $value['colunas']['B']; 
    }

    $achou  = false;

    /*Completa com 0 as variáveis que não estão na base*/
    foreach ($interacoes[0]['base'][0]['colunas'] as $key => $value) {
        foreach ($aux as $i => $variaveis) {
            if($key == $i){
                $achou = true;
                break;
            }
        }

        if(!$achou){
            $aux[$key] = 0;
        }

        $achou = false;
    }

    unset($aux['B']);

    ksort($aux);

    return $aux;
}

/**
 * Função que retornará os valores iniciais de todas as variáveis
 * @param $restricoes
 */
function retornaValorInicial($restricoes){
    $aux = [];
    $pos = 0;

    foreach ($restricoes as $key => $value) {
        $aux[$value['linha']] = $value['colunas']['B'];
    }


    for($i=1; $i<=$GLOBALS['qtd_variaveis']; $i++){
        $aux['X'.$i] = 0;
    }
    
    ksort($aux);

    return $aux;
}

function retornaUltimaLinhaZ($interacoes){
    $last = count($interacoes)-1;
    $z = array();
    $folga = array();

    foreach ($interacoes[$last]['base'] as $key => $value) {
        if($value['linha'] = 'Z'){
            $z = $value['colunas'];
            break;
        }
    }
    
    for($i = 0; $i < count($z); $i++) {
        if($z['X'.$i] > 0){
            $z['X'.$i] = 0;
        }
    }

    $z['Z'] = 0;
    unset($z['B']);
    ksort($z);

    return $z;
}

function montaArrayVazio(){
    $aux = array();
    
    for ($i=1; $i <= $GLOBALS['qtd_variaveis']; $i++) { 
        $aux['F'.$i] = 0;
    }

    for ($i=1; $i <= $GLOBALS['qtd_variaveis']; $i++) { 
        $aux['X'.$i] = 0;
    }

    ksort($aux);

    return $aux;
}

function retornaDivisaoColuna($b, $f, $tipo, $array, $j){
    $div = array();
    $neg = array(); //negativos
    $pos = array(); //positivos
    $linhas = count($b);

    for ($i=0; $i < $linhas; $i++) { 
        $div[$i] = ($b[$i]/$f[$i])*-1;
    }

    foreach ($div as $key => $value) {
        if($value > 0){
            $pos[$key] = $value;
        }else{
            $neg[$key] = $value;
        }
    }

    //pega o menor valor dos positivos e o maior valor dos negativos
    if($tipo == 'max'){
        if(empty($pos)){
            $array['F'.$j] = 0;
        }else{
            $array['F'.$j] = min($pos);
        }
    }else{
        if(empty($pos)){
            $array['F'.$j] = 0;
        }else{
            $array['F'.$j] = max($neg)*-1;
        }
    }

    $array['Z'] = 0;

    return $array;
}


/*Não terminou*/
function montarTabelaSensibilidade($valores_finais, $valores_iniciais, $preco_sombra, $max, $min){
    
    $html = '';
    $html .= "<table class='table table-bordered'>";


    $html .= '<thead>';
    $html .= '<th>';
    $html .= 'Variaveis';
    $html .= '<th>';

    foreach ($valores_finais as $key => $value) {
        $html .= '<th>';
        $html .= $key;
        $html .= '</th>';
    }

    $html .= '</thead>';

    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'Valores Iniciais';
    $html .= '<td>';

    foreach ($valores_iniciais as $key => $value) {
        $html .= '<td>';
        $html .= $value;
        $html .= '</td>';
    }

    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'Valores Finais';
    $html .= '<td>';

    foreach ($valores_finais as $key => $value) {
        $html .= '<td>';
        $html .= $value;
        $html .= '</td>';
    }

    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'Preço Sombra';
    $html .= '<td>';

    foreach ($preco_sombra as $key => $value) {
        $html .= '<td>';
        $html .= $value;
        $html .= '</td>';
    }

    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'Máximo';
    $html .= '<td>';

    foreach ($max as $key => $value) {
        $html .= '<td>';
        $html .= $value;
        $html .= '</td>';
    }

    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td>';
    $html .= 'Mínimo';
    $html .= '<td>';

    foreach ($min as $key => $value) {
        $html .= '<td>';
        $html .= $value;
        $html .= '</td>';
    }

    $html .= '</tr>';

    $html .= '</table>';

    return $html;

}

function retornaColunaFolga($interacoes, $n){
    $aux = [];
    $pos = 0;

    $last = count($interacoes)-1;

    foreach ($interacoes[$last]['base'] as $key => $value) {
       $aux[$key] = $value['colunas']['F'.$n]; 
    }

    unset($aux[0]);
    $aux = array_values($aux);
    return $aux;
}

function buscaRelatorioSensibilidade(){
    /*Montagem do Relatório de Sensibilidade com uma lógica louca*/
    $max = montaArrayVazio();
    $b = retornaColunaB($GLOBALS['interacoes']);

    for ($i=1; $i <= $GLOBALS['qtd_variaveis']; $i++) { 
       $f = retornaColunaFolga($GLOBALS['interacoes'], $i);
       $max = retornaDivisaoColuna($b, $f, 'max', $max, $i);
    }

    $min = montaArrayVazio();
    $b = retornaColunaB($GLOBALS['interacoes']);

    for ($i=1; $i <= $GLOBALS['qtd_variaveis']; $i++) { 
       $f = retornaColunaFolga($GLOBALS['interacoes'], $i);
       $min = retornaDivisaoColuna($b, $f, 'min', $min, $i);
    }

    $valores_finais = retornaValorFinal($GLOBALS['interacoes']);

    $html = montarTabelaSensibilidade($valores_finais, $GLOBALS['valores_iniciais'], retornaUltimaLinhaZ($GLOBALS['interacoes']), $max, $min);

    return $html;
}


/**
 * Função principal que é responsavel pela logica do algoritmo chamada recursivamente
 * @param $restricoes
 */
function verificacao($restricoes)
{
    $min = chaveMenorValorDeZ($restricoes);
    $coluna = buscaColunaQueEntra($restricoes, $min); //valor q vai entrar coluna q vai sair
    $colunaCapacidade = buscaColunaDeCapacidade($restricoes);
    $resultado = dividePelaColunaCapacidade($coluna, $colunaCapacidade);
    $keyMenor = buscaMenorPositivo($resultado); //valor q vai sair linha q vai sair
    $pivot = $restricoes[$keyMenor]['colunas'][$min]; //pivot

    if($pivot!=1){
        $newRestricoes = tranformaPivotEmUm($restricoes, $keyMenor, $pivot);//tranforma pivot em um e toda a linha
        $restricoes[$keyMenor] = $newRestricoes; //realiza a troca dos valores
    }
    $pos= $GLOBALS['contador']+=1;
    $GLOBALS['interacoes'][$pos]['entra'] = $min;
    $GLOBALS['interacoes'][$pos]['sai'] = $restricoes[$keyMenor]['linha'];

    $restricoes = zerarColunaPivot($restricoes, $min, $keyMenor);
    $restricoes[$keyMenor]['linha'] = $min; // trocou o nome da lina pela variavel q entra

    $GLOBALS['interacoes'][$pos]['base'] = $restricoes;

    if (existeNegativosEmZ($restricoes)) {
        verificacao($restricoes);
    };

    /*Montagem do Relatório de Sensibilidade com uma lógica louca*/
    $max = montaArrayVazio();
    $b = retornaColunaB($GLOBALS['interacoes']);

    for ($i=1; $i <= $GLOBALS['qtd_variaveis']; $i++) { 
       $f = retornaColunaFolga($GLOBALS['interacoes'], $i);
       $max = retornaDivisaoColuna($b, $f, 'max', $max, $i);
    }

    $min = montaArrayVazio();
    $b = retornaColunaB($GLOBALS['interacoes']);

    for ($i=1; $i <= $GLOBALS['qtd_variaveis']; $i++) { 
       $f = retornaColunaFolga($GLOBALS['interacoes'], $i);
       $min = retornaDivisaoColuna($b, $f, 'min', $min, $i);
    }

    if($_POST['passo-a-passo'] == 'OK'){
        /*Matheus, fua função sai daqui. Este foi o modo de mesclar o que eu já tinha feito com o seu...
          O else está mandando a solução direta.*/
        $dados['interacoes'] = $GLOBALS['interacoes'];
        $dados['sensibilidade'] = buscaRelatorioSensibilidade();
        print json_encode($dados);
    }else{

        /**
         * Montagem das tabelas pra visualização
         */
        foreach ($GLOBALS['interacoes'] as $key => $value) {
            $tabelas[] = montarTabelaView($value);
        }

        $dados_retorno_json['dados']['tabela'] = $tabelas;
        $dados_retorno_json['dados']['valores_finais'] = retornaValorFinal($GLOBALS['interacoes']);
        $dados_retorno_json['dados']['valores_iniciais'] = $GLOBALS['valores_iniciais'];
        $dados_retorno_json['dados']['sensibilidade'] = montarTabelaSensibilidade($dados_retorno_json['dados']['valores_finais'], $GLOBALS['valores_iniciais'], retornaUltimaLinhaZ($GLOBALS['interacoes']), $max, $min);
        $dados_retorno_json['dados']['tipo_funcao'] = $_POST['type-function'];

        print json_encode($dados_retorno_json);
    }

    die();
}

/**
 * metodo retorna um array com os valores da linha do pivot
 * @param $restricoes
 * @param $key
 * @return array
 */
function getLinhaPivot($restricoes, $key)
{
    $linhaPivot = [];
    //divide a linha pelo o valor do pivot para que o mesmo seja = 1
    foreach ($restricoes[$key]['variaveis'] as $key => $value) {
        $linhaPivot[] = $value;
    }

    return $linhaPivot;
}

/**
 * Verifica se ainda existem numeros negativos em Z
 */
function existeNegativosEmZ($restricoes)
{
    return min($restricoes[0]['colunas']) < 0 ? true : false;
}

function zerarColunaPivot($restricoes, $min, $keyPivot)
{
    foreach ($restricoes as $key => $linha) {
        if ($key == $keyPivot) {
            continue;
        }
        if($linha['colunas'][$min] == 0) {
            continue;
        }
        $numeroInv = (-$linha['colunas'][$min]);
        foreach ($linha['colunas'] as $colName => $colValue) {
            $restricoes[$key]['colunas'][$colName] = ($restricoes[$keyPivot]['colunas'][$colName]) * $numeroInv + ($restricoes[$key]['colunas'][$colName]);
        }
    }
    return $restricoes;
}

function chaveMenorValorDeZ($restricoes)
{
    $min = min($restricoes[0]['colunas']);
    $keyMin = array_search($min, $restricoes[0]['colunas']);
    return $keyMin;
}

/**
 * Busca coluna que possui o menor valor na funçao Z, é a coluna que vai entrar
 * @param $restricoes
 * @param $min
 * @return array
 */
function buscaColunaQueEntra($restricoes, $min)
{
    $coluna = [];
    foreach ($restricoes as $key => $value) {
        if ($value['linha'] == 'Z') {
            continue;
        }

        $coluna[] = $value['colunas'][$min];
    }
    return $coluna;
}

function buscaColunaDeCapacidade($restricoes)
{
    $coluna = [];

    foreach ($restricoes as $key => $value) {
        if($value['linha'] === 'Z')
            continue;

        $coluna[] = intval($value['colunas']['B']);
    }

    return $coluna;
}

/**
 * Divide a coluna que vai entrar pela coluna de capacidade
 */
function dividePelaColunaCapacidade($colunaEntra, $colunaBase)
{
    $resultado = [];
    foreach ($colunaEntra as $key => $value) {
        if($value == 0){
            $resultado[] = null;
            continue;
        }
        $resultado[] = $colunaBase[$key] / $value;
    }

    return $resultado;
}

/**
 * Busca o menor numero positivo do resultado
 * @param $array
 * @return false|int|string|null
 */
function buscaMenorPositivo($array)
{
    //Pega o maior valor do array para não correr o risco de pegar o primeiro e esse ser um valor negativo
    $menor = max($array);
    if($menor < 0){
        return null;
    }
    foreach ($array as $key => $value) {
        if($value!=null && $value >=0 && $value < $menor){
            $menor = $value;
        }
    }
    //retorna a chave do menor valor somado 1 pois os indices das restrições começão em 1
    return array_search($menor, $array)+1;
}

function  tranformaPivotEmUm($restricoes, $key, $pivot)
{
    //divide a linha pelo o valor do pivot para que o mesmo seja = 1
    foreach ($restricoes[$key]['colunas'] as $col => $value) {
        $restricoes[$key]['colunas'][$col] = $value / $pivot;
    }
    return $restricoes[$key];
}
