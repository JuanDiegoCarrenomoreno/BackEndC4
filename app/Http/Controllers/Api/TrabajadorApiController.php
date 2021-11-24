<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Trabajador;

class TrabajadorApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trabajadores = Trabajador::all();
        return json_encode(["resultado"=>"OK", "trabajadores"=>$trabajadores]);
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
        $trabajador= Trabajador::where("cedula","=", $request->cedula)->first();
        if (!$trabajador) {
            $trabajador=Trabajador::create($request->all());
            return json_encode(["resultado"=>"OK", "trabajador"=>$trabajador]);
        } else {
            return json_encode(["resultado"=>"Error", "mensaje"=>"cedula ya existente"]);  
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
        $trabajador = Trabajador::find($id);
        return json_encode(["resultado"=>"OK", "trabajador"=>$trabajador]);
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
        $trabajador= Trabajador::find($id);
        $trabajador->fill($request->all());
        $trabajador->save();
        return json_encode(["resultado"=>"OK", "trabajador"=>$trabajador]);
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
        $trabajador= Trabajador::find($id);
        $trabajador->delete();
        return json_encode(["resultado"=>"OK", "trabajador"=>$trabajador]);
    }
}
