<?php

class CategoriaVO {

    private $idCategoria;
    private $categoria;
    private $descriccion;

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getDescriccion() {
        return $this->descriccion;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setDescriccion($descriccion) {
        $this->descriccion = $descriccion;
    }

}
