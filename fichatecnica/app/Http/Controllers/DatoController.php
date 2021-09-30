<?php

namespace App\Http\Controllers;

use App\Models\Dato;
use Illuminate\Http\Request;

class DatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return dato::all();
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
        return dato::Create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function show(Dato $dato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function edit(Dato $dato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dato $dato)
    {
        return $dato->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dato  $dato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dato $dato)
    {
        $dato->delete();
    }
}
