<?php
require_once("modelo/Jogo.php");
require_once("util/Conexao.php");

class JogoDao
{
    public function inserir(Jogo $jogo)
    {
        $SQL = "INSERT INTO jogos (nome, genero, plataforma, ano_lancamento, desenvolvedora)
                VALUES (?, ?, ?, ?, ?)";

        $conn = Conexao::getConexao();
        $stmt = $conn->prepare($SQL);

        $stmt->execute(array(
            $jogo->getNome(),
            $jogo->getGenero(),
            $jogo->getPlataforma(),
            $jogo->getAnoLancamento(),
            $jogo->getDesenvolvedora()
        ));
    }

    public function listar()
    {
        $SQL = "SELECT * FROM jogos";
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare($SQL);
        $stmt->execute();

        $dados = $stmt->fetchAll();
        $jogos = $this->map($dados);

        return $jogos;
    }

    public function buscarPorId(int $idJogo)
    {
        $SQL = "SELECT * FROM jogos WHERE id = ?";
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare($SQL);
        $stmt->execute(array($idJogo));

        $dados = $stmt->fetchAll();
        $jogos = $this->map($dados);

        if (!empty($jogos)) {
            return $jogos[0];
        }

        return null;
    }

    private function map($dados)
    {
        $jogos = array();

        foreach ($dados as $d) {
            $jogo = new Jogo(
                $d["nome"],
                $d["genero"],
                $d["plataforma"],
                $d["ano_lancamento"],
                $d["desenvolvedora"],
                $d["id"]
            );

            array_push($jogos, $jogo);
        }

        return $jogos;
    }

    public function excluir(int $idJogo)
    {
        $SQL = "DELETE FROM jogos WHERE id = ?";
        $conn = Conexao::getConexao();
        $stmt = $conn->prepare($SQL);
        $stmt->execute(array($idJogo));
    }
}