<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
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

        $carrito = $request->input("carrito");

        $order->ordDireccion = $request->ordDireccion;
        $order->ordCiudad = $request->ordCiudad;
        $order->ordDepartamento = $request->ordDepartamento;
        $order->ordTotal = $request->ordTotal;

        $order->save();

        foreach ($carrito as $product) {
            $purchase = new Purchase();

            $producto = Product::find($product["id"]);

            $purchase->product_id = $product["id"];
            $purchase->cantidad = $product["cantidad"];
            $purchase->total = $product["total"];

            $order->purchases()->save($purchase);

            $producto->proCantDisponible -= $product["cantidad"];
            $producto->save();
        }

        $json = array(
            "order" => $order,
            "purchases" => $order->purchases()->get()
        );

        return $json;
    }

    public function updated(Request $request)
    {
    }

    public function delete(Request $request)
    {
    }
}
