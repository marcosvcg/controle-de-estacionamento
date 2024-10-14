<?php
    include("../app/db/database.php");
    include("../app/model/Veiculo.php");
    include("../app/model/Categoria.php");
?>

<!doctype html>
<html lang="br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar</title>
</head>
<body>
    <h1>Cadastro de Veículos<br></h1>
    <form action="veiculos.php" method="post">
        <label for="placaVeiculo">Placa do Veículo:</label><br>
        <input type="text" id="placaVeiculo" name="placaVeiculo"><br>
        <label for="idCategoria">Categorias:</label><br>

        <?php
        $sql = "SELECT * FROM categorias";
        $resultado = mysqli_query($connection, $sql);

        if(mysqli_num_rows($resultado) > 0) {
            while($coluna = mysqli_fetch_assoc($resultado)) {
                echo '<input type="radio" name="idCategoria" value='.$coluna["id"].'>' . $coluna["nome_categoria"] . '<br>';
            }
        }
        ?>

        <input type="submit" id="cadastrarVeiculo" name="cadastrarVeiculo" value="Cadastrar">
    </form>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $placaVeiculo = $_POST["placaVeiculo"];

        if(isset($_POST["idCategoria"])) {
            $idCategoria = $_POST["idCategoria"];
        }

        if(isset($placaVeiculo)) {
            $placaVeiculo = filter_input(INPUT_POST, 'placaVeiculo', FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if(!empty($placaVeiculo) && !empty($idCategoria)) {
            $sql = "INSERT INTO veiculos (placa_veiculo, id_categoria) VALUES ('$placaVeiculo', '$idCategoria')";
            try {
                if(strlen($placaVeiculo) != 7) {
                    echo "Registre uma placa válida.";
                } else {
                    mysqli_query($connection, $sql);
                    echo "Veículo cadastrado com sucesso!";
                }
            } catch (mysqli_sql_exception) {
                echo "Não foi possível cadastrar o veículo.";
            }
        } else {
            echo "Preencha todos os campos necessários.";
        }

        mysqli_close($connection);
    }
    ?>
    <hr><a href="index.php">Voltar para a tela principal</a>
</body>
</html>