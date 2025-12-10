<?php

namespace App\Http\Controllers\Central\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Stancl\Tenancy\Tenancy;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();

        $consolidado_sexo = [
            'total_usuarios' => 0,
            'total_masculino' => 0,
            'total_feminino' => 0,
            'unidades' => []
        ];

        $consolidado_idade = [
            '0-17' => 0,
            '18-29' => 0,
            '30-49' => 0,
            '50-64' => 0,
            '65+' => 0,
        ];

        foreach($tenants as $tenant)
        {

            tenancy()->initialize($tenant);

            $masculino = \DB::table('alunos')->where('sexo', 'M')->count();
            $feminino  = \DB::table('alunos')->where('sexo', 'F')->count();
            $total     = $masculino + $feminino;

            $consolidado_sexo['total_usuarios'] += $total;
            $consolidado_sexo['total_masculino'] += $masculino;
            $consolidado_sexo['total_feminino'] += $feminino;

            $consolidado_sexo['unidades'][] = [
                'tenant_id' => $tenant->id,
                'nome' => $tenant->data['nome'] ?? 'Sem nome',
                'total' => $total,
                'masculino' => $masculino,
                'feminino' => $feminino,
            ];

            $idade0a17 = \DB::table('alunos')->whereRaw('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) BETWEEN ? AND ?', [0, 17])->count();
            $idade18a29 = \DB::table('alunos')->whereRaw('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) BETWEEN ? AND ?', [18, 29])->count();
            $idade30a49 = \DB::table('alunos')->whereRaw('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) BETWEEN ? AND ?', [30, 49])->count();
            $idade50a64 = \DB::table('alunos')->whereRaw('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) BETWEEN ? AND ?', [50, 64])->count();
            $idadeAcima65  = \DB::table('alunos')->whereRaw('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) >= ?', 65)->count();
            $total     = $idade0a17 + $idade18a29 + $idade30a49 + $idade50a64 + $idadeAcima65;

            $consolidado_idade['0-17'] += $idade0a17;
            $consolidado_idade['18-29'] += $idade18a29;
            $consolidado_idade['30-49'] += $idade30a49;
            $consolidado_idade['50-64'] += $idade50a64;
            $consolidado_idade['65+'] += $idadeAcima65;

            tenancy()->end();
        }

        return Inertia::render('Central/Dashboard/Dashboard', [
            'charts' => [
                'sexo' => $consolidado_sexo,
                'faixaEtaria' => $consolidado_idade,
            ],
        ]);
    }
}
