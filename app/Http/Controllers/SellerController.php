<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    private $vendedorId = "";
    private $selDireccion = "";
    private $selNumContacto = "";
    private $selPermiso = "";
    private $company_id = "";

    /**
     * METODO DE URL READ DE SELLER: GET
     *
     * Se recibe por key (id=#) el id del vendedor y se trae la encontrada o se traen todos
     * los datos en caso de no haber key.
     *
     * @return json Datos con el result
     **/
    public function read()
    {
        if (isset($_GET["id"])) {
            $vendedorId = $_GET["id"];
            $sellers = Seller::find($vendedorId);
        } else {
            $sellers = Seller::all();
        }

        return response()->json($sellers);
    }

    /**
     * METODO DE URL CREATE DE SELLER: POST
     *
     * Se reciben los datos de entrada y se crea el vendedor
     * con los datos requeridos
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el result y el id del vendedor creado
     **/
    public function create(Request $request)
    {
        $_respuestas = new respuestas;
        $_seller = new Seller();
        $datos = json_decode($request->getContent());

        if (!isset($datos->selDireccion) || !isset($datos->selNumContacto) || !isset($datos->selPermiso) || !isset($datos->company_id)) {
            return $_respuestas->error_400();
        } else {
            $this->selDireccion = $datos->selDireccion;
            $this->selNumContacto = $datos->selNumContacto;
            $this->selPermiso = $datos->selPermiso;
            $this->company_id = $datos->company_id;
            $_seller->selDireccion = $this->selDireccion;
            $_seller->selNumContacto = $this->selNumContacto;
            $_seller->selPermiso = $this->selPermiso;
            $_seller->company_id = $this->company_id;
            $_seller->save();

            $respu = $_seller;
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
     * METODO DE URL UPDATE DE SELLER: PATCH
     *
     * Se reciben los datos de entrada y por medio del id se actualiza el vendedor
     * con los datos requeridos
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el id del vendedor actualizado
     **/
    public function update(Request $request)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($request->getContent());

        if (!isset($datos->id)) {
            return $_respuestas->error_400();
        } else {
            $this->vendedorId = $datos->id;

            if (isset($datos->selDireccion)) {
                $this->selDireccion = $datos->selDireccion;
            }
            if (isset($datos->selNumContacto)) {
                $this->selNumContacto = $datos->selNumContacto;
            }
            if (isset($datos->selPermiso)) {
                $this->selPermiso = $datos->selPermiso;
            }
            if (isset($datos->company_id)) {
                $this->company_id = $datos->company_id;
            }

            $_seller = Seller::find($this->vendedorId);
            $resultArray = array();

            foreach ($_seller as $key) {
                $resultArray[] = $key;
            }
            $datos = $this->convertirUtf8($resultArray);

            if ($datos) {
                $_seller->selDireccion = $this->selDireccion;
                $_seller->selNumContacto = $this->selNumContacto;
                $_seller->selPermiso = $this->selPermiso;
                $_seller->company_id = $this->company_id;
                $_seller->save();

                $respu = $_seller;
                if ($respu) {
                    $resp = $respu;
                } else {
                    $resp = 0;
                }

                if ($resp) {
                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "id" => $this->vendedorId
                    );
                    return $respuesta;
                } else {
                    return $_respuestas->error_500();
                }
            } else {
                return $_respuestas->error_200("Vendedor inactivo!!");
            }
        }
    }

    /**
     * METODO DE URL DELETE DE SELLER: DELETE
     *
     * Se reciben los datos de entrada y por medio del id se elimina el vendedor
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el result y el id del vendedor eliminado
     **/
    public function delete(Request $request)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($request->getContent());

        if (!isset($datos->id)) {
            return $_respuestas->error_400();
        } else {
            $this->vendedorId = $datos->id;

            $_seller = Seller::find($this->vendedorId);
            $_seller->delete();

            $respuesta = $_respuestas->response;
            $respuesta["result"] = array(
                "id" => $this->vendedorId
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
