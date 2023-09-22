<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    public function read()
    {
        return Order::all();
    }

    public function create(Request $request)
    {
        $respuestas = new respuestas();
        $request->validate([
            'ordDireccion' => 'required',
            'ordCiudad' => 'required',
            'ordDepartamento' => 'required',
            'ordTotal' => 'required',
            'carrito' => 'required',
        ], [
            'ordDireccion.required' => $respuestas->error_400(),
            'ordCiudad.required' => $respuestas->error_400(),
            'ordDepartamento.required' => $respuestas->error_400(),
            'ordTotal.required' => $respuestas->error_400(),
            'carrito.required' => $respuestas->error_400(),
        ]);

        $order = new Order();

        $order->ordDireccion = $request->input('ordDireccion');
        $order->ordCiudad = $request->input('ordCiudad');
        $order->ordDepartamento = $request->input('ordDireccion');
        $order->ordTotal = $request->input('ordTotal');

        $order->save();

        $carrito = $request->input('carrito');

        $compras = [];

        foreach ($carrito as $compra) {
            $purchase = new Purchase();

            $purchase->product_id = $compra->id;
            $purchase->total = $compra->id;
            $purchase->cantidad = $compra->id;

            $compras[] = $purchase;
        }

        $order->purchases()->saveMany($compras);
    }

    public function updated(Request $request)
    {
    }

    public function delete(Request $request)
    {
    }
}
