<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $usuarioId = "";
    private $useNombres = "";
    private $useApellidos = "";
    private $useCorreo = "";
    private $usePassword = "";
    private $useRol = "";
    private $seller_id = "";

    /**
     * METODO DE URL READ DE USER: GET
     *
     * Se recibe por key (id=#) el id del usuario y se trae la encontrada o se traen todos
     * los datos en caso de no haber key.
     *
     * @return json Datos con el result
     **/
    public function read()
    {
        if (isset($_GET["id"])) {
            $usuarioId = $_GET["id"];
            $users = User::find($usuarioId);
        } else {
            $users = User::all();
        }

        return response()->json($users);
    }

    /**
     * METODO DE URL CREATE DE USER: POST
     *
     * Se reciben los datos de entrada y se crea el usuario
     * con los datos requeridos
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el result y el id del usuario creado
     **/
    public function create(Request $request)
    {
        $_respuestas = new respuestas;
        $_user = new User();
        $datos = json_decode($request->getContent());

        if (!isset($datos->useNombres) || !isset($datos->useApellidos) || !isset($datos->useCorreo) || !isset($datos->usePassword) || 
            !isset($datos->useRol)) {
            return $_respuestas->error_400();
        } else {
            $this->useNombres = $datos->useNombres;
            $this->useApellidos = $datos->useApellidos;
            $this->useCorreo = $datos->useCorreo;
            $this->usePassword = $datos->usePassword;
            $this->useRol = $datos->useRol;
            if (!isset($datos->seller_id)) {
                $this->seller_id = null;
            } else {
                $this->seller_id = $datos->seller_id;
            }
            $_user->useNombres = $this->useNombres;
            $_user->useApellidos = $this->useApellidos;
            $_user->useCorreo = $this->useCorreo;
            $_user->usePassword = Hash::make($this->usePassword);
            $_user->useRol = $this->useRol;
            $_user->seller_id = $this->seller_id;
            $_user->save();

            $respu = $_user;
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
     * METODO DE URL UPDATE DE USER: PATCH
     *
     * Se reciben los datos de entrada y por medio del id se actualiza el usuario
     * con los datos requeridos
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el id del usuario actualizado
     **/
    public function update(Request $request)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($request->getContent());

        if (!isset($datos->id)) {
            return $_respuestas->error_400();
        } else {
            $this->usuarioId = $datos->id;

            if (isset($datos->useNombres)) {
                $this->useNombres = $datos->useNombres;
            }
            if (isset($datos->useApellidos)) {
                $this->useApellidos = $datos->useApellidos;
            }
            if (isset($datos->useCorreo)) {
                $this->useCorreo = $datos->useCorreo;
            }
            if (isset($datos->usePassword)) {
                $this->usePassword = $datos->usePassword;
            }
            if (isset($datos->useRol)) {
                $this->useRol = $datos->useRol;
            }
            if (isset($datos->seller_id)) {
                $this->seller_id = $datos->seller_id;
            } else {
                $this->seller_id = null;
            }

            $_user = User::find($this->usuarioId);
            $resultArray = array();

            foreach ($_user as $key) {
                $resultArray[] = $key;
            }
            $datos = $this->convertirUtf8($resultArray);

            if ($datos) {
                $_user->useNombres = $this->useNombres;
                $_user->useApellidos = $this->useApellidos;
                $_user->useCorreo = $this->useCorreo;
                $_user->usePassword = Hash::make($this->usePassword);
                $_user->useRol = $this->useRol;
                $_user->seller_id = $this->seller_id;
                $_user->save();

                $respu = $_user;
                if ($respu) {
                    $resp = $respu;
                } else {
                    $resp = 0;
                }

                if ($resp) {
                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "id" => $this->usuarioId
                    );
                    return $respuesta;
                } else {
                    return $_respuestas->error_500();
                }
            } else {
                return $_respuestas->error_200("Usuario inactivo!!");
            }
        }
    }

    /**
     * METODO DE URL DELETE DE USER: DELETE
     *
     * Se reciben los datos de entrada y por medio del id se elimina el usuario
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el result y el id del usuario eliminado
     **/
    public function delete(Request $request)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($request->getContent());

        if (!isset($datos->id)) {
            return $_respuestas->error_400();
        } else {
            $this->usuarioId = $datos->id;

            $_user = User::find($this->usuarioId);
            $_user->delete();

            $respuesta = $_respuestas->response;
            $respuesta["result"] = array(
                "id" => $this->usuarioId
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
