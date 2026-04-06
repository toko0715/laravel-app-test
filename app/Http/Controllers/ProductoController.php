<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Producto::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Producto::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return $producto;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $campospermitidos = ['name', 'price'];

        if($request->isMethod('patch')) {
            $producto->update($request->only($campospermitidos));
        } else {
            $data = $request->only($campospermitidos);
            foreach ($campospermitidos as $campo) {
                if (!array_key_exists($campo, $data)) {
                    if ($campo == 'created_at' || $campo == 'updated_at') {
                        continue;
                    }
                    $data[$campo] = null;
                }
            }
            $producto->update($data);
        } return $producto;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json(["message" => "Producto eliminado"]);
    }
}
