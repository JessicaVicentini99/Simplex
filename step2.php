<?php
  require_once("header.php");

  $variaveis = $_POST["variaveis"];
  $restricoes = $_POST["restricoes"];

?>

  <style type="text/css">
    #imagem-topo{
      height: 199px !important;
    }
  </style>

  <div class="main main-raised" id="campos-restricoes">
    <div class="container">

      <!--
        +-----------------------------------+
        | SEGUNDO PASSO: MONTAGEM DOS CAMPOS|
        +-----------------------------------+
      -->
      <div class="section  margin-top" style="display: block;" id="step-two">
        <div class="row text-center">
          <h5 class="centralizado"><b>Passo 2:</b> O próximo passo é definir a Função Objetivo e as funções de restrições do seu problema:</h5>
        </div>
        <br>
        <!--
        +---------------+
        |Função Objetiva|
        +---------------+
        -->
        <div class="row text-center">
          <h4 class="centralizado">
            Função Objetiva 
            <i class="fa fa-info-circle" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." style="color: #03A9F4;"></i>
          </h4>
        </div>
        <br>
        <div class="row text-center">
          <form class="form-inline centralizado">

            <input type="hidden" name="type-function" value="<?php print $_POST['type-function'];?>">
            <input type="hidden" name="maximo-de-iteracoes" value="<?php print $_POST['maximo-de-iteracoes'];?>">
            <input type="hidden" name="passo-a-passo" id="passo-a-passo" value="">

            <p class="name-variable"> Z =</p>

            <?php

              //Funcao
              for($j = 1; $j <= $variaveis; $j++){

                if($j == $variaveis){
                  echo '<input type="hidden" name=restricoes[0][linha] value="Z">';
                  echo '<div class="form-group margin-top-input">';
                  echo '<input type="number" style="text-align: right;" name=restricoes[0][colunas][X' . $j . '] class="form-control">';
                  echo '</div>';
                  echo '<p class="name-variable"> X'.$j.'</p>';
                }else {
                  echo '<div class="form-group margin-top-input">';
                  echo '<input type="number" style="text-align: right;" name=restricoes[0][colunas][X' . $j . '] class="form-control"> ';
                  echo '</div>';
                  echo '<p class="name-variable"> X'.$j.' +</p>';
                }
              }
            ?>

          </form>
        </div>
        <!--
        +-------------------+
        |Fim Função Objetiva| 
        +-------------------+
        -->
        <br><br>
        <!--
        +----------+
        |Restrições|
        +----------+
        -->
        <div class="row text-center">
          <h4 class="centralizado">
            Restrições
            <i class="fa fa-info-circle" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." style="color: #03A9F4;"></i>
          </h4>
        </div>
        <br>
            <?php
              for($i = 1; $i <= $restricoes; $i++){
                echo '<div class="row text-center">';
                echo '<form class="form-inline centralizado">';

                for($j = 1; $j <= $variaveis; $j++){

                  if($j == $variaveis){
                    echo '<div class="form-group margin-top-input">';
                    echo '<input style="text-align: right;" type="number" class="form-control" name=restricoes['.$i.'][colunas][X' . $j . ']>';
                    echo '</div>';
                    echo '<p class="name-variable"> X'. $j .' </p>';
                    echo '&nbsp;&nbsp;&nbsp;<i class="less-then fas fa-less-than-equal"></i>&nbsp;&nbsp;&nbsp;';
                    echo '<div class="form-group margin-top-input">';
                    echo '<input style="text-align: right;" type="number" class="form-control" name=restricoes['.$i.'][colunas][B]>';
                    echo '</div>';
                    echo '<input style="text-align: right;" type="hidden" name=restricoes['.$i.'][linha] value="F'. $i .'">';
                    echo '<input type="hidden" name=restricoes['.$i.'][colunas][F' . $i . '] value="1">';
                  }else {
                    echo '<div class="form-group margin-top-input">';
                    echo '<input style="text-align: right;" type="number" class="form-control" name=restricoes['.$i.'][colunas][X' . $j . ']>';
                    echo '</div>';
                    echo '<p class="name-variable"> X'. $j .' + </p>';
                  }
                }
                echo '</div>';
                echo '</form>';
              }
            ?>

        <div class="row">
          <div class="col-md-6">           
            <button class="btn btn-primary btn-round" id="next-step-2" style="margin-top: 29px;float:right;">Solução Passo-a-Passo</button>            
          </div>
          <div class="col-md-6">
            <button class="btn btn-primary btn-round" id="next-step-3" style="margin-top: 29px;">Solução Direta</button>
          </div>
        </div>
        
      <!--
        +--------------+
        |Fim Restrições|
        +--------------+
        -->
      <!--
        +-----------------+
        |FIM SEGUNDO PASSO|
        +-----------------+
      -->

      </div>

      <!--
      +--------------------------------+
      |TERCEIRO PASSO: RESOLUÇÃO DIRETA|
      +--------------------------------+
      -->
      <div class="section  margin-top" style="display: none;" id="step-three">
        <div class="row text-center">
          <h3 class="centralizado">
            Solução Final
          </h3>
        </div>
        <br>
        <div id="resolucao-final">
          
        </div>
        <br>
        <h5>A solução ótima é <b id="var-z"></b></h5>
        <div id="others-var">
          
        </div>

        <div class="row">
          <div class="col-md-6">
            <button class="btn btn-primary btn-round" id="voltar-func">Voltar</button>            
          </div>
          <div class="col-md-6">
            <button class="btn btn-primary btn-round" id="sensitivity">Ver Relatório de Sensibilidade</button>            
          </div>
        </div>
      </div>
        
      <!--
        +------------------+
        |FIM TERCEIRO PASSO|
        +------------------+
      -->

      <div class="section  margin-top" style="display: none;" id="relatorio">
        <hr>
        <div class="row text-center">
            <h3 class="centralizado">
              Relatório de Sensibilidade
            </h3>
          </div>
          <br>
          <div id="relatorio-sensibilidade">
            
          </div>
          <div class="row">
            <div class="col-md-6">           
              <button class="btn btn-primary btn-round" id="voltar-resultado" style="margin-top: 29px;float:right;">Voltar</button>            
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
<script type="text/javascript">
  $( document ).ready(function() {
    document.getElementById('step-two').scrollIntoView();
    $("html, body").animate({ scrollTop: $('#step-two').offset().top }, 1000);
  }
</script>
<?php
  require_once("footer.php");
?>