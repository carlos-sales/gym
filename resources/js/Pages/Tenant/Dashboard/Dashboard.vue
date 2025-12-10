<script setup>
import AuthenticatedLayout from '@/Layouts/Tenant/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import BarChart from '@/Components/BarChart.vue';
import PieChart from '@/Components/PieChart.vue';

const charts = usePage().props.charts;

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="border rounded p-4 shadow">
                            <PieChart :data="charts.sexo" title="Distribuição por Sexo" />
                        </div>

                        <div class="border rounded p-4 shadow">
                            <BarChart :data="charts.faixaEtaria" title="Faixa Etária dos Alunos" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>

</style>
