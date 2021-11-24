<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Residentes;

class ResidentesApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $residentes = Residentes::all();
        return json_encode(["resultado"=>"OK", "residentes"=>$residentes]);
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
        //
        $residentes= Residentes::where("cedula","=", $request->cedula)->first();
        if (!$residentes) {
            $residentes=Residentes::create($request->all());
            return json_encode(["resultado"=>"OK", "residentes"=>$residentes]);
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
        $residentes = Residentes::find($id);
        return json_encode(["resultado"=>"OK", "residentes"=>$residentes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $residentes= Residentes::find($id);
        $residentes->fill($request->all());
        $residentes->save();
        return json_encode(["resultado"=>"OK", "residentes"=>$residentes]);
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
        $residentes= Residentes::find($id);
        $residentes->delete();
        return json_encode(["resultado"=>"OK", "residentes"=>$residentes]);
    }
}
