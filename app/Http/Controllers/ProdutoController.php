<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Confeitaria;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return Inertia::render('Produtos/Index', [
            'produtos' => Produto::with('confeitaria')->get()
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Produtos/Create', [
            'confeitarias' => Confeitaria::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'confeitaria_id' => 'required|exists:confeitarias,id',
            'nome' => 'required',
            'valor' => 'required|numeric',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|string',
        ]);
    
        Produto::create($request->all());
    
        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
