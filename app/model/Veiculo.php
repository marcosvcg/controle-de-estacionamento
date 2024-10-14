<?php

    class Veiculo {
        public $id;
        public $placaVeiculo;
        public $categoria;

        public function __construct($placaVeiculo, $categoria) {
            $this->placaVeiculo = $placaVeiculo;
            $this->categoria = $categoria;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id): void {
            $this->id = $id;
        }

        public function getPlacaVeiculo() {
            return $this->placaVeiculo;
        }

        public function setPlacaVeiculo($placaVeiculo): void {
            $this->placaVeiculo = $placaVeiculo;
        }

        public function getCategoria() {
            return $this->categoria;
        }

        public function setCategoria($categoria): void {
            $this->categoria = $categoria;
        }
    }
?>