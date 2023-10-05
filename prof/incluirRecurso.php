<?php
//Verificar se foi com post
//verificar se esta logado
session_start();
$usuario = $_SESSION["usuario"];
$data = $_POST["data"];
$recurso= $_POST["recurso"];
$horario= $_POST["horario"];


require_once "../conexao/conexao.php";
    $conn = conectar();
    $sql = "INSERT INTO reserva(usu_cod, res_data, rec_cod, res_horario) VALUES (?,?,?,?)";
    $comando = $conn->prepare($sql);
    $comando->bindvalue(1,$usuario);
    $comando->bindvalue(2,$data);
    $comando->bindvalue(3,$recurso);
    $comando->bindvalue(4,$horario);
    $comando->execute();
$conn = null;









?>