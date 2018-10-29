<?php

class VideoBeamDAO {

    function CrearVideoBeam($array) {

        $VideoBeamVo = new VideoBeamVO();
        $VideoBeamVo->setIdVideoBeam($array->idVideoBeam);
        $VideoBeamVo->setFabricante($array->fabricante);
        $VideoBeamVo->setCableUSB($array->cableUSB);
        $VideoBeamVo->setCableHDMI($array->cableHDMI);
        $VideoBeamVo->setCableVGA($array->cableVGA);
        $VideoBeamVo->setObservaciones($array->observaciones);

        $sql = 'INSERT INTO `tbl_video_beam`(`idVideoBeam`, `fabricante`, `cableUSB`, `cableHDMI`, `cableVGA`, `observaciones`) VALUES (?,?,?,?,?,?);';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $idVideoBeam = $VideoBeamVo->getIdVideoBeam();
        $fabricante = $VideoBeamVo->getFabricante();
        $cableUSB = $VideoBeamVo->getCableUSB();
        $cableHDMI = $VideoBeamVo->getCableHDMI();
        $cableVGA = $VideoBeamVo->getCableVGA();
        $observaciones = $VideoBeamVo->getObservaciones();

        $stmp->bind_param("isiiis", $idVideoBeam, $fabricante, $cableUSB, $cableHDMI, $cableVGA, $observaciones);
        $this->respuesta($conn, $stmp);
    }

    function ModificarVideoBeam($array) {

        $sql = 'UPDATE `tbl_video_beam` SET `fabricante`= ?,`cableUSB`= ?,`cableHDMI`= ?,`cableVGA`= ?,`observaciones`= ? WHERE `idVideoBeam`= ?;';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $VideoBeamVo = new VideoBeamVO();
        $VideoBeamVo->setIdVideoBeam($array->idVideoBeam);
        $VideoBeamVo->setFabricante($array->fabricante);
        $VideoBeamVo->setCableUSB($array->cableUSB);
        $VideoBeamVo->setCableHDMI($array->cableHDMI);
        $VideoBeamVo->setCableVGA($array->cableVGA);
        $VideoBeamVo->setObservaciones($array->observaciones);

        $idVideoBeam = $VideoBeamVo->getIdVideoBeam();
        $fabricante = $VideoBeamVo->getFabricante();
        $cableUSB = $VideoBeamVo->getCableUSB();
        $cableHDMI = $VideoBeamVo->getCableHDMI();
        $cableVGA = $VideoBeamVo->getCableVGA();
        $observaciones = $VideoBeamVo->getObservaciones();

        $stmp->bind_param("sbbbsi", $fabricante, $cableUSB, $cableHDMI, $cableVGA, $observaciones, $idVideoBeam);
        $this->respuesta($conn, $stmp);
    }

    function EliminarVideoBeam($array) {

        $VideoBeamVo = new VideoBeamVO();
        $VideoBeamVo->setIdVideoBeam($array->idVideoBeam);

        $sql = 'DELETE FROM `tbl_video_beam` WHERE `idVideoBeam` = ?;';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $idVideoBeam = $VideoBeamVo->getIdVideoBeam();

        $stmp->bind_param("i", $idVideoBeam);
        $this->respuesta($conn, $stmp);
    }

    function BuscarVideoBean($array) {

        $VideoBeamVo = new VideoBeamVO();
        $VideoBeamVo->setIdVideoBeam($array->idVideoBeam);

        $sql = "SELECT * FROM `tbl_video_beam` WHERE `idVideoBeam`=?";
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $idVideoBeam = $VideoBeamVo->getIdVideoBeam();
        $stmp->bind_param("i", $idVideoBeam);
        $stmp->execute();

        $stmp->bind_result($idVideoBeam, $fabricante, $cableUSB, $cableHDMI, $cableVGA, $observaciones, $estadoVideoBeam);
        $respuesta = array();
        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["idVideoBeam"] = $idVideoBeam;
            $tmp["fabricante"] = $fabricante;
            $tmp["cableUSB"] = $cableUSB;
            $tmp["cableHDMI"] = $cableHDMI;
            $tmp["cableVGA"] = $cableVGA;
            $tmp["observaciones"] = $observaciones;
            $tmp["estadoVideoBeam"] = $estadoVideoBeam;
            $respuesta[sizeof($respuesta)] = $tmp;
        }
        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    function Respuesta($conn, $stmp) {
        $respuesta = array();
        if ($stmp->execute() == 1) {
            $respuesta["sucess"] = "ok";
        } else {
            $respuesta["sucess"] = "no";
        }

        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

}
