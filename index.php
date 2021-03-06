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
          <form class="inicio-form-inline centralizado" action="./step2.php" method="POST">
            
            <div class="col-md-3">
              <div class="form-group">
                <label for="variable" class="bmd-label-floating">Número de Variáveis</label>
                <input type="number" class="form-control" name="variaveis" id="variaveis" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="restriction" class="bmd-label-floating" style="width: 140px;">Número de Restrições</label>
                <input type="number" class="form-control" name="restricoes" id="restricoes" required="">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="restriction" class="bmd-label-floating">Máximo de Iterações</label>
                <input type="number" min="1" max="10000" class="form-control" style="width: 153px" name="maximo-de-iteracoes" id="maximo-de-iteracoes" required>
              </div>
            </div>

            <div class="col-md-3" style="margin-top: 15px;">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="type-function" id="max" value="max" required>Maximizar
                  <span class="circle">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
              <div class="form-check" style="margin-left: -2px;">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="type-function" id="min" value="min" required>Minimizar
                  <span class="circle">
                    <span class="check"></span>
                  </span>
                </label>
              </div>
            </div>

            <input type="submit" class="centralizado btn btn-primary btn-round" id="next-step-1" style="margin-top: 29px;" value="Próximo Passo">
         
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