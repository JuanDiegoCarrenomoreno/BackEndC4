<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Curso;

class CursoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cursos = Curso::all();
        return json_encode(["resultado"=>"OK", "cursos"=>$cursos]);
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
        $curso= Curso::where("codigo","=", $request->codigo)->first();
        if (!$curso) {
            $curso=Curso::create($request->all());
            return json_encode(["resultado"=>"OK", "curso"=>$curso]);
        } else {
            return json_encode(["resultado"=>"Error", "mensaje"=>"codigo ya existente"]);  
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
        $curso = Curso::find($id);
        return json_encode(["resultado"=>"OK", "curso"=>$curso]);
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
        $curso= Curso::find($id);
        $curso->fill($request->all());
        $curso->save();
        return json_encode(["resultado"=>"OK", "curso"=>$curso]);
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
        $curso= Curso::find($id);
        $curso->delete();
        return json_encode(["resultado"=>"OK", "curso"=>$curso]);
    }
}
