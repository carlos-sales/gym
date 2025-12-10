<?php

namespace App\Http\Controllers\Tenant\Aluno;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::orderBy('nome')->paginate(30);

        return Inertia::render('Tenant/Alunos/Index', [
            "alunos" => $alunos
        ]);
    }

    public function show(Aluno $aluno)
    {
        return Inertia::render('Tenant/Alunos/Show', ['aluno' => $aluno]);
    }

    public function create()
    {
        return Inertia::render('Tenant/Alunos/Form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nome' => 'required|string|max:255',
                'email' => 'string|max:255',
                'sexo' => 'required',
                'telefone' => 'required|string|max:255',
                'data_nascimento' => 'required|date',
            ],
            [
                'nome.required' => "Campo 'nome' é obrigatório!",
                'sexo.required' => "Campo 'sexo' é obrigatório!",
                'telefone.required' => "Campo 'telefone' é obrigatório!",
                'data_nascimento.date' => "Informe uma data válida!"
            ]
        );

        try
        {
            $aluno = Aluno::create([
                'nome' => $validated['nome'],
                'email' => $validated['email'],
                'sexo' => $validated['sexo'],
                'telefone' => $validated['telefone'],
                'data_nascimento' => $validated['data_nascimento'],
            ]);
            return redirect()->route('tenant.alunos.show', ['aluno' => $aluno->id])->with('success', 'Aluno cadastrado com sucesso!');
        }
        catch (Exception $e)
        {
            return back()->withInput()->with('error', 'Aluno não cadastrado!');
        }
    }

    public function edit(Aluno $aluno)
    {
        return Inertia::render('Alunos/Form', ['aluno' => $aluno]);
    }

    public function update(Aluno $aluno, Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|string|max:255',
                'email' => 'string|max:255',
                'sexo' => 'required',
                'telefone' => 'required|string|max:255',
                'data_nascimento' => 'required|date',
            ],
            [
                'nome.required' => "Campo nome é obrigatório!",
                'sexo.required' => "Campo 'sexo' é obrigatório!",
                'telefone.required' => "Campo telefone é obrigatório!",
                'data_nascimento.date' => "Informe uma data válida!"
            ]
        );

        try
        {
            $aluno = Aluno::update([
                'nome' => $validated['nome'],
                'email' => $validated['email'],
                'sexo' => $validated['sexo'],
                'telefone' => $validated['telefone'],
                'data_nascimento' => $validated['data_nascimento'],
            ]);
            return redirect()->route('tenant.alunos.show', ['aluno' => $aluno->id])->with('success', 'Aluno editado com sucesso!');
        }
        catch (Exception $e)
        {
            return back()->withInput()->with('error', 'Aluno não editado!');
        }
    }

    public function destroy(Aluno $aluno)
    {
        try
        {
            $aluno->delete();
            return redirect()->route('tenant.alunos.index')->with('success', 'Aluno apagado com sucesso!');
        }
        catch (Exception $e)
        {
            return redirect()->route('tenant.alunos.index')->with('error', 'Aluno não apagado!');
        }
    }
}
