<?php

header('Access-Control-Allow-Origin: *');
require '../../CLASES/BD/MySql.php';
require '../../CLASES/BD/datosbd.php';
require '../../CLASES/VO/ComputadorVO.php';
require '../../CLASES/DAO/ComputadorDAO.php';
$json = file_get_contents("php://input");
$local = json_decode($json);
$LibroDAO = new ComputadorDAO();
$LibroDAO->EliminarComputador($local);