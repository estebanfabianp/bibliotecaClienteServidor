<?php

class LibroDAO {

    function CrearLibro($array) {

        if ($this->Filtro($array) == "ok") {
            $respuesta = array();
            $respuesta["sucess"] = "Reguistro duplicado";
            echo json_encode($respuesta);
        } else {

            $sql = 'INSERT INTO `tbl_libro`(`isbn`, `idEditorial`, `titulo`, `categoriaLibro`, `resena`) VALUES (?, ?, ?, ?, ?)';
            $BD = new ConectarBD();
            $conn = $BD->getMysqli();
            $stmp = $conn->prepare($sql);

            $this->respuesta($conn, $this->insert($array, $stmp));
        }
    }

    function ModificarLibro($array) {

        $libroVo = new LibroVO;
        $libroVo->setIsbn($array->isbn);
        $libroVo->setIdEditorial($array->editorial);
        $libroVo->setTitulo($array->titulo);
        $libroVo->setEditorial($array->editorial);
        $libroVo->setCategoriaLibro($array->categoriaLibro);
        $libroVo->setResena($array->resena);
        $libroVo->setImagen($array->imagen);

        $sql = 'UPDATE `tbl_libro` SET `idEditorial` = ?, `titulo` = ?, `editorial` = ?, `categoriaLibro` = ?, `resena` = ?,imagen=? WHERE `tbl_libro`.`isbn` = ?;';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $isbn = $libroVo->getisbn();
        $idEditorial = $libroVo->getIdEditorial();
        $titulo = $libroVo->getTitulo();
        $editorial = $libroVo->getEditorial();
        $categoriaLibro = $libroVo->getCategoriaLibro();
        $resena = $libroVo->getResena();
        $imagen = $libroVo->getImagen();

        $stmp->bind_param("sisi", $idEditorial, $titulo, $editorial, $categoriaLibro, $resena, $imagen, $isbn);

        $this->Respuesta($conn, $stmp);
    }

    function EliminarLibro($array) {

        $libroVo = new LibroVO;
        $libroVo->setIsbn($array->isbn);

        $sql = 'call  eliminarLibro (?);';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $isbn = $libroVo->getIsbn();
        $stmp->bind_param("i", $isbn);

        $this->Respuesta($conn, $stmp);
    }

    public function ListarXid($array) {
        $sql = 'call ListarXid (?);';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $LibroVo = new LibroVO();
        $LibroVo->setIsbn($array->Consulta);

        $Consulta = $LibroVo->getIsbn();

        $Consulta = $Consulta . "%";

        $stmp->bind_param("i", $Consulta);

        $stmp->execute();
        $stmp->bind_result($isbn1, $isbn, $titulo, $autor, $tema, $editorial, $facultad, $estado, $resena, $imagen);

        $respuesta = array();
        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["isbn"] = $isbn;
            $tmp["titulo"] = $titulo;
            $tmp["autor"] = $autor;
            $tmp["tema"] = $tema;
            $tmp["editorial"] = $editorial;
            $tmp["facultad"] = $facultad;
            $tmp["estado"] = $estado;
            $tmp["resena"] = $resena;
            $tmp["imagen"] = $imagen;
            $respuesta[sizeof($respuesta)] = $tmp;
        }
        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    public function ListarXtitulo($array) {
        $sql = 'call ListarXtitulo (?) ;';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $LibroVO = new LibroVO();
        $LibroVO->setTitulo($array->Consulta);

        $Consulta = $LibroVO->getTitulo();
        $Consulta = "%" . $Consulta . "%";

        $stmp->bind_param("s", $Consulta);
        $this->RespuestaLibros($conn, $stmp);
    }

    public function LoMasBUscado($array) {
        $sql = "SELECT * FROM `lomasbuscadolibro`;";
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $stmp->execute();
        $stmp->bind_result($isbn, $titulo, $imagen, $nombreAutor, $editorial);

        $respuesta = array();
        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["isbn"] = $isbn;
            $tmp["autor"] = $nombreAutor;
            $tmp["titulo"] = $titulo;
            $tmp["imagen"] = $imagen;
            $tmp["editorial"] = $editorial;
            $respuesta[sizeof($respuesta)] = $tmp;
        }
        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    public function ListarXautor($array) {
        $sql = 'call ListarXautor (?);';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $AutorVO = new AutorVO();
        $AutorVO->setNombreAutor($array->Consulta);

        $Consulta = $AutorVO->getNombreAutor();
        $Consulta = "%" . $Consulta . "%";

        $stmp->bind_param("s", $Consulta);
        $this->RespuestaLibros($conn, $stmp);
    }

    public function ListarXtema($array) {
        $sql = 'call ListarXtema (?);';
        $BD = new ConectarBD();

        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $TemaVO = new TemaVO();
        $TemaVO->setNombreTema($array->Consulta);

        $Consulta = $TemaVO->getNombreTema();

        $Consulta = "%" . $Consulta . "%";

        $stmp->bind_param("s", $Consulta);
        $this->RespuestaLibros($conn, $stmp);
    }

    public function ListarXeditorial($array) {
        $sql = 'call ListarXeditorial (?);';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $EditorialVO = new EditorialVO();
        $EditorialVO->setNombreEditorial($array->Consulta);

        $Consulta = $EditorialVO->getNombreEditorial();
        $Consulta = "%" . $Consulta . "%";

        $stmp->bind_param("s", $Consulta);
        $this->RespuestaLibros($conn, $stmp);
    }

    public function ListarXfacultad($array) {
        $sql = 'call ListarXfacultad (?;)';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $LibroAutorVO = new LibroAutorVO();
        $LibroAutorVO->setListaLibro($array->Consulta);

        $Consulta = $LibroAutorVO->getListaLibro();
        $Consulta = "%" . $Consulta . "%";

        $stmp->bind_param("s", $Consulta);
        $this->RespuestaLibros($conn, $stmp);
    }

    public function ListarXPortada($array) {
        $sql = 'call ListarXPortada (?);';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);
        $LibroVO = new LibroVO();
        $LibroVO->setIsbn($array->isbn);
        $isbn = $LibroVO->getIsbn();
        $stmp->bind_param("i", $isbn);
        $stmp->execute();
        $stmp->bind_result($resena, $imagen);

        $respuesta = array();
        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["resena"] = $resena;
            $tmp["imagen"] = $imagen;
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

    function RespuestaLibros($conn, $stmp) {
        $stmp->execute();
        $stmp->bind_result($isbn, $titulo, $autor, $tema, $editorial, $facultad, $estado, $resena, $imagen);

        $respuesta = array();
        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["isbn"] = $isbn;
            $tmp["titulo"] = $titulo;
            $tmp["autor"] = $autor;
            $tmp["tema"] = $tema;
            $tmp["editorial"] = $editorial;
            $tmp["facultad"] = $facultad;
            $tmp["estado"] = $estado;
            $tmp["resena"] = $resena;
            $tmp["imagen"] = $imagen;
            $respuesta[sizeof($respuesta)] = $tmp;
        }
        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    function libroAutor($array) {
        $sql = "INSERT INTO `tbl_libro_autor` ( `isbn`, `idAutor`) VALUES (?,?')";
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $libroAutor = new LibroAutorVO();
        $libroAutor->setIsbn($array->isbn);
        $isbn = $libroAutor->getIsbn();

        $libroAutor->setIsbn($array->autor);
        $autor = $libroAutor->getIdautor();

        $stmp->bind_param("si", $isbn, $autor);
        $this->Respuesta($conn, $stmp);
    }

    function SMCrearLibro($array) {

        if ($this->Filtro($array) == "ok") {
            $respuesta = array();
            $respuesta["sucess"] = "Reguistro duplicado";
            echo json_encode($respuesta);
        } else {

            $sql = 'INSERT INTO `tbl_libro`(`isbn`, `idEditorial`, `titulo`, `categoriaLibro`, `resena`) VALUES (?, ?, ?, ?, ?)';
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

    function Filtro($array) {
        $sql = "SELECT `isbn` FROM `tbl_libro` WHERE `isbn` = ?";
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $libroVo = new LibroVO;
        $libroVo->setIsbn($array->isbn);
        $isbn = $libroVo->getIsbn();
        $stmp->bind_param("i", $isbn);

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

    function insert($array, $stmp) {
        $libroVo = new LibroVO;
        $libroVo->setIsbn($array->isbn);
        $libroVo->setIdEditorial($array->editorial);
        $libroVo->setTitulo($array->titulo);
        $libroVo->setCategoriaLibro($array->categoriaLibro);
        $libroVo->setResena($array->resena);
//        $libroVo->setImagen($array->imagen);

        $isbn = $libroVo->getIsbn();
        $titulo = $libroVo->getTitulo();
        $editorial = $libroVo->getIdEditorial();
        $categoriaLibro = $libroVo->getCategoriaLibro();
        $resena = $libroVo->getResena();
//        $imagen = $libroVo->getImagen();

        $stmp->bind_param("sisss", $isbn, $editorial, $titulo, $categoriaLibro, $resena);

        return $stmp;
    }

}
