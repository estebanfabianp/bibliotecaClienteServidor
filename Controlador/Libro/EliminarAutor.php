<?php

header('Access-Control-Allow-Origin: *');
require '../../CLASES/BD/MySql.php';
require '../../CLASES/BD/datosbd.php';
require '../../CLASES/VO/AutorVO.php';
require '../../CLASES/DAO/AutorDAO.php';
$json = file_get_contents("php://input");
$local = json_decode($json);
$AutorDao = new AutorDao();
$AutorDao->EliminarAutor($local);