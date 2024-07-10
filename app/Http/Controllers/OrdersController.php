<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\FoodSample;
use App\Models\WaterSample;
use App\Models\Order;

class OrdersController extends Controller
{
    //
    public function index (Request $request)
    {
        $page = $request->has('page') ? $request->query('page'):0;
        $pages = $request->has('pages') ? $request->query('pages'):40;
        $orders = Order::leftJoin('siralab', 'ordenes.id', '=', 'siralab.id_orden')
            ->join('clientes', 'ordenes.id_cliente', '=', 'clientes.id')
            ->select('ordenes.*', 'siralab.hoja_campo', 'siralab.cadena_custodia', 'siralab.croquis', 'clientes.cliente')
            ->orderBy('fecha_recepcion', 'desc')
            ->orderBy('hora_recepcion', 'desc')
            ->orderBy('folio', 'desc')
            ->offset($page)
            ->limit($pages)
            ->get();
        foreach ($orders as $order) {
            if ($order->aguas_alimentos === 'Aguas') {
                $order->muestras = WaterSample::rightJoin('identificacion_muestras', 'identificacion_muestras.id', '=', 'muestras_aguas.id_identificacion_muestra')
                    ->select('muestras_aguas.*', 'identificacion_muestras.identificacion_muestra', 'identificacion_muestras.latitud', 'identificacion_muestras.longitud', 'identificacion_muestras.siralab')
                    ->where('id_orden', $order->id)
                    ->get();
            } else {
                $order->muestras = FoodSample::where('id_orden', $order->id)
                    ->get();
            }
        }
        return Inertia::render('orders/Index', ['ordersProp' => $orders]);
    }
}
