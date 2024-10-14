<?php
    include("../app/db/database.php");
    include ("../app/model/Categoria.php");
    include("../app/model/Veiculo.php");
    include("../app/controller/EntradaSaidaController.php");
?>

    <!doctype html>
    <html lang="br">
    <style>
        table, th, td {
            border:1px solid black;
        }
        td {
            padding-left: 20px;
        }
    </style>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Estacionamento</title>
    </head>
    <body>
    <h1> Sistema de Estacionamento</h1> <hr>
    <?php
        $sql = "SELECT veiculos.id, veiculos.placa_veiculo, categorias.nome_categoria, categorias.valor_taxa_estacionamento, veiculos.hora_entrada, veiculos.hora_saida FROM veiculos JOIN categorias ON veiculos.id_categoria = categorias.id";
        $resultado = mysqli_query($connection, $sql);
        $controller = new EntradaSaidaController();

        if(mysqli_num_rows($resultado) > 0) {
            while($coluna = mysqli_fetch_assoc($resultado)) {
                $categoria = new Categoria($coluna["nome_categoria"], $coluna["valor_taxa_estacionamento"]);
                $veiculo = new Veiculo($coluna["placa_veiculo"], $categoria);
                $veiculo->setId($coluna["id"]);
                echo
                    '<table style="width:100%">
                        <tr>
                            <th style="width:30%">Placa do Veículo:</th>
                            <td>'.$veiculo->getPlacaVeiculo().'</td>
                        </tr>
                        <tr>
                            <th>Nome da Categoria:</th>
                            <td>'.$veiculo->getCategoria()->getNomeCategoria().'</td>
                        </tr>
                        <tr>
                            <th>Valor da Taxa:</th>
                            <td>R$'.$veiculo->getCategoria()->getValorTaxaEstacionamento().'</td>
                        </tr>
                        <tr>
                            <th>Tempo de Permanência:</th>
                            <td>'.$controller->getTempoPermanencia($connection, $veiculo->getId()).'</td>
                        </tr> <br>
                    </table>
                    
                    <form method="post" action="index.php">
                    <input type="hidden" name="idVeiculo" value="'.$veiculo->getId().'">
                    <input type="submit" name="registrarEntrada" value="Entrar">
                    <input type="submit" name="registrarSaida" value="Sair"> <hr>
                    </form>';
            }
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST["registrarEntrada"])) {
                    $controller->registrarEntrada($connection, $_POST["idVeiculo"]);
                } elseif(isset($_POST["registrarSaida"])) {
                    echo $controller->registrarSaida($connection, $_POST["idVeiculo"]);
                }
            }
        }
    ?>
        <br><a href="categorias.php">Cadastrar Nova Categoria</a>
        <br><a href="veiculos.php">Cadastrar Novo Veículo</a>
    </body>
    </html>

<?php
    mysqli_close($connection);
?>