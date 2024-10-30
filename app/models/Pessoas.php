<?php

class Pessoas {

    // Obtém uma pessoa específica ou todas as pessoas
    // do banco de dados.
    public function getPessoa($sqlParameters = 1) {
        $sqlQuery = "SELECT * FROM pessoas";
            
        try {
            return Database::query($sqlQuery);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    // Adiciona uma pessoa ao banco de dados.
    public function inserirPessoa() {
        return true;
    }

    // Exclui uma pessoa do banco de dados.
    public function excluirPessoa() {
        return true;
    }

    // Atualiza o cadastro de uma pessoa no banco de dados.
    public function editarPessoa() {
        return true;
    }

    
}

?>