<?php

namespace App\Http\Controllers\Central\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Facades\Tenancy;
use App\Models\Tenant;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::paginate(30);

        return Inertia::render('Central/Tenants/Index', [
            "tenants" => $tenants
        ]);
    }

    public function show(Tenant $tenant)
    {
        return Inertia::render('Central/Tenants/Show', ['tenant' => $tenant]);
    }

    public function create()
    {
        return Inertia::render('Central/Tenants/Form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'unique:tenants|required|string',
            'nome' => 'required|string',
        ],[
            'id.unique' => 'Já existe uma database com esse nome!'
        ]);


        try
        {
            $tenant = Tenant::create([
                'id' => $validated['id'],
                'name' => $validated['nome'],
            ]);

            Tenancy::initialize($tenant);

            User::create([
                'name' => 'Administrador',
                'email' => 'admin@'.$tenant->id.'.com',
                'password' => Hash::make('123456'),
            ]);

            Tenancy::end();

            $tenant->domains()->create([
                'domain' => $tenant->id . '.localhost',
            ]);

            return redirect()->route('central.tenants.index', ['tenant' => $tenant->id])->with('success', 'Tenant cadastrada com sucesso!');
        }
        catch (Exception $e)
        {
            return back()->withInput()->with('error', 'Tenant não cadastrada!');
        }
    }

    public function update(Tenant $tenant, Request $request)
    {
        $request->validate(
            [
                'nome' => 'required|string|max:255',
            ],
            [
                'nome.required' => "Campo nome é obrigatório!",
            ]
        );

        try
        {
            $tenant = Tenant::update([
                'nome' => $validated['nome'],
            ]);
            return redirect()->route('central.tenants.show', ['tenant' => $tenant->id])->with('success', 'Tenant editada com sucesso!');
        }
        catch (Exception $e)
        {
            return back()->withInput()->with('error', 'Tenant não editada!');
        }
    }

    public function destroy(Tenant $tenant)
    {
        try
        {
            $tenant->delete();
            return redirect()->route('central.tenants.index')->with('success', 'Tenant apagada com sucesso!');
        }
        catch (Exception $e)
        {
            return redirect()->route('central.tenants.index')->with('error', 'Tenant não apagada!');
        }
    }
}
