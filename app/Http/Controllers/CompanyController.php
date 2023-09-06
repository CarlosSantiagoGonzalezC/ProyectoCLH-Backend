<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $empresaId = "";
    private $comNombre = "";
    private $comHistoria = "";
    private $comImagen = "";
    private $comMunicipio = "";
    private $comDireccion = "";
    private $comTelefono = "";
    private $comCorreo = "";
    private $seller_id = "";

    /**
     * METODO DE URL READ DE COMPANY: GET
     *
     * Se recibe por key (id=#) el id de la empresa y se trae la encontrada o se traen todos
     * los datos en caso de no haber key.
     *
     * @return json Datos con el result
     **/
    public function read()
    {
        if (isset($_GET["id"])) {
            $empresaId = $_GET["id"];
            $companies = Company::find($empresaId);
        } else {
            $companies = Company::all();
        }

        return response()->json($companies);
    }

    /**
     * METODO DE URL COMPANY PARA OBTENER EMPRESA SEGUN EL VENDEDOR: GET
     *
     * Se recibe por key (id=#) el id del vendedor y se trae la encontrada o se envia mensaje
     * de error.
     *
     * @return json Datos con el result
     **/
    public function getCompanyIdSeller()
    {
        $_respuestas = new respuestas;
        if (isset($_GET["id"])) {
            $vendedorId = $_GET["id"];
            $company = Company::where('seller_id', $vendedorId)->get();
            return response()->json($company);
        } else {
            return $_respuestas->error_200("Debe añadir a la url una key donde este el id del vendedor!!");
        }
    }

    /**
     * METODO DE URL CREATE DE COMPANY: POST
     *
     * Se reciben los datos de entrada y se crea la empresa
     * con los datos requeridos
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el result y el id de la empresa creada
     **/
    public function create(Request $request)
    {
        $_respuestas = new respuestas;
        $_company = new Company();
        $datos = json_decode($request->getContent());

        if (
            !isset($datos->comNombre) || !isset($datos->comHistoria) || !isset($datos->comImagen) || !isset($datos->comMunicipio) ||
            !isset($datos->comDireccion) || !isset($datos->comTelefono) || !isset($datos->comCorreo) || !isset($datos->seller_id)
        ) {
            return $_respuestas->error_400();
        } else {
            $this->comNombre = $datos->comNombre;
            $this->comHistoria = $datos->comHistoria;
            $this->comImagen = base64_encode($datos->comImagen);
            /**
             * Guardar imagen en public/images/company
             */
            // if ($request->hasFile('comImagen')) {
            //     $file = $request->file('comImagen');
            //     $destinationPath = 'images/companies/';
            //     $fileName = time() . '-' . $file->getClientOriginalName();
            //     $request->file('comImagen')->move($destinationPath, $fileName);
            //     $this->comImagen = $destinationPath . $fileName;
            // }
            $this->comMunicipio = $datos->comMunicipio;
            $this->comDireccion = $datos->comDireccion;
            $this->comTelefono = $datos->comTelefono;
            $this->comCorreo = $datos->comCorreo;
            $this->seller_id = $datos->seller_id;
            $_company->comNombre = $this->comNombre;
            $_company->comHistoria = $this->comHistoria;
            $_company->comImagen = $this->comImagen;
            $_company->comMunicipio = $this->comMunicipio;
            $_company->comDireccion = $this->comDireccion;
            $_company->comTelefono = $this->comTelefono;
            $_company->comCorreo = $this->comCorreo;
            $_company->seller_id = $this->seller_id;
            $_company->save();

            $respu = $_company;
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
     * METODO DE URL UPDATE DE COMPANY: PATCH
     *
     * Se reciben los datos de entrada y por medio del id se actualiza la empresa
     * con los datos requeridos
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el id de la empresa actualizada
     **/
    public function update(Request $request)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($request->getContent());

        if (!isset($datos->id)) {
            return $_respuestas->error_400();
        } else {
            $this->empresaId = $datos->id;

            if (isset($datos->comNombre)) {
                $this->comNombre = $datos->comNombre;
            }
            if (isset($datos->comHistoria)) {
                $this->comHistoria = $datos->comHistoria;
            }
            if (isset($datos->comImagen)) {
                $this->comImagen = base64_encode($datos->comImagen);
            }
            if (isset($datos->comMunicipio)) {
                $this->comMunicipio = $datos->comMunicipio;
            }
            if (isset($datos->comDireccion)) {
                $this->comDireccion = $datos->comDireccion;
            }
            if (isset($datos->comTelefono)) {
                $this->comTelefono = $datos->comTelefono;
            }
            if (isset($datos->comCorreo)) {
                $this->comCorreo = $datos->comCorreo;
            }
            if (isset($datos->seller_id)) {
                $this->seller_id = $datos->seller_id;
            }

            $_company = Company::find($this->empresaId);
            $resultArray = array();

            foreach ($_company as $key) {
                $resultArray[] = $key;
            }
            $datos = $this->convertirUtf8($resultArray);

            if ($datos) {
                $_company->comNombre = $this->comNombre;
                $_company->comHistoria = $this->comHistoria;
                $_company->comImagen = $this->comImagen;
                $_company->comMunicipio = $this->comMunicipio;
                $_company->comDireccion = $this->comDireccion;
                $_company->comTelefono = $this->comTelefono;
                $_company->comCorreo = $this->comCorreo;
                $_company->seller_id = $this->seller_id;
                $_company->save();

                $respu = $_company;
                if ($respu) {
                    $resp = $respu;
                } else {
                    $resp = 0;
                }

                if ($resp) {
                    $respuesta = $_respuestas->response;
                    $respuesta["result"] = array(
                        "id" => $this->empresaId
                    );
                    return $respuesta;
                } else {
                    return $_respuestas->error_500();
                }
            } else {
                return $_respuestas->error_200("Finca/Empresa inactiva!!");
            }
        }
    }

    /**
     * METODO DE URL DELETE DE COMPANY: DELETE
     *
     * Se reciben los datos de entrada y por medio del id se elimina la empresa
     *
     * @param Request $request Datos de entrada
     * @return json Datos con el result y el id de la empresa eliminada
     **/
    public function delete(Request $request)
    {
        $_respuestas = new respuestas;
        $datos = json_decode($request->getContent());

        if (!isset($datos->id)) {
            return $_respuestas->error_400();
        } else {
            $this->empresaId = $datos->id;

            $_company = Company::find($this->empresaId);
            $_company->delete();

            $respuesta = $_respuestas->response;
            $respuesta["result"] = array(
                "id" => $this->empresaId
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
