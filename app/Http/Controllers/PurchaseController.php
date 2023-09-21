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
        $respuestas = new respuestas;
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

        
    }

    public function updated(Request $request)
    {
    }

    public function delete(Request $request)
    {
    }
}
