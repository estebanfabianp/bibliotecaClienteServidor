<?php

class TemaDAO {

    function CrearTema($array) {

        if ($this->Filtro($array) == "ok") {
            $respuesta = array();
            $respuesta["sucess"] = "Reguistro duplicado";
            echo json_encode($respuesta);
        } else {

            $sql = "call insetTema (?,?);";
            $BD = new ConectarBD();
            $conn = $BD->getMysqli();
            $stmp = $conn->prepare($sql);

            $this->respuesta($conn, $this->insert($array, $stmp));
        }
    }

    function ModificarTema($array) {

        $sql = 'call actualizarTema (?,?);';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $TemaVo = new TemaVO();

        $TemaVo->setNombreTema($array->nombreTema);
        $TemaVo->setDescripcion($array->Descricion);

        $nombreTema = $TemaVo->getNombreTema();
        $Descricion = $TemaVo->getDescripcion();

        $stmp->bind_param("ss", $nombreTema, $Descricion);
        $this->Respuesta($conn, $stmp);
    }

    function EliminarTema($array) {
       if ($this->Filtro($array) == "no") {
            $respuesta = array();
            $respuesta["sucess"] = "no";
            echo json_encode($respuesta);
        } else {
            $sql = "call eliminarTema (?);";

            $BD = new ConectarBD();
            $conn = $BD->getMysqli();
            $stmp = $conn->prepare($sql);

            $TemaVo = new TemaVO();
            $TemaVo->setNombreTema($array->nombreTema);

            $idTema = $TemaVo->getNombreTema();

            $stmp->bind_param("s", $idTema);
             $this->respuesta($conn, $stmp);
        }
    }

     function Respuesta($conn, $stmp) {
        $respuesta = array();
        if ($stmp->execute() == 1) {
            $respuesta["sucess"] = "ok";
        } else {
            $respuesta["sucess"] = "no";
             echo json_encode($stmp);
        }
        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    function BuscarTema($array) {
        $sql = "call buscarTema (?);";
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $TemaVo = new TemaVO();
        $TemaVo->setNombreTema($array->nombreTema);

        $nombreTema = $TemaVo->getNombreTema();

        $stmp->bind_param("s", $nombreTema);
        $stmp->execute();

        $stmp->bind_result($Descricion);
        $respuesta = array();
        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["nombreTema"] = $nombreTema;
            $tmp["Descricion"] = $Descricion;
            $respuesta[sizeof($respuesta)] = $tmp;
        }
        $stmp->close();
        $conn->close();
        echo json_encode($tmp);
    }

    function insert($array, $stmp) {

        $TemaVo = new TemaVO();
        $TemaVo->setNombreTema($array->nombreTema);
        $TemaVo->setDescripcion($array->Descricion);

        $nombreTema = $TemaVo->getNombreTema();
        $Descricion = $TemaVo->getDescripcion();

        $stmp->bind_param("ss", $nombreTema, $Descricion);
        return $stmp;
    }

    function Filtro($array) {

        $sql = 'call verificacionTema (?);';

        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $TemaVo = new TemaVO();
        $TemaVo->setNombreTema($array->nombreTema);

        $nombreTema = $TemaVo->getNombreTema();

        $stmp->bind_param("s", $nombreTema);

        $respuesta = array();
        if ($stmp->execute() == 1) {
            $stmp->bind_result($codigo);
            while ($stmp->fetch()) {
                $respuesta = $codigo;
            }

            if ($codigo != "") {
                $respuesta = "ok";
            } else {
                $respuesta = "no";
            }
        } else {
            $respuesta = "no";
        }
        $stmp->close();
        $conn->close();
        return ($respuesta);
    }

    function SMCrearTema($array) {

        if ($this->Filtro($array) == "ok") {
            $respuesta = array();
            $respuesta["sucess"] = "Reguistro duplicado";
            echo json_encode($respuesta);
        } else {

            $sql = "call insetTema (?,?);";
            $BD = new ConectarBD();
            $conn = $BD->getMysqli();
            $stmp = $conn->prepare($sql);

            $respuesta = array();
            if ($this->insert($array, $stmp)->execute() == 1) {
                $respuesta = "ok";
            } else {
                $respuesta = "no";
            }
            $stmp->close();
            $conn->close();
            return $respuesta;
        }
    }

}
