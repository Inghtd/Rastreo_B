<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;

class Reportes extends Controller
{
    public function rep_detalle(Request $request)
    {
        /* $tipo=$request->input('tipo');
         $fecha1=$request->input('f1');
         $fecha2=$request->input('f2');*/

        $sql="select * from moviemintos ";

        $data=DB::select($sql);

        return $data;

    }

    public function rep_ingresos(Request $request)
    {
        $sql = "select
                    gi.barra as barra,
                    us.usr_nombre as remitente,
                    gi.destinatario as destinatario,
                    cct.ccosto_nombre as centro_costo,
                    gi.des_direccion as direccion,
                    ct.des_cat as categoria,
                    mv.descripcion as estado,
                    mj.nombre as mensajero
                from guia gi
                inner join usuario us on us.id_usr=gi.id_usr
                inner join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                inner join categoria ct on ct.id_cat=gi.entero1
                inner join movimiento mv on mv.id_envio=gi.id_envio
                left join manifiesto_linea ml on ml.id_envio=gi.id_envio
                left join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                left join mensajero mj on mj.id_mensajero=mnf.id_mensajero
where mv.id_movimiento=(select max(id_movimiento) from movimiento where id_envio=gi.id_envio)
                order by gi.barra desc";
//and gi.barra=100027
        $data = DB::select($sql);
        //return $data;
        return View('reporte_detalle',['data'=>$data]);
    }
}
