

<!-- jQuery -->
<script src="vista/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vista/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="vista/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="vista/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="vista/dist/js/demo.js"></script>-->
<!-- daterange picker -->
<link rel="stylesheet" href="vista/plugins/daterangepicker/daterangepicker.css">
<!-- InputMask -->
<script src="vista/plugins/moment/moment.min.js"></script>
<script src="vista/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="vista/plugins/daterangepicker/daterangepicker.js"></script>

<script>

  let hoy = new Date();

</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>Estad&iacute;stica de servicio</h1>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Informe General</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <div class=" col-sm-12 card-navy">
    <div class="row mb-2">
    <div class="col-sm-6">




      <label>Selecciona el periodo:</label>
      <div class="input-group-prepend">

        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
        <input type="text" name="daterange"  class="form-control float-right" value=document.write(hoy) + - + document.write(hoy)/>
      </div>


    </div>


    </div>

  </div>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10">
         <!-- BAR CHART -->
          <div class="card card-navy">
            <div class="card-header">
              <h3 class="card-title">Estad&iacute;stica de env&iacute;os</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div id="chart-container">
                <canvas id="graphCanvas"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Add Content Here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Page specific script -->

  <script>
    $(document).ready(function () {
    //showGraph();
  });


    $(function() {
      $('input[name="daterange"]').daterangepicker({
        opens: 'left'
      }, function(start, end) {
        showGraph(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
      });
    });

    function showGraph(f1,f2)
    {
      {
        $.post("prg/datainforme1.php?f1="+f1+"&f2="+f2,
          function (data)
          {
            console.log(data);
            var name = [];
            var marks = [];

            for (var i in data) {
              name.push(data[i].chk_descripcion);
              marks.push(data[i].cantidad);
            }

            var chartdata = {
              labels: name,

              datasets: [
                {
                  label: 'Punto de control',
                  backgroundColor: '#ee5628',
                  borderColor: '#ee5628',
                  hoverBackgroundColor: '#ce5611',
                  hoverBorderColor: '#ee5628',
                  data: marks
                }
              ]
            };

            var graphTarget = $("#graphCanvas");

            var barGraph = new Chart(graphTarget, {
              type: 'bar',
              options: {
                legend: {
                  display: false,
                }
              },
              data: chartdata


            });
          });
      }
    }
</script>
