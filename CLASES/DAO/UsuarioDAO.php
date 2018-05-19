<?php

require("../../PHPMailer-master/src/PHPMailer.php");
require("../../PHPMailer-master/src/SMTP.php");
require("../../PHPMailer-master/src/Exception.php");

class UsuarioDAO {

    public function CrearUsuario($array) {

        $sql = 'INSERT INTO `tbl_usuario` (`codigo`, `nombre`, `apellido`, `fechaNacimiento`, `sexo`, `direccion`, `direccion2`, `telefonoPrincipal`, `telefonoSecundario`, `telefonoOtro`, `emailPrincipal`, `contactoNombre`, `contactoApellido`, `contactoDireccion`, `contactoDireccion2`, `contactoTelefono`, `contrasena`, `multa`, `perfil`, `foto`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
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
        $UsuarioVO->setFoto($array->foto);

        if (count((array) $array, COUNT_RECURSIVE) > 10) {

            $UsuarioVO->setDireccion2($array->direccion2);
            $UsuarioVO->setTelefonoSecundario($array->telefonoSecundario);
            $UsuarioVO->setTelefonoOtro($array->telefonoOtro);
            $UsuarioVO->setContactoNombre($array->contactoNombre);
            $UsuarioVO->setContactoApellido($array->contactoApellido);
            $UsuarioVO->setContactoDireccion($array->contactoDireccion);
            $UsuarioVO->setContactoDireccion2($array->contactoDireccion2);
            $UsuarioVO->setContactoTelefono($array->contactoTelefono);
            $UsuarioVO->setMulta($array->multa);
            $UsuarioVO->setPerfil($array->perfil);
        } else {

            $UsuarioVO->setDireccion2("");
            $UsuarioVO->setTelefonoSecundario("");
            $UsuarioVO->setTelefonoOtro("");
            $UsuarioVO->setContactoNombre("");
            $UsuarioVO->setContactoApellido("");
            $UsuarioVO->setContactoDireccion("");
            $UsuarioVO->setContactoDireccion2("");
            $UsuarioVO->setContactoTelefono("");
            $UsuarioVO->setMulta("");
            $UsuarioVO->setPerfil("");
        }

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
        $multa = $UsuarioVO->getMulta();
        $perfil = $UsuarioVO->getPerfil();
        $foto = $UsuarioVO->getFoto();

        $stmp->bind_param("isssbssssssssssssiss", $codigo, $nombre, $apellido, $fechaNacimiento, $sexo, $direccion, $direccion2, $telefonoPrincipal, $telefonoSecundario, $telefonoOtro, $emailPrincipal, $contactoNombre, $contactoApellido, $contactoDireccion, $contactoDireccion2, $contactoTelefono, $contrasena, $multa, $perfil, $foto);

        $this->respuesta($conn, $stmp);
    }

    function ActualizarUsuario($array) {

        $UsuarioVO = new UsuarioVO();
        $UsuarioVO->setCodigo($array->codigo);
        $UsuarioVO->setNombre($array->nombre);
        $UsuarioVO->setApellido($array->apellido);
        $UsuarioVO->setFechaNacimiento($array->fechaNacimiento);
        $UsuarioVO->setSexo($array->sexo);
        $UsuarioVO->setDireccion($array->direccion);
        $UsuarioVO->setDireccion2($array->direccion2);
        $UsuarioVO->setTelefonoPrincipal($array->telefonoPrincipal);
        $UsuarioVO->setTelefonoSecundario($array->telefonoSecundario);
        $UsuarioVO->setTelefonoOtro($array->telefonoOtro);
        $UsuarioVO->setEmailPrincipal($array->emailPrincipal);
        $UsuarioVO->setContactoNombre($array->contactoNombre);
        $UsuarioVO->setContactoApellido($array->contactoApellido);
        $UsuarioVO->setContactoDireccion($array->contactoDireccion);
        $UsuarioVO->setContactoDireccion2($array->contactoDireccion2);
        $UsuarioVO->setContactoTelefono($array->contactoTelefono);
        $UsuarioVO->setContrasena($array->contrasena);
        $UsuarioVO->setFoto($array->foto);

        $sql = 'UPDATE `tbl_usuario` SET `nombre`=?,`apellido`=?,`fechaNacimiento`=?,`sexo`=?,`direccion`=?,`direccion2`=?,`telefonoPrincipal`=?,`telefonoSecundario`=?,`telefonoOtro`=?,`emailPrincipal`=?,`contactoNombre`=?,`contactoApellido`=?,`contactoDireccion`=?,`contactoDireccion2`=?,`contactoTelefono`=?,`contrasena`=? ,foto =?WHERE `codigo`=?;';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

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
        $foto = $UsuarioVO->getFoto();

        $stmp->bind_param("sssssssssssssssssi", $codigo, $nombre, $apellido, $fechaNacimiento, $sexo, $direccion, $direccion2, $telefonoPrincipal, $telefonoSecundario, $telefonoOtro, $emailPrincipal, $contactoNombre, $contactoApellido, $contactoDireccion, $contactoDireccion2, $contactoTelefono, $contrasena, $foto);
        $this->respuesta($conn, $stmp);
    }

    function elminarUsuario($array) {
        $Usuariovo = new UsuarioVO();
        $Usuariovo->setCodigo($array->Codigo);

        $sql = 'DELETE FROM `tbl_usuario` WHERE `codigo`=?';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);
        $codigo = $Usuariovo->getCodigo();
        $stmp->bind_param("i", $codigo);

        $this->respuesta($conn, $stmp);
    }

    public function Login($array) {

        $sql = 'SELECT codigo,nombre , foto, perfil  FROM `tbl_usuario`  WHERE `codigo`= ?  and `contrasena` like binary ? ;';

        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);
        $UsuarioVO = new UsuarioVO();
        $UsuarioVO->setCodigo($array->codigo);
        $UsuarioVO->setContrasena($array->contrasena);

        $codigo = $UsuarioVO->getCodigo();
        $contrasena = $UsuarioVO->getContrasena();

        $stmp->bind_param("is", $codigo, $contrasena);

        $stmp->execute();
        $stmp->bind_result($codigo, $nombre, $foto, $perfil);
        $respuesta = array();
        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["codigo"] = $codigo;
            $tmp["nombre"] = $nombre;
            $tmp["foto"] = $foto;
            $tmp["perfil"] = $perfil;

            $respuesta[sizeof($respuesta)] = $tmp;
        }

        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    function correo($array) {
        $Usuariovo = new UsuarioVO();
        $Usuariovo->setCodigo($array->Codigo);
        $Usuariovo->setEmailPrincipal($array->emailPrincipal);

        $sql = 'SELECT `emailPrincipal`,`contrasena` FROM `tbl_usuario` WHERE `codigo`= ? and `emailPrincipal` =  ?;';
        $BD = new ConectarBD();
        $conn = $BD->getMysqli();
        $stmp = $conn->prepare($sql);

        $codigo = $Usuariovo->getCodigo();
        $emailPrincipal = $Usuariovo->getEmailPrincipal();

        $stmp->bind_param("is", $codigo, $emailPrincipal);
        $this->respuesta($conn, $stmp);

        while ($stmp->fetch()) {
            $tmp = array();
            $tmp["emailPrincipal"] = $codigo;
            $tmp["contrasena"] = $contrasena;
            $respuesta[sizeof($respuesta)] = $tmp;
        }

        enviar($codigo, $contrasena);
        if ($stmp->execute() == 1) {
            $respuesta["sucess"] = "ok";
        } else {
            $respuesta["sucess"] = "no";
        }

        $stmp->close();
        $conn->close();
        echo json_encode($respuesta);
    }

    function enviar($correo, $contrasena) {
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        $mail->Host = 'smtp.gmail.com'; /* Specify main and backup SMTP servers */
        $mail->Port = 587;
        $mail->SMTPAuth = true; /* Enable SMTP authentication */
        $mail->Username = "biblocur@gmail.com"; /* SMTP username */
        $mail->Password = "Prueba12345"; /* SMTP password */
        $mail->SMTPSecure = 'tls';
        $mail->From = "biblocur@gmail.com";
        $mail->FromName = "esteban";
        $mail->addAddress($correo); /* Add a recipient */
        $mail->isHTML(true); /* Set email format to HTML (default = true) */
        $mail->Body = "Su contraseña es " . $contrasena;
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "funciono";
        }
    }

    function respuesta($conn, $stmp) {
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