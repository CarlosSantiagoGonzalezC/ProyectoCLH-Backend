<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\PasswordMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $usuarioId = "";
    private $useNombres = "";
    private $useApellidos = "";
    private $useCorreo = "";
    private $usePassword = "";
    private $useRol = "";

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

        if (
            !isset($datos->useNombres) || !isset($datos->useApellidos) || !isset($datos->useCorreo) || !isset($datos->usePassword) ||
            !isset($datos->useRol)
        ) {
            return $_respuestas->error_400();
        } else {
            $this->useNombres = $datos->useNombres;
            $this->useApellidos = $datos->useApellidos;
            $this->useCorreo = $datos->useCorreo;
            $this->usePassword = $datos->usePassword;
            $this->useRol = $datos->useRol;
            $_user->useNombres = $this->useNombres;
            $_user->useApellidos = $this->useApellidos;
            $_user->useCorreo = $this->useCorreo;
            $_user->usePassword = Hash::make($this->usePassword);
            $_user->useRol = $this->useRol;
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
     * METODO PARA EDITAR PASSWORD DE USER: PATCH
     *
     * Se reciben los datos de entrada y por medio del id se actualiza el password
     * del usuario
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el id del usuario actualizado
     **/
    public function editPassword(Request $request)
    {
        $_respuestas = new respuestas;

        $datos = json_decode($request->getContent());
        if (!isset($datos->id) || !isset($datos->passwordActual) || !isset($datos->passwordNueva)) {
            // Error en los campos
            return $_respuestas->error_401();
        } else {
            $usuarioId = $datos->id;
            $passwordActual = $datos->passwordActual;
            $passwordNueva = $datos->passwordNueva;

            $_user = User::find($usuarioId);
            $resultArray = array();

            foreach ($_user as $key) {
                $resultArray[] = $key;
            }

            $datos = $this->convertirUtf8($resultArray);

            if ($datos) {
                // Verificar si la contraseña es igual
                if (Hash::check($passwordActual, $_user->usePassword)) {
                    $_user->usePassword = Hash::make($passwordNueva);
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
                            "id" => $usuarioId
                        );
                        return $respuesta;
                    } else {
                        return $_respuestas->error_500();
                    }
                } else {
                    //Contraseña incorrecta
                    return $_respuestas->error_200("La contraseña es invalida!!");
                }
            } else {
                // Si no existe el usuario
                return $_respuestas->error_200("El usuario no existe!!");
            }
        }
    }

    /**
     * METODO PARA RECUPERAR CONTRASEÑA DE USER: PATCH
     *
     * Se reciben los datos de entrada y por medio del id se actualiza el password
     * del usuario
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el id del usuario actualizado
     **/
    public function recoverPassword(Request $request)
    {
        $_respuestas = new respuestas;

        $datos = json_decode($request->getContent());
        if (!isset($datos->useCorreo)) {
            // Error en los campos
            return $_respuestas->error_401();
        } else {
            $correo = $datos->useCorreo;

            $_user = User::where('useCorreo', $correo)->firstOrFail();
            $resultArray = array();

            foreach ($_user as $key) {
                $resultArray[] = $key;
            }

            $data = $this->convertirUtf8($resultArray);

            if ($data) {
                $passwordNueva = Str::random(10);
                $_user->usePassword = Hash::make($passwordNueva);
                $_user->save();

                $respu = $_user;
                if ($respu) {
                    $resp = $respu;
                } else {
                    $resp = 0;
                }

                if ($resp) {
                    $contenido = "Su nueva contraseña es la siguiente: " . $passwordNueva;
                    $datos = [
                        'titulo' => 'Correo de recuperación de contraseña',
                        'contenido' => $contenido
                    ];

                    Mail::to($correo)->send(new PasswordMail($datos));

                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "id" => $_user->id,
                        "password" => $passwordNueva
                    );
                    return $respuesta;
                } else {
                    return $_respuestas->error_500();
                }
            } else {
                // Si no existe el usuario
                return $_respuestas->error_200("El usuario $correo no existe!!");
            }
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
