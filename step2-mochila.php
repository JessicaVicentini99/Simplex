<?php
  require_once("header.php");


  $qtd_item = $_POST["qtd_item"];
  $peso_maximo = $_POST["peso_maximo"];

?>

  <style type="text/css">
    #imagem-topo{
      height: 199px !important;
    }
  </style>

  <!--
         +-----------------------------------+
         | Modal erro: Limite de iteracoes   |
         +-----------------------------------+
       -->

  <div class="modal fade" id="modalError">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal-dynamic-content">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>

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
            Peso por Item (Kg)
          </h4>
        </div>
        <br>
        <div class="row text-center">
          <form class="form-inline centralizado" action="function_part3.php" method="POST">
            <input type="hidden" name="peso_maximo" value="<?php print $peso_maximo;?>">
            <table>
              <tr>
                <td>Valores</td>
                <td>Pesos</td>
              </tr>
              <?php
                //Funcao
                for($j = 0; $j <= $qtd_item; $j++){
                    echo '<tr>';
                    echo '<td>';
                    echo '<div class="form-group margin-top-input">';
                    echo '<input type="number" style="text-align: right;" name=valores['.$j.'] class="form-control"> ';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>';
                    echo '<div class="form-group margin-top-input">';
                    echo '<input type="number" style="text-align: right;" name=pesos['.$j.'] class="form-control"> ';
                    echo '</div>';
                    echo '</td>';
                    echo '<tr>';
                }
              ?>  
              <tr>
                <td colspan="2"><input type="submit" class="centralizado btn btn-primary btn-round" id="next-step-1" style="margin-top: 29px;" value="Próximo Passo"></td>
              </tr>
            </table>
          </form>
        </div>
        <!--
        +-------------------+
        |Fim Função Objetiva| 
        +-------------------+
        -->
        
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