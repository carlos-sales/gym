<?php

namespace App\Http\Controllers\Central\Relatorio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Tenant\User;
use App\Models\Aluno;
use Stancl\Tenancy\Tenancy;
use Inertia\Inertia;

class RelatorioController extends Controller
{
    public function index()
    {
        return inertia('Central/Relatorio/Relatorio', [
            'resultado' => null,
            'tenants' => Tenant::select('id')->get()
        ]);
    }

    public function filtrar(Request $request)
    {
        $request->validate([
            'tenant_id' => 'nullable|string' // null = todas
        ]);

        $tenants = [];

        if( $request->tenant_id )
        {
            $tenant = Tenant::findOrFail($request->tenant_id);
            $tenants = [$tenant];
        }
        else
        {
            $tenants = Tenant::all();
        }

        $resultado = [];

        foreach ($tenants as $tenant)
        {
            tenancy()->initialize($tenant);

            $resultado[] = [
                'tenant' => $tenant->id,
                'total_usuarios' => User::count(),
                'total_alunos'   => Aluno::count(),
            ];
        }

        tenancy()->end();

        return inertia('Central/Relatorio/Relatorio', [
            'resultado' => $resultado,
            'tenants' => Tenant::select('id')->get(),
            'filtros' => $request->all()
        ]);
    }
}
