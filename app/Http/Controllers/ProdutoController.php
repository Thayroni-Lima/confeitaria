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
            'imagens.*' => 'nullable|image|max:2048',
        ]);
    
        $paths = [];
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $image) {
                $paths[] = $image->store('produtos', 'public');
            }
        }
    
        Produto::create([
            'confeitaria_id' => $request->confeitaria_id,
            'nome' => $request->nome,
            'valor' => $request->valor,
            'descricao' => $request->descricao,
            'imagem' => $paths,
        ]);
    
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
        return Inertia::render('Produtos/Edit', [
            'produto' => $produto,
            'confeitarias' => Confeitaria::all(),
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'confeitaria_id' => 'required|exists:confeitarias,id',
            'nome' => 'required',
            'valor' => 'required|numeric',
            'descricao' => 'nullable|string',
            'imagens_novas.*' => 'nullable|image|max:2048',
            'imagens_existentes' => 'array',
        ]);
    
        $novasImagens = [];
    
        if ($request->hasFile('imagens_novas')) {
            foreach ($request->file('imagens_novas') as $img) {
                $novasImagens[] = $img->store('produtos', 'public');
            }
        }
    
        $produto->update([
            'confeitaria_id' => $request->confeitaria_id,
            'nome' => $request->nome,
            'valor' => $request->valor,
            'descricao' => $request->descricao,
            'imagem' => array_merge($request->imagens_existentes ?? [], $novasImagens),
        ]);
    
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function porConfeitaria(Confeitaria $confeitaria)
    {
        return Inertia::render('Produtos/Index', [
            'produtos' => $confeitaria->produtos()->with('confeitaria')->get()
        ]);
    }
        

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
    
}
