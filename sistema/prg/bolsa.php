<?php
session_start();

    class bolsa{
        public function registro_bolsa(){
            include('vista/inicio.php');
            include('vista/modulo_B/form_reg_bolsa.php');
            include('vista/inicio_pie.php');

        }

        public function reporte_bolsas(){
            include('vista/inicio.php');
            include('vista/modulo_B/bolsas_reporte.php');
            include('vista/inicio_pie2.php');

        }

        public function scan_proceso(){
            include('vista/inicio.php');
            include('vista/modulo_B/proceso.php');
            include('vista/inicio_pie2.php');

        }

        public function cuadre_bolsas(){
            include('vista/inicio.php');
            include('vista/modulo_B/form_cuadre.php');
            include('vista/inicio_pie2.php');

        }

        public function salida_agencia(){
            include('vista/inicio.php');
            include('vista/modulo_B/salida_agencia.php');
            include('vista/inicio_pie2.php');

        }

        public function reporte_historico(){
            include('vista/inicio.php');
            include('vista/modulo_B/reporte_historico.php');
            include('vista/inicio_pie2.php');

        }

        public function dp_bolsa(){
            
            include('vista/inicio.php');
            include('vista/modulo_B/form_bolsa_despacho.php');
            include('vista/inicio_pie.php');
            

        }


        public function cuadre_general(){
            
            include('vista/inicio.php');
            include('vista/modulo_B/form_cuadre.php');
            include('vista/inicio_pie.php');
            

        }

        
        public function cuadre_detalle(){
            
            include('vista/inicio.php');
            include('vista/modulo_B/detalle_entregas.php');
            include('vista/inicio_pie2.php');
            

        }


        public function recepcion(){
            
            include('vista/inicio.php');
            include('vista/modulo_B/recepcion_usuario.php');
            include('vista/inicio_pie2.php');
            

        }

        public function edicion_bol(){
            
            include('vista/inicio.php');
            include('vista/modulo_B/editar_bolsa.php');
            include('vista/inicio_pie2.php');
            

        }

        public function xls_bolsa(){
            
            include('vista/inicio.php');
            include('vista/modulo_B/lector_excel_bolsas.php');
            include('vista/inicio_pie.php');
            

        }

        public function cargar_xls_bolsa(){
            
            include('vista/inicio.php');
            include('vista/modulo_B/cargar_xls_bolsa.php');
            include('vista/inicio_pie.php');
            

        }

        public function bolsas_agencia(){
            
            include('vista/inicio.php');
            include('vista/modulo_B/bolsas_agencias.php');
            include('vista/inicio_pie2.php');
            

        }

        public function cuadre_n(){
            
            include('vista/inicio.php');
            include('vista/modulo_B/cuadre_advance.php');
            include('vista/inicio_pie2.php');
            

        }



        public function procesar_csv(){
            
            include('vista/inicio.php');
            include('vista/modulo_B/cuadre_advance_II.php');
            include('vista/inicio_pie2.php');
            

        }

        public function csv(){
            
            include('vista/inicio.php');
            include('vista/modulo_B/vista_detalle.php');
            include('vista/inicio_pie2.php');
            

        }


        public function test(){
            
            include('vista/modulo_B/test.php');
            

        }

    }
?>