<?php

namespace Services;

use Models\{Veiculo, Carro, Moto};

class Locadora
{
    private array $veiculos = [];

    public function __construct()
    {
        $this->carregarVeiculos();
    }

    private function carregarVeiculos(): void
    {
        if (file_exists(ARQUIVO_JSON)) {
            // decodifica o arquivo JSON
            $dados = json_decode(file_get_contents(ARQUIVO_JSON), true);
            
            // percorre o array de veículos e cria os objetos correspondentes
            foreach ($dados as $dado) {
                if ($dado['tipo'] == 'Carro') {
                    $veiculo = new Carro($dado['modelo'], $dado['placa']);
                } else {
                    $veiculo = new Moto($dado['modelo'], $dado['placa']);
                }
                $veiculo->setDisponivel($dado['disponivel']);
                $this->veiculos[] = $veiculo;
            }
        }
    }

    // Salvar veículos
    private function salvarVeiculos(): void
    {
        $dados = [];

        foreach ($this->veiculos as $veiculo) {
            $dados[] = [
                'tipo' => ($veiculo instanceof Carro) ? 'Carro' : 'Moto',
                'modelo' => $veiculo->getModelo(),
                'placa' => $veiculo->getPlaca(),
                'disponivel' => $veiculo->isDisponivel()
            ];
        }

        $dir = dirname(ARQUIVO_JSON);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents(ARQUIVO_JSON, json_encode($dados, JSON_PRETTY_PRINT));
    }

    // Adicionar novo veículo
    public function adicionarVeiculo(Veiculo $veiculo): void
    {
        $this->veiculos[] = $veiculo;
        $this->salvarVeiculos();
    }

    // Remover veículo
    public function removerVeiculo(Veiculo $veiculo): string
    {
        foreach ($this->veiculos as $key => $v) {
            if ($v->getModelo() === $veiculo->getModelo() && $v->getPlaca() === $veiculo->getPlaca()) {
                unset($this->veiculos[$key]);
                $this->veiculos = array_values($this->veiculos);
                $this->salvarVeiculos();
                return "Veiculo '{$veiculo->getModelo()}' removido com sucesso!";
            }
        }
        return "Veiculo não encontrado!";
    }

    // Alugar veículo por n dias
    public function alugarVeiculo(string $modelo, int $dias = 1): string
    {
        foreach ($this->veiculos as $veiculo) {
            if ($veiculo->getModelo() === $modelo && $veiculo->isDisponivel()) {
                $valorAluguel = $veiculo->calcularAluguel($dias);
                $mensagem = $veiculo->alugar();
                $this->salvarVeiculos();
                return $mensagem . " Valor do aluguel: R$" . number_format($valorAluguel, 2, ',', '.');
            }
        }
        return "Veiculo não disponível";
    }

    // Devolver o veículo
    public function devolverVeiculo(Veiculo $veiculo): string
    {
        foreach ($this->veiculos as $v) {
            if ($v->getModelo() === $veiculo->getModelo() && !$v->isDisponivel()) {
                $mensagem = $v->devolver();
                $this->salvarVeiculos();
                return $mensagem;
            }
        }
        return "Veiculo já disponível ou não encontrado.";
    }

    // Retorna a lista de veículos
    public function listarVeiculos(): array
    {
        return $this->veiculos;
    }

    // Calcular previsão do valor 
    public function calcularValorAluguel(string $modelo, int $dias): string
    {
        foreach ($this->veiculos as $veiculo) {
            if ($tipo === 'Carro'){
                return (new Carro('',''))->calcularAluguel($dias);
            }
            return (new Moto('',''))->calcularAluguel($dias);
        }
       
    }


}
