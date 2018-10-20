<?php

class ComputadorVO {

    private $idcomputador;
    private $fabricante;
    private $observaciones;
    private $cargadorId;
    private $estadoComputador;

    function getIdcomputador() {
        return $this->idcomputador;
    }

    function getFabricante() {
        return $this->fabricante;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getCargadorId() {
        return $this->cargadorId;
    }

    function getEstadoComputador() {
        return $this->estadoComputador;
    }

    function setIdcomputador($idcomputador) {
        $this->idcomputador = $idcomputador;
    }

    function setFabricante($fabricante) {
        $this->fabricante = $fabricante;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setCargadorId($cargadorId) {
        $this->cargadorId = $cargadorId;
    }

    function setEstadoComputador($estadoComputador) {
        $this->estadoComputador = $estadoComputador;
    }

}
