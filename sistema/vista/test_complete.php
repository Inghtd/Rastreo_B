<script type="text/javascript" src="../lib/jquery.js"></script>
<script type="text/javascript" src="../lib/jquery.ui.js"></script>
<link rel="stylesheet" href="../lib/jquery.ui.css">

<script>


  function agencia(valor)
  {
    $.post('../agencia.php',{search:$("#cod_agencia").val()}, function(data,status) {
      if(status=='success'){
        var  obj = jQuery.parseJSON(data);
            $("#agencia").val(obj.agencia);
      }else{

      }
    });
  }


</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ingreso de Env&iacute;os</h1>
          <table>
            <tr>
             <td>Single selection</td>
             <td><input type='text' id='cod_agencia' onchange="agencia(this.value)"></td>
            </tr>

            <tr>
              <td>Selected User id</td>
              <td><input type='text' id='agencia' value=""/></td>
            </tr>

          </table>

        </div>
        </div>
      </div>
    </div>
  </section>
</div>
</div>


<!--<table>-->
<!--  <tr>-->
<!--    <td>Single selection</td>-->
<!--    <td><input type='text' id='destinatario' ></td>-->
<!--  </tr>-->
<!---->
<!--  <tr>-->
<!--    <td>Selected User id</td>-->
<!--    <td><input type='text' id='cod_destinatario' /></td>-->
<!--  </tr>-->
<!---->
<!--</table>-->
