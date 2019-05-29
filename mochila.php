<?php
require_once("header.php");
?>

<style type="text/css">
  #imagem-topo{
    height: 400px !important;
  }
</style>

  <div class="main main-raised">
    <div class="container">

      <!--
        +---------------------------------------+
        | PRIMEIRO PASSO: VARIÁVEIS E RESTRIÇÕES|
        +---------------------------------------+
      -->
      
      <div class="section margin-top" id="step-one" style="display: block;">
        <div class="row text-center">
          <h5 class="centralizado"><b>Passo 1:</b> Nos diga a quantidade de variáveis e quantidade de restriçõe que o seu problema tem:</h5>
        </div>
        <br>
        <div class="row">
          <form class="inicio-form-inline centralizado" action="./step2-mochila.php" method="POST">
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="variable" class="bmd-label-floating">Quantidade de Itens</label>
                <input type="number" class="form-control" name="qtd_item" id="qtd_item" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="restriction" class="bmd-label-floating">Peso Máximo da Mochilha</label>
                <input type="number" class="form-control" name="peso_maximo" id="peso_maximo" required="">
              </div>
            </div>
            <input type="submit" class="centralizado btn btn-primary btn-round" id="next-step-1-mochila" style="margin-top: 29px;" value="Próximo Passo">
          </form>
        </div>
      </div>
      <!--
        +-------------------+
        | FIM PRIMEIRO PASSO|
        +-------------------+
      -->
  
      
      </div>
    </div>
  </div>
</div>
<?php
  require_once("footer.php");
?>