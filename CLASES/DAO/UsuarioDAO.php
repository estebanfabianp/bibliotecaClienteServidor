<?php

require("../../PHPMailer-master/src/PHPMailer.php");
require("../../PHPMailer-master/src/SMTP.php");
require("../../PHPMailer-master/src/Exception.php");

class UsuarioDAO {

    public function CrearUsuario($array) {
        if ($this->Filtro($array) == "ok") {
            $respuesta = array();
            $respuesta["sucess"] = "Reguistro duplicado";
            echo json_encode($respuesta);
        } else {
            $sql = 'call insetUsuario (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);';
            $BD = new ConectarBD();
            $conn = $BD->getMysqli();
            $stmp = $conn->prepare($sql);
            $this->respuesta($conn, $this->insert($array, $stmp));
        }
    }

    function ActualizarUsuario($array) {

        $BD = new ConectarBD();
        $conn = $BD->getMysqli();

        $sql = 'UPDATE `tbl_usuario` SET `nombre`= ?,`apellido`= ?,`fechaNacimiento`=?,`sexo`=?,`direccion`=?,`direccion2`=?,`telefonoPrincipal`= ?,`telefonoSecundario`=?,`telefonoOtro`=?,`emailPrincipal`=?,`contactoNombre`=?,`contactoApellido`=?,`contactoDireccion`= ?,`contactoDireccion2`=?,`contactoTelefono`=?,`contrasena`=?,`perfil`=? WHERE `codigo`= ?;';

        $stmp = $conn->prepare($sql);

        $UsuarioVO = new UsuarioVO();
        $UsuarioVO->setCodigo($array->codigo);
        $UsuarioVO->setNombre($array->nombre);
        $UsuarioVO->setApellido($array->apellido);
        $UsuarioVO->setFechaNacimiento($array->fechaNacimiento);
        $UsuarioVO->setSexo($array->sexo);
        $UsuarioVO->setDireccion($array->direccion);
        $UsuarioVO->setTelefonoPrincipal($array->telefonoPrincipal);
        $UsuarioVO->setEmailPrincipal($array->emailPrincipal);
        $UsuarioVO->setContrasena($array->contrasena);
        $UsuarioVO->setDireccion2($array->direccion2);
        $UsuarioVO->setTelefonoSecundario($array->telefonoSecundario);
        $UsuarioVO->setTelefonoOtro($array->telefonoOtro);
        $UsuarioVO->setContactoNombre($array->contactoNombre);
        $UsuarioVO->setContactoApellido($array->contactoApellido);
        $UsuarioVO->setContactoDireccion($array->contactoDireccion);
        $UsuarioVO->setContactoDireccion2($array->contactoDireccion2);
        $UsuarioVO->setContactoTelefono($array->contactoTelefono);
        $UsuarioVO->setPerfil($array->perfil);

        $codigo = $UsuarioVO->getCodigo();
        $nombre = $UsuarioVO->getNombre();
        $apellido = $UsuarioVO->getApellido();
        $fechaNacimiento = $UsuarioVO->getFechaNacimiento();
        $sexo = $UsuarioVO->getSexo();
        $direccion = $UsuarioVO->getDireccion();
        $direccion2 = $UsuarioVO->getDireccion2();
        $telefonoPrincipal = $UsuarioVO->getTelefonoPrincipal();
        $telefonoSecundario = $UsuarioVO->getTelefonoSecundario();
        $telefonoOtro = $UsuarioVO->getTelefonoOtro();
        $emailPrincipal = $UsuarioVO->getEmailPrincipal();
        $contactoNombre = $UsuarioVO->getContactoNombre();
        $contactoApellido = $UsuarioVO->getContactoApellido();
        $contactoDireccion = $UsuarioVO->getContactoDireccion();
        $contactoDireccion2 = $UsuarioVO->getContactoDireccion2();
        $contactoTelefono = $UsuarioVO->getContactoTelefono();
        $contrasena = $UsuarioVO->getContrasena();
        $perfil = $UsuarioVO->getPerfil();
        $stmp->bind_param("sssisssssssssssssi", $nombre, $apellido, $fechaNacimiento, $sexo, $direccion, $direccion2, $telefonoPrincipal, $telefonoSecundario, $telefonoOtro, $emailPrincipal, $contactoNombre, $contactoApellido, $contactoDireccion, $contactoDireccion2, $contactoTelefono, $contrasena, $perfil, $codigo);

        $this->respuesta($conn, $stmp);
    }

    function ElminarUsuario($array) {
        if ($this->Filtro($array) == "no") {
            $respuesta = array();
            $respuesta["sucess"] = "no";
            echo json_encode($respuesta);
        } else {
            $sql = 'call eliminarUsuario (?)';
            $BD = new ConectarBD();
            $conn = $BD->getMysqli();
            $stmp = $conn->prepare($sql);

            $Usuariovo = new UsuarioVO();
            $Usuariovo->setCodigo($array->codigo);

            $codigo = $Usuariovo->getCodigo();
            $stmp->bind_param("i", $codigo);

            $this->respuesta($conn, $stmp);
        }
    }

    function BuscarUsuario($array) {
        $sql = "CALL buscarUsuario(?)";
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);
        $UsuarioVO = new UsuarioVO();
        $UsuarioVO->setCodigo($array->codigo);
        $codigo = $UsuarioVO->getCodigo();


        $stmp->bind_param("i", $codigo);

        if ($stmp->execute() == 1) {
            $stmp->bind_result($codigo, $cedula, $nombre, $apellido, $fechaNacimiento, $sexo, $direccion, $direccion2, $telefonoPrincipal, $telefonoSecundario, $telefonoOtro, $emailPrincipal, $contactoNombre, $contactoApellido, $contactoDireccion, $contactoDireccion2, $contactoTelefono, $contrasena, $perfil
            );
            $respuesta = array();
            while ($stmp->fetch()) {
                $tmp = array();
                $tmp["codigo"] = $codigo;
                $tmp["cedula"] = $cedula;
                $tmp["nombre"] = $nombre;
                $tmp["apellido"] = $apellido;
                $tmp["fechaNacimiento"] = $fechaNacimiento;
                $tmp["sexo"] = $sexo;
                $tmp["direccion"] = $direccion;
                $tmp["direccion2"] = $direccion2;
                $tmp["telefonoPrincipal"] = $telefonoPrincipal;
                $tmp["telefonoSecundario"] = $telefonoSecundario;
                $tmp["telefonoOtro"] = $telefonoOtro;
                $tmp["emailPrincipal"] = $emailPrincipal;
                $tmp["contactoNombre"] = $contactoNombre;
                $tmp["contactoApellido"] = $contactoApellido;
                $tmp["contactoDireccion"] = $contactoDireccion;
                $tmp["contactoDireccion2"] = $contactoDireccion2;
                $tmp["contactoTelefono"] = $contactoTelefono;
                $tmp["contrasena"] = $contrasena;
                $tmp["perfil"] = $perfil;

                $respuesta[sizeof($respuesta)] = $tmp;
            }
        }

        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    public function Login($array) {

        $sql = "CALL login(?,?)";
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);
        $UsuarioVO = new UsuarioVO();
        $UsuarioVO->setCodigo($array->codigo);
        $UsuarioVO->setContrasena($array->contrasena);

        $codigo = $UsuarioVO->getCodigo();
        $contrasena = $UsuarioVO->getContrasena();

        $stmp->bind_param("is", $codigo, $contrasena);

        if ($stmp->execute() == 1) {
            $stmp->bind_result($codigo, $nombre, $perfil);
            $respuesta = array();
            while ($stmp->fetch()) {
                $tmp = array();
                $tmp["codigo"] = $codigo;
                $tmp["nombre"] = $nombre;
                $tmp["perfil"] = $perfil;
                $respuesta[sizeof($respuesta)] = $tmp;
            }
        }

        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    function Correo($array) {

        $sql = 'call correoUsuario (?,?)';

        $Usuariovo = new UsuarioVO();
        $Usuariovo->setCodigo($array->codigo);
        $Usuariovo->setEmailPrincipal($array->emailPrincipal);

        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $codigo = $Usuariovo->getCodigo();
        $emailPrincipal = $Usuariovo->getEmailPrincipal();

        $stmp->bind_param("is", $codigo, $emailPrincipal);

        $stmp->execute();
        $stmp->bind_result($contrasena);

        $respuesta = array();
        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["contrasena"] = $contrasena;
            $tmp["emailPrincipal"] = $emailPrincipal;

            $respuesta[sizeof($respuesta)] = $tmp;
        }
        if ($contrasena != NULL) {
            $this->enviar($emailPrincipal, $contrasena);
            $respuesta = $respuesta["sucess"] = "ok";
        } else {
            $respuesta = $respuesta["sucess"] = "no";
        }
        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    function Enviar($correo, $contrasena) {
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $mail->Host = 'smtp.gmail.com'; /* Specify main and backup SMTP servers */
        $mail->Port = 587;
        $mail->SMTPAuth = true; /* Enable SMTP authentication */
        $mail->Username = "biblocur@gmail.com"; /* SMTP username */
        $mail->Password = "Prueba12345"; /* SMTP password */
        $mail->SMTPSecure = 'tls';
        $mail->From = "biblocur@gmail.com";
        $mail->FromName = "Corporacion Univservistario Republicana";
        $mail->Subject = "Recuperacion de su clave";
        $mail->addAddress($correo); /* Add a recipient */
        $mail->isHTML(true); /* Set email format to HTML (default = true) */
        $mail->Body = "Su clave de acceso para la biblioteca  es: <b> " . $contrasena . " </b> <br> Se le recomienda cambiar su clave por seguridad<br><br><img src ='https://image.ibb.co/hVSO7d/Captura.jpg' width='412' height='122'/>";
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    public function Mostrar($array) {

        $sql = "SELECT codigo, `nombre`, `apellido`, `fechaNacimiento`, `sexo`, `direccion`, `telefonoPrincipal`, `emailPrincipal`,  `contrasena`  FROM tbl_usuario  WHERE `codigo`=? ";
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);
        $UsuarioVO = new UsuarioVO();
        $UsuarioVO->setCodigo($array->codigo);
        $codigo = $UsuarioVO->getCodigo();

        $stmp->bind_param("i", $codigo);
        $stmp->execute();
        $stmp->bind_result($codigo, $nombre, $apellido, $fechaNacimiento, $sexo, $direccion, $telefonoPrincipal, $emailPrincipal, $contrasen);
        $respuesta = array();
        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["codigo"] = $codigo;
            $tmp["nombre"] = $nombre;
            $tmp["apellido"] = $apellido;
            $tmp["fechaNacimiento"] = $fechaNacimiento;
            $tmp["sexo"] = $sexo;
            $tmp["direccion"] = $direccion;
            $tmp["telefonoPrincipal"] = $telefonoPrincipal;
            $tmp["emailPrincipal"] = $emailPrincipal;
            $tmp["contrasena"] = $contrasena;


            $respuesta[sizeof($respuesta)] = $tmp;
        }
        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    public function Mis_multa($array) {

        $sql = "call multaUsuario (?);";
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);
        $UsuarioVO = new UsuarioVO();
        $UsuarioVO->setCodigo($array->codigo);
        $codigo = $UsuarioVO->getCodigo();

        $stmp->bind_param("i", $codigo);
        $stmp->execute();
        $stmp->bind_result($multa);
        $respuesta = array();
        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["multa"] = $multa;
            $respuesta[sizeof($respuesta)] = $tmp;
        }
        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    public function CambioClave($array) {

        $sql = 'call cambioClaveUsuario (?,?)';

        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $UsuarioVO = new UsuarioVO();
        $UsuarioVO->setCodigo($array->codigo);
        $UsuarioVO->setContrasena($array->contrasena);

        $codigo = $UsuarioVO->getCodigo();
        $contrasena = $UsuarioVO->getContrasena();

        $stmp->bind_param("si", $contrasena, $codigo);

        $this->respuesta($conn, $stmp);
    }

    function Historial($array) {
        $sql = "SELECT `diaReserva`,`diaEntrega`,`diaPrestamo`,tbl_libro.titulo,tbl_libro.isbn,`renovacion`,`actividad`   FROM `tbl_prestamo`, tbl_libro WHERE codigo = ? and tbl_libro.isbn = tbl_prestamo.isbn";

        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $UsuarioVO = new UsuarioVO();
        $UsuarioVO->setCodigo($array->codigo);

        $codigo = $UsuarioVO->getCodigo();

        $stmp->bind_param("i", $codigo);

        $stmp->execute();
        $stmp->bind_result($Dreserva, $Dentrega, $Dprestamo, $titulo, $isbn, $renovacion, $estado);
        $respuesta = array();
        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["Dreserva"] = $Dreserva;
            $tmp["Dentrega"] = $Dentrega;
            $tmp["Dprestamo"] = $Dprestamo;
            $tmp["titulo"] = $titulo;
            $tmp["isbn"] = $isbn;
            $tmp["renovacion"] = $renovacion;
            $tmp["estado"] = $estado;

            $respuesta[sizeof($respuesta)] = $tmp;
        }

        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    function intento($array) {

        $sql = "CALL intento (?)";
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);
        $Usuariovo = new UsuarioVO();
        $Usuariovo->setCodigo($array->codigo);
        $codigo = $Usuariovo->getCodigo();
        $stmp->bind_param("i", $codigo);
        $this->respuesta($conn, $stmp);
    }

    function intentoExitoso($array) {

        $sql = "CALL intentoExitoso (?)";
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $Usuariovo = new UsuarioVO();
        $Usuariovo->setCodigo($array->codigo);
        $codigo = $Usuariovo->getCodigo();

        $stmp->bind_param("i", $codigo);
        $this->respuesta($conn, $stmp);
    }

    function Filtro($array) {

        $Usuariovo = new UsuarioVO();
        $Usuariovo->setCodigo($array->codigo);

        $sql = 'call verificacionUsuario (?)';

        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $codigo = $Usuariovo->getCodigo();
        $stmp->bind_param("i", $codigo);
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

    function SMCrearUsuario($array) {
        if ($this->Filtro($array) == "ok") {
            $respuesta = array();
            $respuesta["sucess"] = "Reguistro duplicado";
            echo json_encode($respuesta);
        } else {
            $sql = 'call insetUsuario (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);';
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

    function insert($array, $stmp) {

        $UsuarioVO = new UsuarioVO();
        $UsuarioVO->setCedula($array->cedula);
        $UsuarioVO->setCodigo($array->codigo);
        $UsuarioVO->setNombre($array->nombre);
        $UsuarioVO->setApellido($array->apellido);
        $UsuarioVO->setFechaNacimiento($array->fechaNacimiento);
        $UsuarioVO->setSexo($array->sexo);
        $UsuarioVO->setDireccion($array->direccion);
        $UsuarioVO->setTelefonoPrincipal($array->telefonoPrincipal);
        $UsuarioVO->setEmailPrincipal($array->emailPrincipal);
        $UsuarioVO->setContrasena($array->contrasena);
        $UsuarioVO->setDireccion2($array->direccion2);
        $UsuarioVO->setTelefonoSecundario($array->telefonoSecundario);
        $UsuarioVO->setTelefonoOtro($array->telefonoOtro);
        $UsuarioVO->setContactoNombre($array->contactoNombre);
        $UsuarioVO->setContactoApellido($array->contactoApellido);
        $UsuarioVO->setContactoDireccion($array->contactoDireccion);
        $UsuarioVO->setContactoDireccion2($array->contactoDireccion2);
        $UsuarioVO->setContactoTelefono($array->contactoTelefono);
        $UsuarioVO->setPerfil($array->perfil);

        $cedula = $UsuarioVO->getCedula();
        $codigo = $UsuarioVO->getCodigo();
        $nombre = $UsuarioVO->getNombre();
        $apellido = $UsuarioVO->getApellido();
        $fechaNacimiento = $UsuarioVO->getFechaNacimiento();
        $sexo = $UsuarioVO->getSexo();
        $direccion = $UsuarioVO->getDireccion();
        $direccion2 = $UsuarioVO->getDireccion2();
        $telefonoPrincipal = $UsuarioVO->getTelefonoPrincipal();
        $telefonoSecundario = $UsuarioVO->getTelefonoSecundario();
        $telefonoOtro = $UsuarioVO->getTelefonoOtro();
        $emailPrincipal = $UsuarioVO->getEmailPrincipal();
        $contactoNombre = $UsuarioVO->getContactoNombre();
        $contactoApellido = $UsuarioVO->getContactoApellido();
        $contactoDireccion = $UsuarioVO->getContactoDireccion();
        $contactoDireccion2 = $UsuarioVO->getContactoDireccion2();
        $contactoTelefono = $UsuarioVO->getContactoTelefono();
        $contrasena = $UsuarioVO->getContrasena();
        $perfil = $UsuarioVO->getPerfil();

        $stmp->bind_param("sisssisssssssssssss", $cedula, $codigo, $nombre, $apellido, $fechaNacimiento, $sexo, $direccion, $direccion2, $telefonoPrincipal, $telefonoSecundario, $telefonoOtro, $emailPrincipal, $contactoNombre, $contactoApellido, $contactoDireccion, $contactoDireccion2, $contactoTelefono, $contrasena, $perfil);

        return $stmp;
    }

}
