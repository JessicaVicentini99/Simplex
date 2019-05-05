<?php
  require_once("header.php");
?>
<div class="main main-raised" id="campos-restricoes">
    <div class="container">
    <!--
      +--------------------------------+
      |TERCEIRO PASSO: RESOLUÇÃO DIRETA|
      +--------------------------------+
    -->
      <div class="section  margin-top" style="display: block;" id="step-three">
        <hr>
        <div class="row text-center">
          <h3 class="centralizado">
            Solução Final
          </h3>
        </div>
        <br>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Base</th>
              <th>X1</th>
              <th>X2</th>
              <th>X3</th>
              <th>X4</th>
              <th>F1</th>
              <th>F2</th>
              <th>F3</th>
              <th>F4</th>
              <th>B</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="td-first-col">F1</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td class="td-first-col">F2</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td class="td-first-col">F3</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td class="td-first-col">F4</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td class="td-first-col">Z</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
        <br>
        <h5>A solução ótima é <b>Z = xxxx</b></h5>
        <h6>X1 = xxxx</h6>
        <h6>X2 = xxxx</h6>
        <h6>X3 = xxxx</h6>
        <h6>X4 = xxxx</h6>

        <div class="row">
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
  </div>
</div>

<?php
  require_once("footer.php");
?>