<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Evento;

class EventoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $eventos = Evento::all();
        return json_encode(["resultado"=>"OK", "eventos"=>$eventos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $evento= Evento::where("nombre","=", $request->nombre)->first();
        if (!$evento) {
            $evento=Evento::create($request->all());
            return json_encode(["resultado"=>"OK", "evento"=>$evento]);
        } else {
            return json_encode(["resultado"=>"Error", "mensaje"=>"evento ya existente"]);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $evento = Evento::find($id);
        return json_encode(["resultado"=>"OK", "evento"=>$evento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $evento= Evento::find($id);
        $evento->fill($request->all());
        $evento->save();
        return json_encode(["resultado"=>"OK", "evento"=>$evento]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $evento= Evento::find($id);
        $evento->delete();
        return json_encode(["resultado"=>"OK", "evento"=>$evento]);
    }
}
