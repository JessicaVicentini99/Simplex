<?php
$restricoes = $_POST['restricoes'];
//variavel global q armazena todas as interações realizadas
$interacoes = [];
$contador = 0;

//chama função inicial
echo montarTabela($restricoes);

/**
 * Função inicial que prepara todas as variaveis antes de dar inicio a logica
 * @param $restricoes
 */
function montarTabela($restricoes)
{
    $restricoes = adicionarFolgas($restricoes);
    $restricoes = inverteSinalZ($restricoes);
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
 * Método inverte o sinal da função objetiva Z
 */
function inverteSinalZ($restricoes)
{
    foreach ($restricoes[0]['colunas'] as $key => $value) {
        $restricoes[0]['colunas'][$key] = (-$value);
    }
    return $restricoes;
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
    printf('ACABOU :)<br>');
    var_dump($GLOBALS['interacoes']);
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
