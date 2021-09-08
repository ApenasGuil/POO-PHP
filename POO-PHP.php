<?php
/*
// ASSOCIAÇÃO ENTRE OBJETOS

class Fabricante{
    private $nome;

    public function __construct($nome){
        $this->nome = $nome;
    }

    public function getNome(){
        return $this->nome;
    }
}

class Produto{
    private $descricao; //public=acessado de qualquer lugar, private=dentro da classe, protected=dentro da classe ou classes que herdaram
    private $preco;
    private $fabricante;

    public function __construct($descricao, $preco, Fabricante $fabricante){ //__construct é chamado SEMPRE que o objeto é criado
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->fabricante = $fabricante;
    }

    public function getDetalhes(){
        return "O produto {$this->descricao} custa {$this->preco} reais. Fabricante: {$this->fabricante->getNome()}";
    }

    // public function setDescricao($valor){
    //     $this->descricao = $valor;
    // }

    // public function setPreco($valor){
    //     $this->preco = $valor;
    // }

    // public function getDescricao(){
    //     return $this->descricao;
    // }

    // public function getPreco(){
    //     return $this->preco;
    // }
}

$f1 = new Fabricante('Editora B');
$p1 = new Produto('Livro', 50, $f1);
// $p1->setDescricao('Livro');
// $p1->setPreco(50);

// var_dump($p1);
echo $p1->getDetalhes();
*/

// HERANÇA
abstract class Conta{ //"abstract" transforma a classe em abstrata, não tornando possivel o instanciamento da mesma, "final" impede a extensão desta classe
    protected $agencia;
    protected $conta;
    protected $saldo;

    public function __construct($agencia, $conta, $saldo){
        $this->agencia = $agencia;
        $this->conta = $conta;
        $this->saldo = $saldo;
    }

    public function getDetalhes(){
        return "Agencia: {$this->agencia} | Conta: {$this->conta} | Saldo: {$this->saldo}<br/>";
    }

    public function depositar($valor){
        $this->saldo += $valor;
        echo "Depósito de: {$valor} | Saldo atual: {$this->saldo}<br/>";
    }

    //métodos abstract forçam todos os filhos a terem obrigatóriamente este método em seu corpo
}

final class Poupanca extends Conta{ //classe "Poupanca" começa tendo tudo da Conta
    public function saque($valor){
        if($this->saldo >= $valor):
            $this->saldo -= $valor;
            echo "Saque de {$valor} | Saldo atual: {$this->saldo}<br/>";
        else:
            echo "Saque não autorizado | Saldo atual: {$this->saldo}<br/>";
        endif;
    }
}

final class Corrente extends Conta{ //classe "Corrente" começa tendo tudo da Conta
    protected $limite;
    
    public function __construct($agencia, $conta, $saldo, $limite){
        parent::__construct($agencia, $conta, $saldo); //Chamando o construct da classe pai "Conta"
        $this->limite = $limite;
    }

    public function saque($valor){
        if(($this->saldo + $this->limite) >= $valor):
            $this->saldo -= $valor;
            echo "Saque de {$valor} | Saldo atual: {$this->saldo}<br/>";
        else:
            echo "Saque não autorizado | Saldo atual: {$this->saldo} | Limite: {$this->limite}<br/>";
        endif;
    }
}

$c1 = new Corrente(100, 2586, 5000, 500);
$c1->depositar(1800);
$c1->saque(2500);
$c1->saque(4500);

echo $c1->getDetalhes();

/* 
// MÉTODOS MÁGICOS
class Pessoa {
    private $nome;
      private $sobrenome;
 
      public function __set($atrib, $value){
          $this->$atrib = $value;
      }
 
      public function __get($atrib){
          return $this->$atrib;
      }
}
$p1 = new Pessoa;
$p1->nome = 'Guilherme';
$p1->sobrenome = 'Moraes';
echo 'Nome: ' . $p1->nome . ' ' . $p1->sobrenome;
*/