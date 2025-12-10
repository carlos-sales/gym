<?php

namespace App\Http\Controllers\Tenant\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Aluno;

class DashboardController extends Controller
{
    public function index()
    {
        $contagemSexo = Aluno::selectRaw("  CASE
                                                WHEN sexo = 'M' THEN 'Masculino'
                                                ELSE 'Feminino'
                                            END AS sexo,
                                            COUNT(*) as total
                                        ")
                            ->groupBy('sexo')
                            ->pluck('total', 'sexo');

        $faixaEtaria = Aluno::selectRaw("    CASE
                                                WHEN TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) BETWEEN 0 AND 17 THEN '0-17'
                                                WHEN TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) BETWEEN 18 AND 29 THEN '18-29'
                                                WHEN TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) BETWEEN 30 AND 49 THEN '30-49'
                                                WHEN TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) BETWEEN 50 AND 65 THEN '50-64'
                                                ELSE '65+'
                                            END AS faixa,
                                            COUNT(*) AS total ")
                                        ->groupBy('faixa')
                                        ->orderBy('faixa')
                                        ->pluck('total', 'faixa');

        return Inertia::render('Tenant/Dashboard/Dashboard', [
            'charts' => [
                'sexo' => $contagemSexo,
                'faixaEtaria' => $faixaEtaria,
            ],
        ]);
    }
}
