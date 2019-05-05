<?php
require_once("header.php");
?>

  <div class="main main-raised">
    <div class="container">
      <div class="section text-center" id="about-product">
        <div class="row">
          <div class="col-md-12 ml-auto mr-auto">

            <h2 class="title">Como Funciona</h2>
            <h5 class="description">This is the paragraph where you can write more details about your product. Keep you user engaged by providing
              meaningful information. Remember that by this time, the user is curious, otherwise he wouldn&apos;t scroll
              to get here. Add a button if you want the user to see more.</h5>
          </div>
        </div>
      </div>
      <!--
        +---------------------------------------+
        | PRIMEIRO PASSO: VARIÁVEIS E RESTRIÇÕES|
        +---------------------------------------+
      -->
      
      <div class="section margin-top" id="step-one" style="display: block;">
        <hr>
        <div class="row text-center">
          <h5 class="centralizado"><b>Passo 1:</b> Nos diga a quantidade de variáveis e quantidade de restriçõe que o seu problema tem:</h5>
        </div>
        <br>
        <div class="row">
          <form class="form-inline centralizado" action="/simplex/step2.php" method="POST">
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
                <input type="number" class="form-control" name="" id="" required>
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