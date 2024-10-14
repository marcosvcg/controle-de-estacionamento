<?php
$database_server = "localhost";
$database_user = "root";
$database_password = "";
$database_name = "estacionamento";
$connection = "";


try {
    $connection = mysqli_connect($database_server,
        $database_user,
        $database_password,
        $database_name);
    } catch(mysqli_sql_exception) {
    echo "Não foi possível conectar ao banco de dados.<br>";
}
?>