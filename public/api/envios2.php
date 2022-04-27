<?php

ini_set ("display_errors","0" );
error_reporting(E_ALL);


$lorem="
Lorem ipsum dolor sit amet, consectetur adipisci tempor incidunt ut labore et dolore magna aliqua veniam, quis nostrud exercitation ullamcorpor s commodo consequat. Duis autem vel eum irrure esse molestiae consequat, vel illum dolore eu fugi et iusto odio dignissim qui blandit praesent luptat exceptur sint occaecat cupiditat non provident, deserunt mollit anim id est laborum et dolor fuga distinct. Nam liber tempor cum soluta nobis elige quod maxim placeat facer possim omnis volupt
Lorem ipsum dolor si amet, consectetur adipiscing incidunt ut labore et dolore magna aliquam erat nostrud exercitation ullamcorper suscipit laboris nis duis autem vel eum irure dolor in reprehenderit i, dolore eu fugiat nulla pariatur. At vero eos et accusa praesant luptatum delenit aigue duos dolor et mole provident, simil tempor sunt in culpa qui officia de fuga. Et harumd dereud facilis est er expedit disti eligend optio congue nihil impedit doming id quod assumenda est, omnis dolor repellend. Temporibud
Lorem ipsum dolor si amet, consectetur adipiscing incidunt ut labore et dolore magna aliquam erat nostrud exercitation ullamcorper suscipit laboris nis duis autem vel eum irure dolor in reprehenderit i dolore eu fugiat nulla pariatur. At vero eos et accus praesant luptatum delenit aigue duos dolor et mol provident, simil tempor sunt in culpa qui officia de fuga. Et harumd dereud facilis est er expedit disti eligend oprio congue nihil impedit doming id quod assumenda est, omnis dolor repellend. Temporibud
";

$word=explode(" ",$lorem);


$x=0;
$cnt=200;
            while($x<$cnt)
            {
                $x++;
            $barra=rand(1,1000);
            $destinatario="N".$word[rand(1,200)];
            $cc_destinatario="A".$word[rand(1,200)];
            $fecha_cracion=date('d-m-Y H:i:s');
            $comentario="C".$word[rand(1,400)];


            $remitente="R".$word[rand(1,200)];
            $nombre_remitente="RN".$word[rand(1,200)];
            $dep_remitente="RD".$word[rand(1,200)];
            $destino_direccion="D".$word[rand(1,200)];
            $categoria = "RESTRINGIDO";
            $estado ="SALIDA A RUTA";


                $b[]=[
                    'barra'                 =>(int)$barra,
                    'idenvio'               =>(string)$barra,
                    'destinatario'          =>$destinatario,
                    'cc_destinatario'       =>$cc_destinatario,
                    'fecha_time'            =>"$fecha_cracion",
                    'comentario'            =>$comentario,
                    'remitente'             =>$remitente, //remitente
                    'nombre_remitente'      =>$nombre_remitente,//nombre remitente
                    'dep_remitente'         =>$dep_remitente,//departamento_remitente
                    'direccion'             =>$destino_direccion,
                    'fecha'                 =>"$fecha_cracion",
                    'categoria'             =>$categoria,
                    'estado'                =>$estado,
                ];
            }


            $data= array(
                "cantidad"=>"$cnt",
                "datos" => $b
            );
            header('Content-Type: application/json');
        
            echo json_encode($data);

?>
