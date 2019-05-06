<?php
include 'header.php';

?>

<div class="main main-raised">
    <div class="container">
    
        <div class="section  margin-top"> 
            <div id="resolucao-final" style="display: block;">
            <div class="row text-center">
                <h3 class="centralizado" id="step">
                    Passo 3
                </h3>
                </div>
                <br>
                <table class="table table-bordered" id="myTable">
                    <thead>
                        
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="solucao">
                    <br>
                    <b>Montando a tabela</b>
                    <p>Primeiro inserimos os valores na tabela, adicionando variaveis de folga, que começam com a letra <b>F</b>, para cada restrição
                    <br>
                    <br>
                </div>
                <div class="row">
                    <div class= "col-md-6" id="back">
                        <a herf="index.php">
                            <button class="btn btn-primary btn-round" onclick="Inicio()" id="retorno">Inicio</button>
                        </a>
                    </div> 
                    <div class= "col-md-6" id="botao">
                        <button class="btn btn-primary btn-round" onclick="Proximo()" id="proximo">Proximo</button>
                        
                    </div>    
                </div>
            </div>
            <div class="section  margin-top" style="display: none;" id="relatorio_passo_passo">
              <hr>
              <div class="row text-center">
                  <h3 class="centralizado">
                    Relatório de Sensibilidade
                  </h3>
                </div>
                <br>
                <div id="relatorio-sensibilidade-2">
                  
                </div>
                <div class="row">
                  <div class="col-md-6">           
                    <button class="btn btn-primary btn-round" id="voltar-resultado" onclick="VoltarPasso()" style="margin-top: 29px;float:right;">Voltar</button>            
                  </div>
                  <div class="col-md-6">
                    <a href="index.php">
                      <button class="btn btn-primary btn-round" style="margin-top: 29px;">Começar de novo!</button>
                    </a>
                  </div>
                </div>
              </div>
       </div>
    </div>
</div>    
<?php
    require_once("footer.php");
?>
<script type="text/javascript">
var iteracoes
var colunas;
var contador = 0;
var total ;
var sensibilidade;

$(document).ready(function() {
    
    iteracoes = JSON.parse(window.localStorage.getItem("tabela"));
    sensibilidade =  JSON.parse(window.localStorage.getItem("sensibilidade"));
    total = iteracoes.length;
    colunas = (Object.keys(iteracoes[0]['base'][0]['colunas'])).reverse();
    
        $('#myTable thead').append('<td class="td-first-col">Base  </td>');
    for(var i=0;i<colunas.length;i++){
        $('#myTable thead').append('<th >'+colunas[i]+'</th>');
        }
    for(var i=0;i<(iteracoes[0]["base"]).length;i++)
    {
        linha = (Object.values(iteracoes[0]['base'][i]['colunas'])).reverse();
        $('#myTable tbody').append('<tr ></tr>');
        $('#myTable tr:last').append('<th class="td-first-col">'+iteracoes[0]['base'][i]['linha']+'</th>')
        for(var j = 0; j<linha.length;j++){
            $('#myTable tr:last').append('<td>'+linha[j]+'</td>');
        }
    }
    
    contador ++;
    console.log(contador);
   
});

function Proximo(){
    if(contador == 1){
        $('#back').empty();
        $('#back').append('<button class="btn btn-primary btn-round" onclick="Anterior()" id="retorno">Anterior</button>');     
    }
    if(contador<total)
    {
        destroy();
        if(construct(contador))
        {
            contador ++;
            console.log(contador);
            if(contador == total){ //ultima iteração
                console.log(contador);
                $('#step').text("Passo Final");
                $('#proximo').remove();
                $('#botao').append('<button class="btn btn-primary btn-round" onclick="MostrarRel()" id="botao-sensibilidade">Ver Relatório de Sensibilidade</button> ');
                
                $('#solucao').append('<h5>A solução ótima é <b>'+iteracoes[contador-1]["base"][0]["linha"]+'='+iteracoes[contador-1]["base"][0]["colunas"]["B"]+'</b></h5> <br>')
                var aux = colunas;
                console.log(aux);
                for(var i=1;i<iteracoes[contador-1]["base"].length;i++){
                    var letra = iteracoes[contador-1]["base"][i]["linha"];
                    var valor = iteracoes[contador-1]["base"][i]["colunas"]["B"];
                    $('#solucao').append('<br> <b>'+letra+'='+valor+'</b>')
                    //console.log(aux.indexOf(letra));
                    aux.splice(aux.indexOf(letra),1);
                }
               // console.log(aux);
               aux.splice(aux.indexOf("B"),1)
                for(var i=0;i<aux.length;i++)
                {
                    $('#solucao').append('<br> <b>'+aux[i]+'= 0 </b>')
                }
                
            }
            else{
               
                $('#step').text("Passo "+(contador+2));
            }

        }
        
    }
    
    
   
}

function Anterior(){
    
    if(contador == 2){
        $('#back').empty();
        $('#back').append('<button class="btn btn-primary btn-round" onclick="Inicio()" id="retorno">Inicio</button>');
        $('#solucao').empty();
        $('#solucao').append("<br><b>Montando a tabela</b><p>Primeiro inserimos os valores na tabela, adicionando variaveis de folga, que começam com a letra <b>F</b>, para cada restrição<br><br>");
    }
    if(contador>1)
    {
        if(contador == total)
        {
        
            $('#botao-sensibilidade').remove();
            $('#botao').append('<button class="btn btn-primary btn-round" onclick="Proximo()" id="proximo">Proximo</button>');
           // $('#solucao').empty();
        }
        contador --;
       // console.log(contador);
        destroy();
        $('#step').text("Passo "+(contador+2));
        construct(contador-1);

    }
}

function construct(pos){ //passando qual iteração
    //console.log(pos);
    colunas = (Object.keys(iteracoes[pos]['base'][0]['colunas'])).reverse(); // pega a head
    
    if(pos>0){
        $('#solucao').empty();
        $('#solucao').append("<p>Entra a variavel<b> "+iteracoes[pos]["entra"]+"</b></p>")
        $('#solucao').append("<p>Sai a variavel<b> "+iteracoes[pos]["sai"]+"</b></p><br>")
    }
    
    $('#myTable thead').append('<td class="td-first-col">Base  </td>'); // ensere base
    for(var i=0;i<colunas.length;i++){
        $('#myTable thead').append('<th >'+colunas[i]+'</th>'); // ensere head
        }
    for(var i=0;i<(iteracoes[pos]["base"]).length;i++)
    {
        linha = (Object.values(iteracoes[pos]['base'][i]['colunas'])).reverse(); //pega a linha
        $('#myTable tbody').append('<tr ></tr>'); //insere nova linha
        $('#myTable tr:last').append('<th class="td-first-col">'+iteracoes[pos]['base'][i]['linha']+'</th>') //insere o inicio da linha
        for(var j = 0; j<linha.length;j++){
            $('#myTable tr:last').append('<td>'+linha[j]+'</td>'); // insere os valores da linha
        }
    }
    if(pos == total){

    }
    return true;
}

function destroy(){
    $("#myTable").find('tr').remove(); //destroi tudo
    $("#myTable").find('td').remove();
    $("#myTable").find('th').remove();
}

function MostrarRel(){
    $('#relatorio_passo_passo').fadeIn("slow");
    $('#resolucao-final').fadeOut("slow");
    $('#relatorio-sensibilidade-2').append(sensibilidade)
}

function VoltarPasso(){
    $('#resolucao-final').fadeIn("slow");
    $('#relatorio_passo_passo').fadeOut("slow");
}

function Inicio(){
    window.location.replace('index.php');
}
</script>
