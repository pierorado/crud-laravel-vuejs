<?php

namespace App\Http\Controllers;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Estudiante::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->input();
        $respuesta = Estudiante::create($input);
        return $respuesta;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){
            $e->nombre = $request->nombre;
            $e->apellido = $request->apellido;
            $e->foto = $request->foto;
            if ($e->save()) {
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Estudiantes actualizados con éxito.",
                ]);
            }else {
                return response()->json([
                    'error'=>true,
                    'mensaje'=>"No se actualizo estudiantes",
                ]);
            }
        }else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe estudiantes",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
