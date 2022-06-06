<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{
    use HasFactory;
    protected $table = 'cotacao_frete';
    protected $fillable = ['uf', 'percentual_cotacao', 'valor_extra', 'transportadora_id'];

    public function rules()
    {
        return [
            'uf' => 'required',
            'percentual_cotacao' => 'required',
            'valor_extra' => 'required',
            'transportadora_id' => 'required'
        ];
    }

    public function rulesCalculo()
    {
        return [
            'uf' => 'required',
            'valor_pedido' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório'
        ];
    }

    public function isUnique($uf, $transportadora_id)
    {
        $unico = Cotacao::where('uf', $uf)->where('transportadora_id', $transportadora_id)->get();
        if(count($unico) > 0){
            return false;
        }

        return true;
    }

    public function calcular($uf, $valor_pedido)
    {
        $resultado = array();
        $percentual = Cotacao::where('uf', $uf)->get();
        foreach($percentual as $e){
            $transportadora = $e['transportadora_id'];
            $percentual = $e['percentual_cotacao'];
            $valor_extra = $e['valor_extra'];            
            $resultado[$transportadora] = $this->calcularCusto($valor_pedido, $percentual, $valor_extra);  
        }

        return $this->filtrarMelhoresValores($resultado);
    }

    private function calcularCusto($valor_pedido, $percentual, $valor_extra)
    {
        $total = ($valor_pedido * $percentual / 100) + $valor_extra;

        return $total;
    }

    private function filtrarMelhoresValores($resultado){
        $melhoresPrecos = array();
        
        
        while(count($melhoresPrecos) < 3)
        {
            $a = array();
            $melhorPreco = min($resultado);
            $indice = array_search($melhorPreco, $resultado);
            // $melhoresPrecos[$indice] = $melhorPreco;
            $a['transportadora'] = $indice;
            $a['preco'] = $melhorPreco;
            array_push($melhoresPrecos, $a);
            unset($resultado[$indice]);
        }

        return $melhoresPrecos;
    }
    
}
