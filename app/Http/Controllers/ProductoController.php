<?php

namespace App\Http\Controllers;

use App\Models\Podructo;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // http://127.0.0.1:8000/api/producto?page=2&q=tec
        $buscar = isset($request->q)?$request->q : '';
        $limit = isset($request->limit)?$request->limit: 10;

        if($buscar){
            $productos = Podructo::orderBy('id', 'desc')
                                    ->where('nombre', 'like', '%'.$buscar.'%')
                                    ->with("categoria")
                                    ->paginate($limit);
        }else{
            $productos = Podructo::orderBy('id', 'desc')->with("categoria")->paginate($limit);
        }
        return response()->json($productos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "nombre"=>"required",
            "categoria_id" => "required"
        ]);
        // guardar
        $prod = new Podructo();
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->stock = $request->stock;
        $prod->categoria_id = $request->categoria_id;
        $prod->descripcion = $request->descripcion;
        $prod->save();
        // responder
        return response()->json(["message" => "Producto registrado"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Podructo::with('categoria')->findOrFail($id);
        return response()->json($producto, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validar
        $request->validate([
            "nombre"=>"required",
            "categoria_id" => "required"
        ]);

        $prod = Podructo::findOrFail($id);
        // guardar
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->stock = $request->stock;
        $prod->categoria_id = $request->categoria_id;
        $prod->descripcion = $request->descripcion;
        $prod->update();
        // responder
        return response()->json(["message" => "Producto actualizado"], 201);
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prod = Podructo::findOrFail($id);
        $prod->delete();
        return response()->json(["message" => "Producto eliminado"], 200);
    }

    public function actualizarImagen(Request $request, $id) {
        if($file = $request->file("imagen")){
            $direccion_imagen = time()."-".$file->getClientOriginalName();
            $file->move("imagen/", $direccion_imagen);
            $direccion_imagen = "imagen/". $direccion_imagen;

            $prod = Podructo::find($id);
            $prod->imagen = $direccion_imagen;
            $prod->update();
            return response()->json(["message" => "Imagen Producto Actualizado"], 200);
        }

        return response()->json(["message" => "Se requiere Imagen de Producto"], 422);
    }
}