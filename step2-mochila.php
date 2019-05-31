<?php
error_reporting(0);
  require_once("header.php");


  $qtd_item = $_POST["qtd_item"];
  $peso_maximo = $_POST["peso_maximo"];


?>

  <style type="text/css">
    #imagem-topo{
      height: 199px !important;
    }
    .bmd-form-group {
      padding-top: 0px !important;
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
          <h5 class="centralizado"><b>Passo 2:</b> O próximo passo é definir as <b>descrições</b>, <b>valores</b> e <b>pesos</b> de cada item:</h5>
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
                <td>Descrição</td>
                <td>Valor</td>
                <td>Peso</td>
              </tr>
              <?php
                //Funcao
                for($j = 0; $j < $qtd_item; $j++){
                    echo '<tr>';
                    echo '<td>';
                    echo '<div class="form-group margin-top-input">';
                    echo '<input type="text" style="text-align: right;" name=nomes['.$j.'] class="form-control" required placeholder="Caneta"> ';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>';
                    echo '<div class="form-group margin-top-input">';
                    echo '<input type="number" style="text-align: right;" name=valores['.$j.'] class="form-control"  required placeholder="2" min="1"> ';
                    echo '</div>';
                    echo '</td>';
                    echo '<td>';
                    echo '<div class="form-group margin-top-input">';
                    echo '<input type="number" style="text-align: right;" name=pesos['.$j.'] class="form-control" required placeholder="10" min="1">';
                    echo '</div>';
                    echo '</td>';
                    echo '<tr>';
                }
              ?>  
              <tr>
                <td colspan="3"><input type="submit" class="centralizado btn btn-primary btn-round" id="next-step-1" style="margin-top: 29px;" value="Próximo Passo"></td>
              </tr>
            </table>
          </form>
        </div>
        <!--
        +-------------------+
        |Fim Função Objetiva| 
        +-------------------+
        --
        +-----------------+
        |FIM SEGUNDO PASSO|
        +-----------------+
      -->

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