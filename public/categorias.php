<?php
    include("../app/db/database.php");
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
    <h1>Cadastro de Categorias de Veículos<br></h1>
    <form action="categorias.php" method="post">
        <label for="nomeCategoria">Categoria:</label><br>
        <input type="text" id="nomeCategoria" name="nomeCategoria"><br>
        <label for="valorCategoria">Valor da Taxa:</label><br>
        <input type="number" id="valorCategoria" name="valorCategoria" step="any"><br>
        <input type="submit" id="cadastrarCategoria" name="cadastrarCategoria" value="Cadastrar">
    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $nomeCategoria = filter_var($_POST["nomeCategoria"], FILTER_SANITIZE_SPECIAL_CHARS);
        $valorCategoria = filter_var($_POST["valorCategoria"], FILTER_SANITIZE_SPECIAL_CHARS);

        if(!empty($nomeCategoria) || !empty($valorCategoria)) {
            $categoria = new Categoria($nomeCategoria, $valorCategoria);
            $sql = "INSERT INTO categorias (nome_categoria, valor_taxa_estacionamento) VALUES ('$nomeCategoria', '$valorCategoria')";
            try {
                mysqli_query($connection, $sql);
                echo "Categoria cadastrada com sucesso!";
            } catch (mysqli_sql_exception) {
                echo "Não foi possível cadastrar essa categoria.";
            }
        } else {
            echo "<br>Preencha todos os campos para o cadastro.<br>";
        }

        mysqli_close($connection);
    }
    ?>
    <hr><a href="index.php">Voltar para a tela principal</a>
</body>
</html>


