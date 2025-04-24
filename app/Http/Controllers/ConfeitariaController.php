<?php

namespace App\Http\Controllers;

use App\Models\Confeitaria;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ConfeitariaController extends Controller
{
    public function index()
    {
        return Inertia::render('Confeitarias/Index', [
            'confeitarias' => Confeitaria::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Confeitarias/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
            'cep' => 'required',
            'rua' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Confeitaria::create($request->all());

        return redirect()->route('confeitarias.index')->with('success', 'Confeitaria criada!');

    }

    public function show(Confeitaria $confeitaria)
    {
        //
    }

    public function edit(Confeitaria $confeitaria)
    {
        return Inertia::render('Confeitarias/Edit', [
            'confeitaria' => $confeitaria
        ]);
    }

    public function update(Request $request, Confeitaria $confeitaria)
    {
        $request->validate([
        'nome' => 'required',
        'telefone' => 'required',
        'cep' => 'required',
        'rua' => 'required',
        'numero' => 'required',
        'bairro' => 'required',
        'cidade' => 'required',
        'estado' => 'required',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    $confeitaria->update($request->all());

    return redirect()->route('confeitarias.index')->with('success', 'Confeitaria atualizada!');

    }

    public function destroy(Confeitaria $confeitaria)
    {
        $confeitaria->delete();
        return redirect()->route('confeitarias.index')->with('success', 'Confeitaria excluída!');
    }
}
