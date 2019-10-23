<?php

/**
 * Long Desc 
 * */
/**
 * Cotrolador del acceso que lleva es encargado de servir de puente de comunicacion 
 * entre la capa de interface y la capa de datos para poder subir un archivo cvs y realizar el registro de la informacion de los libros.
 *
 * 
 * @package Controlador
 * @category Educativo
 * @author Esteban fabian patiño montealegre <estebanfabianp@gmail.com>
 * @link https://github.com/estebanfabian/bibliotecaClienteServidor.git 
 * @version Revision: 1.0 
 * @access publico
 * @return array() devuelve el numero de filas que fueron  exitosas , fallidas y registros duplcados encontrado al momento de realizar el registro de la informaciòn
 * * */
header('Access-Control-Allow-Origin: *');
require '../../CLASES/BD/MySql.php';
require '../../CLASES/BD/datosbd.php';
require '../../CLASES/VO/LibroVO.php';
require '../../CLASES/VO/AutorVO.php';
require '../../CLASES/VO/EditorialVO.php';
require '../../CLASES/VO/CategoriaVo.php';
require '../../CLASES/VO/LpublicaVo.php';
require '../../CLASES/VO/TemaVO.php';
require '../../CLASES/DAO/LibroDAO.php';
$Exitoso = 0;
$Fallido = 0;
$Duplicado = 0;
$numeroFila = 0;

$Fallido_n = "";
$Duplicado_n = "";
if ($_FILES['csv']['size'] > 0) {
    $csv = $_FILES['csv']['tmp_name'];
    $file = fopen($csv, 'r');
    while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
        if ($numeroFila > 0) {

            $array = array(
                "isbn" => $column[0],
                "titulo" => $column[1],
                "resena" => $column[2],
                "autor" => cambio($column[3]),
                "editorial" => $column[4],
                "tema" => cambio($column[5]),
                "lPublica" => cambio($column[6]),
                "lCategoria" => cambio($column[7]),
                "imagen" => $column[8]
            );

         
            $object = json_decode(json_encode((object) $array), FALSE);
            $libroDAO = new LibroDAO();
            $respuesta = $libroDAO->SMCrearLibro($object);//hacer insert con  sekect
//
            echo $respuesta;
            if ($respuesta == "ok") {
                $Exitoso++;
            } elseif ($respuesta == 'no') {
                $Fallido++;
                $Fallido_n = $Fallido_n . " " . $numeroFila;
            } else {
                $Duplicado++;
                $Duplicado_n = $Duplicado_n . " " . $numeroFila;
            }
            echo json_encode((object) $array);
        }
        $numeroFila++;
    }
//    echo "Exitoso " . $Exitoso;
//    echo "Fallido " . $Fallido . " numero de las lineas" . $Fallido_n;
//    echo "Duplicado " . $Duplicado . " numero de lineas" . $Duplicado_n;


    $array = array("Exitoso" => $Exitoso,
        "Fallido" => $Fallido,
        "Duplicado" => $Duplicado);
    echo json_encode((object) $array);
}
function cambio($param) {
    $valore=explode("|",$param);
    return $valore;
}