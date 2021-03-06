<?php

class LibroVO {

    private $isbn;
    private $idEditorial;
    private $titulo;
    private $categoriaLibro;
    private $resena;
    private $estado;
    private $imagen;

    function getIsbn() {
        return $this->isbn;
    }

    function getIdEditorial() {
        return $this->idEditorial;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getCategoriaLibro() {
        return $this->categoriaLibro;
    }

    function getResena() {
        return $this->resena;
    }

    function getEstado() {
        return $this->estado;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    function setIdEditorial($idEditorial) {
        $this->idEditorial = $idEditorial;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setCategoriaLibro($categoriaLibro) {
        $this->categoriaLibro = $categoriaLibro;
    }

    function setResena($resena) {
        $this->resena = $resena;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

}
