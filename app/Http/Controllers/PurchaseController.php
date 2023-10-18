<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // private $compraId = "";
    // private $user_id = "";
    // private $product_id = "";
    // private $comprobantePago = "";
    // private $estado = "";
    // private $total = "";
    // private $cantidad = "";

    // /**
    //  * METODO DE URL READ DE PURCHASE: GET
    //  *
    //  * Se recibe por key (id=#) el id de la compra y se trae la encontrada o se traen todos
    //  * los datos en caso de no haber key.
    //  *
    //  * @return json Datos con el result
    //  **/
    // public function read()
    // {
    //     if (isset($_GET["id"])) {
    //         $compraId = $_GET["id"];
    //         $purchases = Purchase::find($compraId);
    //     } else {
    //         $purchases = Purchase::all();
    //     }

    //     return response()->json($purchases);
    // }

    // /**
    //  * METODO DE URL CREATE DE PURCHASE: POST
    //  *
    //  * Se reciben los datos de entrada y se crea la compra
    //  * con los datos requeridos
    //  *
    //  * @param Request $request Datos de entrada
    //  * @return json Datos con el result y el id de la compra creada
    //  **/
    // public function create(Request $request)
    // {
    //     $_respuestas = new respuestas;
    //     $_purchase = new Purchase();
    //     $datos = json_decode($request->getContent());

    //     if (!isset($datos->user_id) || !isset($datos->product_id) || !isset($datos->comprobantePago) || !isset($datos->estado) || !isset($datos->total) || !isset($datos->cantidad)) {
    //         return $_respuestas->error_400();
    //     } else {
    //         $this->user_id = $datos->user_id;
    //         $this->product_id = $datos->product_id;
    //         $this->comprobantePago = $datos->comprobantePago;
    //         $this->estado = $datos->estado;
    //         $this->total = $datos->total;
    //         $this->cantidad = $datos->cantidad;
    //         $_purchase->user_id = $this->user_id;
    //         $_purchase->product_id = $this->product_id;
    //         $_purchase->comprobantePago = $this->comprobantePago;
    //         $_purchase->estado = $this->estado;
    //         $_purchase->total = $this->total;
    //         $_purchase->cantidad = $this->cantidad;
    //         $_purchase->save();

    //         $respu = $_purchase;
    //         if ($respu["id"]) {
    //             $resp = $respu["id"];
    //         } else {
    //             $resp = 0;
    //         }

    //         if ($resp != null) {
    //             $resp = $resp;
    //         } else {
    //             $resp = 0;
    //         }

    //         if ($resp != null) {
    //             $respuesta = $_respuestas->response;
    //             $respuesta["result"] = array(
    //                 "id" => $resp
    //             );
    //             return $respuesta;
    //         } else {
    //             return $_respuestas->error_500();
    //         }
    //     }
    // }

    // /**
    //  * METODO DE URL UPDATE DE PURCHASE: PATCH
    //  *
    //  * Se reciben los datos de entrada y por medio del id se actualiza la compra
    //  * con los datos requeridos
    //  *
    //  * @param Request $request Datos de entrada
    //  * @return json Datos con el id de la compra actualizada
    //  **/
    // public function update(Request $request)
    // {
    //     $_respuestas = new respuestas;
    //     $datos = json_decode($request->getContent());

    //     if (!isset($datos->id)) {
    //         return $_respuestas->error_400();
    //     } else {
    //         $this->compraId = $datos->id;

    //         if (isset($datos->user_id)) {
    //             $this->user_id = $datos->user_id;
    //         }
    //         if (isset($datos->product_id)) {
    //             $this->product_id = $datos->product_id;
    //         }
    //         if (isset($datos->comprobantePago)) {
    //             $this->comprobantePago = $datos->comprobantePago;
    //         }
    //         if (isset($datos->estado)) {
    //             $this->estado = $datos->estado;
    //         }
    //         if (isset($datos->total)) {
    //             $this->total = $datos->total;
    //         }
    //         if (isset($datos->cantidad)) {
    //             $this->cantidad = $datos->cantidad;
    //         }

    //         $_purchase = Purchase::find($this->compraId);
    //         $resultArray = array();

    //         foreach ($_purchase as $key) {
    //             $resultArray[] = $key;
    //         }
    //         $datos = $this->convertirUtf8($resultArray);

    //         if ($datos) {
    //             $_purchase->user_id = $this->user_id;
    //             $_purchase->product_id = $this->product_id;
    //             $_purchase->comprobantePago = $this->comprobantePago;
    //             $_purchase->estado = $this->estado;
    //             $_purchase->total = $this->total;
    //             $_purchase->cantidad = $this->cantidad;
    //             $_purchase->save();

    //             $respu = $_purchase;
    //             if ($respu) {
    //                 $resp = $respu;
    //             } else {
    //                 $resp = 0;
    //             }

    //             if ($resp) {
    //                 $respuesta = $_respuestas->response;
    //                 $respuesta["result"] = array(
    //                     "id" => $this->compraId
    //                 );
    //                 return $respuesta;
    //             } else {
    //                 return $_respuestas->error_500();
    //             }
    //         } else {
    //             return $_respuestas->error_200("Compra inactiva!!");
    //         }
    //     }
    // }

    // /**
    //  * METODO DE URL DELETE DE PURCHASE: DELETE
    //  *
    //  * Se reciben los datos de entrada y por medio del id se elimina la compra
    //  *
    //  * @param Request $request Datos de entrada
    //  * @return json Datos con el result y el id de la compra eliminada
    //  **/
    // public function delete(Request $request)
    // {
    //     $_respuestas = new respuestas;
    //     $datos = json_decode($request->getContent());

    //     if (!isset($datos->id)) {
    //         return $_respuestas->error_400();
    //     } else {
    //         $this->compraId = $datos->id;

    //         $_purchase = Purchase::find($this->compraId);
    //         $_purchase->delete();

    //         $respuesta = $_respuestas->response;
    //         $respuesta["result"] = array(
    //             "id" => $this->compraId
    //         );
    //         return $respuesta;
    //     }
    // }

    // /**
    //  * METODO PARA CONVERTIR A UTF8
    //  *
    //  * Por medio de metodos se recibe un arreglo de datos para convertirlos a UTF8
    //  *
    //  * @param array $array Datos del resultado
    //  * @return array Datos con conversion a UTF8
    //  **/
    // public function convertirUtf8($array)
    // {
    //     array_walk_recursive($array, function (&$item, $key) {
    //         if (!mb_detect_encoding($item, "utf-8", true)) {
    //             $item = iconv("ISO-8859-1", "UTF-8", $item);
    //         }
    //     });
    //     return $array;
    // }

    /**
     * METODO DE URL PURCHASE PARA OBTENER COMPRAS SEGUN EL COMPRADOR: GET
     *
     * Se recibe por key (id=#) el id del comprador y se trae la encontrada o se envia mensaje
     * de error.
     *
     * @return json Datos con el result
     **/
    public function getPurchasesUser()
    {
        $_respuestas = new respuestas;

        if (isset($_GET["id"])) {
            $compradorId = $_GET["id"];
            $purchases = Purchase::with('product') // Cargar la relación 'product'
                ->where('user_id', $compradorId)
                ->get();

            return response()->json($purchases);
        } else {
            return $_respuestas->error_200("Debe añadir a la URL una key donde esté el ID del vendedor!!");
        }
    }


    public function create(Request $request)
    {
        $respuestas = new respuestas();
        $request->validate([
            'id' => 'required',
            'ordDireccion' => 'required',
            'ordCiudad' => 'required',
            'ordDepartamento' => 'required',
            'ordTotal' => 'required',
            'carrito' => 'required',
            'comprobantePago' => 'required',
        ]);

        $order = new Order();

        $carrito = $request->input("carrito");

        $order->user_id = $request->id;
        $order->ordDireccion = $request->ordDireccion;
        $order->ordCiudad = $request->ordCiudad;
        $order->ordDepartamento = $request->ordDepartamento;
        $order->ordEstado = 'Por entregar';
        $order->ordTotal = $request->ordTotal;

        $order->save();

        foreach ($carrito as $product) {
            $purchase = new Purchase();

            $producto = Product::find($product["id"]);

            $purchase->product_id = $product["id"];
            $purchase->cantidad = $product["cantidad"];
            $purchase->total = $product["total"];
            $purchase->estado = "Por confirmar";
            $purchase->comprobantePago = $request->comprobantePago;
            $purchase->user_id = $request->id;

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
}
