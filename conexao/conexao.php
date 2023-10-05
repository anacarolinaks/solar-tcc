<?php

function conectar() {

//conecta no servidor (em que servidor:porta, usuario, senha) do banco
    $servername = "localhost";
    $username = "root";
    $password = "";

try {
     $opcoes = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
);
    $conn = new PDO("mysql:host=$servername;dbname=solar", $username, $password, $opcoes);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
   

    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
conectar();
?>

