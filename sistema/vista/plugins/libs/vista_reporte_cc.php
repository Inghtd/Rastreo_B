<?php
// include ("model/model_tab.php");
include '../../class/db.php';

$db = DB::getInstance();

session_start();
$nivel      = $_SESSION["nivel"];
$shi_codigo = $_SESSION["shi_codigo"];
$id_usr     = $_SESSION['cod_user'];
$id_ccosto = $_SESSION['ccosto'];

$sql = "select cb.barra, cb.codigo_unico, cb.descripcion,c.cli_direccion,c.cli_id,cb.fecha,
ag.agencia_nombre, ag.agencia_codigo
from control_bolsa cb
inner join cliente c on c.cli_id = cb.cliente
inner join bolsa bls on bls.codigo_unico=cb.codigo_unico
inner join agencia ag on ag.id_agencia=bls.destino
where cliente='" . $shi_codigo . "' and numero_orden='';";

$stmt = $db->consultar($sql);


$sql = "SELECT 
						id_envio,ori_ccosto,
						fn_AgeXCc(ori_ccosto) AS age_ori,
						fn_ccostoNombre(ori_ccosto) AS ori_ccosto_nombre,
						des_ccosto, 
						fn_AgeXCc(des_ccosto) AS age_des,
						fn_ccostoNombre(des_ccosto) AS des_ccosto_nombre,
						fn_usrNombre(id_usr) AS usr_ori,
						fecha_datetime,barra,comentario,destinatario
				FROM rastreobam.guia 
				WHERE ori_ccosto='$id_ccosto' 
				
				AND estado=1 
				AND id_orden=1
				ORDER BY id_envio";

$stmt2 = $db->consultar($sql);
$c1 = 0;
$c2 = 0;

date_default_timezone_set('America/Guatemala');
$dias_semana = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
$meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

$fecha_texto = $dias_semana[date('N') - 1] . ', ' . date('j') . ' ' . $meses[date('n') - 1] . ' de ' . date('Y');

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <script src="../lib/plotly-2.9.0.min.js"></script>
  <script src="../lib/html2pdf.bundle.min.js"></script>
  <script src="../lib/html2PDF.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
  <button class="btn btn-primary" id="btnCrearPdf">Crear PDF</button>
  <div id="logo">
    <table class="table" id="table-logos">
      <tbody>
        <tr>
          <td class="col-xs-4"><img src="../vista/imgs/bam.png" alt="BAM" width="100"></td>
          <td class="col-xs-4 text-center">
            <div id="contenedor-logo"><img src="../vista/imgs/logo-envia.png" alt="ENVÍA GUATEMALA" width="100"></div>
          </td>
          <td class="col-xs-4 text-right">
            <p><?php echo $fecha_texto; ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
<div class="container">
  <div class="row">
      <div class="col-6" id="bolsas">
        <h2 class="text-center" style="display: block;">Reporte de Centro de Costos</h2>
        <table class="table table-striped table-bordered" id="table-bolsas">
          <thead>
            <tr>
              <th class="text-center" scope="col">Código</th>
              <th class="text-center" scope="col">Departamento</th>
              <th class="text-center" scope="col">Cantidad</th>
              <th class="text-center" scope="col">% en peso</th>
            </tr>
          </thead>
          <tbody>
            <!-- Aplicadas en las filas -->
            <?php
            if ($stm) {
              while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                $c1++;
                echo '<tr>';
                echo '<td>' . $row[0] . '</td>';
                echo '<td>' . $row[2] . '</td>';
                echo '<td>' . $row[4] . ' - ' . $row[3] . '</td>';
                echo '<td>' . $row[7] . ' - ' . $row[6] . '</td>';
                echo '</tr>';
                echo '<td class="text-center" colspan="2"><b>Total general</b></td>';
                echo '<td class="text-center"><b>' . '366' . '</b></td>';
                echo '<td class="text-center">' . '100%' . '</td>';
              }
            } else {
              echo '<tr><td class="text-center h6" colspan="4">No hay registros</td></tr>';
            }
    
            ?>
    
          </tbody>
        </table>
      </div>
      <div class="col-6">
        <div class="col-12" id="grafica"></div>
      </div>
  </div>
</div>
  <hr>
  <div class="row bg-info" id="informe">
    <div class="col-xs-4">
      <p><b>Total de Bolsas:</b> <?php echo $c1; ?></p>
    </div>
    <div class="col-xs-4 text-center">
      <p><b>Total de Ordenes de Servicio:</b> <?php echo $c2; ?></p>
    </div>
    <div class="col-xs-4">
      <p class="text-right"><?php echo 'Hora: ' . date('H:i:s'); ?></p>
    </div>
  </div>
  <div class="row" id="firmas">
    <div class="col-xs-6 text center">
      <p class="text-center">f. ______________________________________</p>
      <p class="text-center">Envía</p>
    </div>
    <div class="col-xs-6 text-center">
      <p class="text-center">f. ______________________________________</p>
      <p class="text-center">Recibe</p>
    </div>
  </div>
  <script>
    var trace1 = {
      type: 'bar',
      x: ['Texto 1', 'Text 2', 'Texto 3', 'Texto 4', 'Text 5', 'Texto 6', 'Texto 7', 'Text 8', 'Texto 9', 'Texto 10'],
      y: [5, 50, 2, 8, 50, 2, 8, 50, 2, 8],
      marker: {
        color: '#0069FF',
        line: {
          width: 0.5
        }
      }
    };

    var data = [trace1];

    var layout = {
      title: 'Reporte Centros de Costos',
      font: {
        size: 18
      }
    };

    var config = {
      responsive: true
    }

    Plotly.newPlot('grafica', data, layout, config);
  </script>

</body>

</html>