<?php

namespace App\Http\Controllers;

use App\Models\Cotacao;
use Illuminate\Http\Request;

class CotacaoController extends Controller
{
    public function __construct(Cotacao $cotacao)
    {
        $this->cotacao = $cotacao;   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->cotacao->rules(), $this->cotacao->feedback());
        
        if($this->cotacao->isUnique($request->uf, $request->transportadora_id)){
            $cotacao = $this->cotacao->create($request->all());
            return $cotacao;
        }else{
            return response()->json(['erro' => 'Registro duplicado'], 409);
        }
        
        
    }
    
    public function show()
    {
        return $this->cotacao->all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cotacao  $cotacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotacao $cotacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cotacao  $cotacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotacao $cotacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculo(Request $request)
    {
        if(count($this->cotacao->where('uf', $request->uf)->get()) > 0){
            $request->validate($this->cotacao->rulesCalculo(), $this->cotacao->feedback());
            $resultado = $this->cotacao->calcular($request->uf, $request->valor_pedido);
            return $resultado;
        }else{
            return response()->json(['erro' => 'Cotação não cadastrada no UF'], 500);
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cotacao  $cotacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotacao $cotacao)
    {
        //
    }
}
