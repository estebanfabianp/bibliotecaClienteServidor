<?php


header('Access-Control-Allow-Origin: *');
require '../../CLASES/BD/MySql.php';
require '../../CLASES/BD/datosbd.php';
require '../../CLASES/VO/PrestamoVO.php';
require '../../CLASES/DAO/PrestamoDAO.php';


$json= file_get_contents("php://input");
$local= json_decode($json);
print_r($local);
$PrestamoDAO=new PrestamoDAO();
$PrestamoDAO->reservar_libro($local);