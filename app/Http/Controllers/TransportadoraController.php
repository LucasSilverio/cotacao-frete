<?php

namespace App\Http\Controllers;

use App\Models\Transportadora;
use Illuminate\Http\Request;

class TransportadoraController extends Controller
{
    public function __construct(Transportadora $transportadora)
    {
        $this->transportadora = $transportadora;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->transportadora->all();
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
        $transportadora = $this->transportadora->create($request->all());
        return $transportadora;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transportadora  $transportadora
     * @return \Illuminate\Http\Response
     */
    public function show(Transportadora $transportadora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transportadora  $transportadora
     * @return \Illuminate\Http\Response
     */
    public function edit(Transportadora $transportadora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transportadora  $transportadora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transportadora $transportadora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transportadora  $transportadora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transportadora $transportadora)
    {
        //
    }
}
