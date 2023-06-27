<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $comentarioId = "";
    private $comTexto = "";
    private $product_id = "";
    private $user_id = "";

    /**
     * METODO DE URL READ DE COMMENT: GET
     *
     * Se recibe por key (id=#) el id del comentario y se trae la encontrada o se traen todos
     * los datos en caso de no haber key.
     *
     * @return json Datos con el result
     **/
    public function read()
    {
        if (isset($_GET["id"])) {
            $comentarioId = $_GET["id"];
            $comments = Comment::find($comentarioId);
        } else {
            $comments = Comment::all();
        }

        return response()->json($comments);
    }

    /**
     * METODO DE URL CREATE DE COMMENT: POST
     *
     * Se reciben los datos de entrada y se crea el comentario
     * con los datos requeridos
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el result y el id del comentario creado
     **/
    public function create(Request $request)
    {
        $_respuestas = new respuestas;
        $_comment = new Comment();
        $datos = json_decode($request->getContent());

        if (!isset($datos->comTexto) || !isset($datos->product_id) || !isset($datos->user_id)) {
            return $_respuestas->error_400();
        } else {
            $this->comTexto = $datos->comTexto;
            $this->product_id = $datos->product_id;
            $this->user_id = $datos->user_id;
            $_comment->comTexto = $this->comTexto;
            $_comment->product_id = $this->product_id;
            $_comment->user_id = $this->user_id;
            $_comment->save();

            $respu = $_comment;
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
     * METODO DE URL UPDATE DE COMMENT: PATCH
     *
     * Se reciben los datos de entrada y por medio del id se actualiza el comentario
     * con los datos requeridos
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el id del comentario actualizado
     **/
    public function update(Request $request)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($request->getContent());

        if (!isset($datos->id)) {
            return $_respuestas->error_400();
        } else {
            $this->comentarioId = $datos->id;

            if (isset($datos->comTexto)) {
                $this->comTexto = $datos->comTexto;
            }
            if (isset($datos->product_id)) {
                $this->product_id = $datos->product_id;
            }
            if (isset($datos->user_id)) {
                $this->user_id = $datos->user_id;
            }

            $_comment = Comment::find($this->comentarioId);
            $resultArray = array();

            foreach ($_comment as $key) {
                $resultArray[] = $key;
            }
            $datos = $this->convertirUtf8($resultArray);

            if ($datos) {
                $_comment->comTexto = $this->comTexto;
                $_comment->product_id = $this->product_id;
                $_comment->user_id = $this->user_id;
                $_comment->save();

                $respu = $_comment;
                if ($respu) {
                    $resp = $respu;
                } else {
                    $resp = 0;
                }

                if ($resp) {
                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "id" => $this->comentarioId
                    );
                    return $respuesta;
                } else {
                    return $_respuestas->error_500();
                }
            } else {
                return $_respuestas->error_200("Comentario inactivo!!");
            }
        }
    }

    /**
     * METODO DE URL DELETE DE COOMENT: DELETE
     *
     * Se reciben los datos de entrada y por medio del id se elimina el comentario
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el result y el id del comentario eliminado
     **/
    public function delete(Request $request)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($request->getContent());

        if (!isset($datos->id)) {
            return $_respuestas->error_400();
        } else {
            $this->comentarioId = $datos->id;

            $_comment = Comment::find($this->comentarioId);
            $_comment->delete();

            $respuesta = $_respuestas->response;
            $respuesta["result"] = array(
                "id" => $this->comentarioId
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
