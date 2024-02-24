<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->input();
        $input["password"] = Hash::make(trim($request->password));
        $e = User::create($input);
        return response()->json([
            'data'=>$e,
            'mensaje'=>"Registrado con éxito.",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $e = User::find($id);
        if (isset($e)) {
            return response()->json([
                'data'=>$e,
                'mensaje'=>"usuario encontrado con éxito.",
            ]);
        }else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No se encontro el usuario",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $e = User::find($id);
        if(isset($e)){
            $e->name = $request->name;
            $e->email = $request->email;
            $e->password= Hash::make($request->password);
            if ($e->save()) {
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Actualizados con éxito.",
                ]);
            }else {
                return response()->json([
                    'error'=>true,
                    'mensaje'=>"No se actualizo ",
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
        $e = User::find($id);
        if (isset($e)) {
            $res = User::destroy($id);
            if ($res) {
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>" eliminado con éxito.",
                ]);
            }else {
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>" no éxite.",
                ]);    
            }
            
        }else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No se encontro el usuario",
            ]);
        }
    }
}
