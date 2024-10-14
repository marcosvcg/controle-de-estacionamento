<?php
class EntradaSaidaController {
    public function registrarEntrada($connection, $id) {
        $sql = "SELECT * FROM veiculos WHERE id = $id AND hora_entrada IS NOT NULL AND hora_saida IS NULL";
        $resultado = mysqli_query($connection, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            echo "Este veículo já registrou uma entrada sem saída.";
        } else {
            $sql = "UPDATE veiculos SET 
                    tempo_permanencia = NULL,
                    hora_entrada = CURRENT_TIMESTAMP, hora_saida = NULL WHERE id = $id";
            mysqli_query($connection, $sql);
            echo "Entrada registrada.";
        }
    }

    public function registrarSaida($connection, $id) {
        $sql = "SELECT hora_entrada FROM veiculos WHERE id = $id";
        $resultado = mysqli_query($connection, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $coluna = mysqli_fetch_assoc($resultado);
            $hora_entrada = $coluna['hora_entrada'];
            if ($hora_entrada) {
                mysqli_query($connection,
                    "UPDATE veiculos SET 
                        tempo_permanencia = TIMEDIFF(CURRENT_TIMESTAMP, '$hora_entrada'), 
                        hora_saida = CURRENT_TIMESTAMP, 
                        hora_entrada = NULL WHERE id = $id");
                echo "Saída registrada.";
            } else {
                echo "Este veículo não registrou uma entrada.";
            }
        }
    }

    public function getTempoPermanencia($connection, $id) {
        $sql = "SELECT TIME_FORMAT(tempo_permanencia, '%H:%i:%s') AS tempo_permanencia_horasMinutosSegundos FROM veiculos WHERE id = $id";
        $resultado = mysqli_query($connection, $sql);
        $coluna = mysqli_fetch_assoc($resultado);

            if (mysqli_num_rows($resultado) > 0) {
                $tempoPermanencia = $coluna["tempo_permanencia_horasMinutosSegundos"];
                return $tempoPermanencia;
            } else {
                return "O veículo não registrou entrada e saída.";
            }
        }
    }