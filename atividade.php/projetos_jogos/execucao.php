<?php

require_once("modelo/Jogo.php");
require_once("dao/Jogodao.php");
require_once("util/Conexao.php");

do {
    echo "\n\n----CADASTRO DE JOGOS----\n";
    echo "1- Cadastrar Jogo\n";
    echo "2- Listar Jogos\n";
    echo "3- Buscar Jogo por ID\n";
    echo "4- Excluir Jogo\n";
    echo "0- Sair\n";

    $opcao = readline("\nInforme a opção: ");

    switch ($opcao) {

        case 1:
            // CADASTRAR
            $nome = readline("Informe o Nome do Jogo: ");
            $genero = readline("Informe o Gênero: ");
            $plataforma = readline("Informe a Plataforma: ");
            $ano = readline("Informe o Ano de Lançamento: ");
            $dev = readline("Informe a Desenvolvedora: ");

            $jogo = new Jogo($nome, $genero, $plataforma, $ano, $dev);

            $dao = new JogoDao();
            $dao->inserir($jogo);

            echo "Jogo inserido com sucesso!\n";
            break;

        case 2:
            // LISTAR
            $dao = new JogoDao();
            $jogos = $dao->listar();

            echo "\n--- LISTA DE JOGOS ---\n";

            foreach ($jogos as $j) {
                echo "ID: {$j->getId()} | {$j->getNome()} | {$j->getGenero()} | {$j->getPlataforma()} | {$j->getAnoLancamento()} | {$j->getDesenvolvedora()}\n";
            }
            break;
        case 3:
            // BUSCAR POR ID
            $id = readline("Informe o ID do jogo: ");

            $dao = new JogoDao();
            $jogo = $dao->buscarPorId($id);

            if ($jogo != null) {
                echo "\n--- JOGO ENCONTRADO ---\n";
                echo "ID: {$jogo->getId()}\n";
                echo "Nome: {$jogo->getNome()}\n";
                echo "Gênero: {$jogo->getGenero()}\n";
                echo "Plataforma: {$jogo->getPlataforma()}\n";
                echo "Ano: {$jogo->getAnoLancamento()}\n";
                echo "Desenvolvedora: {$jogo->getDesenvolvedora()}\n";
            } else {
                echo "Jogo não encontrado!\n";
            }
            break;
        case 4:
            // EXCLUIR
            $dao = new JogoDao();

            $id = readline("Informe o ID do jogo a ser excluído: ");

            $jogo = $dao->buscarPorId($id);

            if ($jogo != null) {
                $dao->excluir($id);
                echo "Jogo excluído com sucesso!\n";
            } else {
                echo "Jogo não encontrado!\n";
            }
            break;

        case 0:
            echo "Programa encerrado!\n";
            break;

        default:
            echo "Opção inválida!\n";
    }
} while ($opcao != 0);
