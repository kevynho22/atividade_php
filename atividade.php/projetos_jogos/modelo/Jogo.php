<?php
class Jogo {
    private $id;
    private $nome;
    private $genero;
    private $plataforma;
    private $anoLancamento;
    private $desenvolvedora;
public function __toString() {
    return "ID: $this->id | Nome: $this->nome | Gênero: $this->genero | Plataforma: $this->plataforma | Ano: $this->anoLancamento | Dev: $this->desenvolvedora";
}
    public function __construct($nome, $genero, $plataforma, $ano, $desenvolvedora, $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->genero = $genero;
        $this->plataforma = $plataforma;
        $this->anoLancamento = $ano;
        $this->desenvolvedora = $desenvolvedora;
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getGenero() { return $this->genero; }
    public function getPlataforma() { return $this->plataforma; }
    public function getAnoLancamento() { return $this->anoLancamento; }
    public function getDesenvolvedora() { return $this->desenvolvedora; }
}