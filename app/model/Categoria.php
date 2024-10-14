<?php
    class Categoria {
        public $id;
        public $nomeCategoria;
        public $valorTaxaEstacionamento;

        public function __construct($nomeCategoria, $valorTaxaEstacionamento) {
            $this->nomeCategoria = $nomeCategoria;
            $this->valorTaxaEstacionamento = $valorTaxaEstacionamento;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id): void {
            $this->id = $id;
        }

        public function getNomeCategoria() {
            return $this->nomeCategoria;
        }

        public function setNomeCategoria($nomeCategoria): void {
            $this->nomeCategoria = $nomeCategoria;
        }

        public function getValorTaxaEstacionamento() {
            return number_format($this->valorTaxaEstacionamento, 2, ',');
        }

        public function setValorTaxaEstacionamento($valorTaxaEstacionamento): void {
            $this->valorTaxaEstacionamento = $valorTaxaEstacionamento;
        }
    }