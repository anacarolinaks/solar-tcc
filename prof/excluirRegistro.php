<!DOCTYPE html>
<?php
require_once("../conexao/conexao.php");
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();


//if(isset($_POST['idReserva'])){
    $codigo = $_POST['idReserva'];
         $conn= conectar();
            $sql = "DELETE FROM reserva WHERE res_cod = ?";
            $comando = $conn->prepare($sql);
            $comando->bindvalue(1,$codigo);
            $comando->execute();
            $conn = null;
  // }

