<?php

class EditorialVO {

    private $idEditorial;
    private $nombreEditorial;
    private $direccionEditorial;
    private $telefonoEditorial;
    private $anoPublicacion;

    function getIdEditorial() {
        return $this->idEditorial;
    }

    function getNombreEditorial() {
        return $this->nombreEditorial;
    }

    function getDireccionEditorial() {
        return $this->direccionEditorial;
    }

    function getTelefonoEditorial() {
        return $this->telefonoEditorial;
    }

    function getAnoPublicacion() {
        return $this->anoPublicacion;
    }

    function setIdEditorial($idEditorial) {
        $this->idEditorial = $idEditorial;
    }

    function setNombreEditorial($nombreEditorial) {
        $this->nombreEditorial = $nombreEditorial;
    }

    function setDireccionEditorial($direccionEditorial) {
        $this->direccionEditorial = $direccionEditorial;
    }

    function setTelefonoEditorial($telefonoEditorial) {
        $this->telefonoEditorial = $telefonoEditorial;
    }

    function setAnoPublicacion($anoPublicacion) {
        $this->anoPublicacion = $anoPublicacion;
    }

}
