<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Purchase;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $ordenId = "";
    private $user_id = "";
    private $purchase_id = "";
    private $ordDireccion = "";
    private $ordCiudad = "";
    private $ordDepartamento = "";
    private $ordEstado = "";
    private $ordTotal = "";

    /**
     * METODO DE URL READ DE ORDER: GET
     *
     * Se recibe por key (id=#) el id de la orden y se trae la encontrada o se traen todos
     * los datos en caso de no haber key.
     *
     * @return json Datos con el result
     **/
    public function read()
    {
        if (isset($_GET["id"])) {
            $ordenId = $_GET["id"];
            $order = Order::find($ordenId);
        } else {
            $order = Order::all();
        }

        return response()->json($order);
    }

    public function readVendedor($id){
        
        // $purchases = Purchase::all()->filter(function (Purchase $purchase){
        //     return $purchase->product
        // });
        

        // $json = array(
        //     "order" => $order,
        //     "purchases" => $orders->purchases()->get()
        // );

        // return $orders;
    }

    /**
     * METODO DE URL CREATE DE ORDER: POST
     *
     * Se reciben los datos de entrada y se crea la orden
     * con los datos requeridos
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el result y el id de la orden creada
     **/
    public function create(Request $request)
    {
        $_respuestas = new respuestas;
        $_order = new Order();
        $datos = json_decode($request->getContent());

        if (!isset($datos->user_id) || !isset($datos->purchase_id) || !isset($datos->ordDireccion) || !isset($datos->ordCiudad) || !isset($datos->ordDepartamento) || !isset($datos->ordEstado) || !isset($datos->ordTotal)) {
            return $_respuestas->error_400();
        } else {
            $this->user_id = $datos->user_id;
            $this->purchase_id = $datos->purchase_id;
            $this->ordDireccion = $datos->ordDireccion;
            $this->ordCiudad = $datos->ordCiudad;
            $this->ordDepartamento = $datos->ordDepartamento;
            $this->ordEstado = $datos->ordEstado;
            $this->ordTotal = $datos->ordTotal;
            $_order->user_id = $this->user_id;
            $_order->purchase_id = $this->purchase_id;
            $_order->ordDireccion = $this->ordDireccion;
            $_order->ordCiudad = $this->ordCiudad;
            $_order->ordDepartamento = $this->ordDepartamento;
            $_order->ordEstado = $this->ordEstado;
            $_order->ordTotal = $this->ordTotal;
            $_order->save();

            $respu = $_order;
            if ($respu["id"]) {
                $resp = $respu["id"];
            } else {
                $resp = 0;
            }

            if ($resp != null) {
                $resp = $resp;
            } else {
                $resp = 0;
            }

            if ($resp != null) {
                $respuesta = $_respuestas->response;
                $respuesta["result"] = array(
                    "id" => $resp
                );
                return $respuesta;
            } else {
                return $_respuestas->error_500();
            }
        }
    }

    /**
     * METODO DE URL UPDATE DE ORDER: PATCH
     *
     * Se reciben los datos de entrada y por medio del id se actualiza la orden
     * con los datos requeridos
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el id de la orden actualizada
     **/
    public function update(Request $request)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($request->getContent());

        if (!isset($datos->id)) {
            return $_respuestas->error_400();
        } else {
            $this->ordenId = $datos->id;

            if (isset($datos->user_id)) {
                $this->user_id = $datos->user_id;
            }
            if (isset($datos->purchase_id)) {
                $this->purchase_id = $datos->purchase_id;
            }
            if (isset($datos->ordDireccion)) {
                $this->ordDireccion = $datos->ordDireccion;
            }
            if (isset($datos->ordCiudad)) {
                $this->ordCiudad = $datos->ordCiudad;
            }
            if (isset($datos->ordDepartamento)) {
                $this->ordDepartamento = $datos->ordDepartamento;
            }
            if (isset($datos->ordEstado)) {
                $this->ordEstado = $datos->ordEstado;
            }
            if (isset($datos->ordTotal)) {
                $this->ordTotal = $datos->ordTotal;
            }

            $_order = Order::find($this->ordenId);
            $resultArray = array();

            foreach ($_order as $key) {
                $resultArray[] = $key;
            }
            $datos = $this->convertirUtf8($resultArray);

            if ($datos) {
                $_order->user_id = $this->user_id;
                $_order->purchase_id = $this->purchase_id;
                $_order->ordDireccion = $this->ordDireccion;
                $_order->ordCiudad = $this->ordCiudad;
                $_order->ordDepartamento = $this->ordDepartamento;
                $_order->ordEstado = $this->ordEstado;
                $_order->ordTotal = $this->ordTotal;
                $_order->save();

                $respu = $_order;
                if ($respu) {
                    $resp = $respu;
                } else {
                    $resp = 0;
                }

                if ($resp) {
                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "id" => $this->ordenId
                    );
                    return $respuesta;
                } else {
                    return $_respuestas->error_500();
                }
            } else {
                return $_respuestas->error_200("Orden inactiva!!");
            }
        }
    }

    /**
     * METODO DE URL DELETE DE ORDER: DELETE
     *
     * Se reciben los datos de entrada y por medio del id se elimina la orden
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el result y el id de la orden eliminada
     **/
    public function delete(Request $request)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($request->getContent());

        if (!isset($datos->id)) {
            return $_respuestas->error_400();
        } else {
            $this->ordenId = $datos->id;

            $_order = Order::find($this->ordenId);
            $_order->delete();

            $respuesta = $_respuestas->response;
            $respuesta["result"] = array(
                "id" => $this->ordenId
            );
            return $respuesta;
        }
    }

    /**
     * METODO PARA CONVERTIR A UTF8
     *
     * Por medio de metodos se recibe un arreglo de datos para convertirlos a UTF8
     *
     * @param array $array Datos del resultado
     * @return array Datos con conversion a UTF8
     **/
    public function convertirUtf8($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, "utf-8", true)) {
                $item = iconv("ISO-8859-1", "UTF-8", $item);
            }
        });
        return $array;
    }
}
