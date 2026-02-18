<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Pedir todos los productos al Chef (Modelo)
        $productos = Producto::all();
        // 2. Enviarlos a la mesa (Vista)
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validar que la información esté completa
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
        ]);

        // 2. Crear el producto en la Base de Datos
        Producto::create($request->all());

        // 3. Redirigir a la tabla principal
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // 1. Buscar el producto por su ID
        $producto = Producto::find($id);
        
        // 2. Mostrar el formulario con los datos cargados
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, $id)
    {
        // 1. Validar que los datos nuevos estén bien
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
        ]);

        // 2. Buscar el producto original por su ID
        $producto = Producto::find($id);

        // 3. Sobreescribir los datos viejos con los nuevos
        $producto->update($request->all());

        // 4. Regresar a la lista principal
        return redirect()->route('productos.index');
    }
    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
    {
        // 1. Buscar el producto
        $producto = Producto::find($id);

        // 2. Eliminarlo
        $producto->delete();

        // 3. Regresar a la lista
        return redirect()->route('productos.index');
    }

    public function reportes()
    {
        // PRUEBA 3: Usando IS NOT NULL (whereNotNull)
        // Esto dice: "Dame todos los productos donde el nombre NO esté vacío"
        $resultados = Producto::whereNotNull('nombre')->get();

        return $resultados;
    }
}
