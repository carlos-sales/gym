<script setup>
import { reactive } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import FlashMessage from '@/Components/FlashMessage.vue';
import AuthenticatedLayout from '@/Layouts/Central/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const page = usePage()
const props = page.props

const form = reactive({
    tenant_id: page.props.filtros?.tenant_id ?? ''
})

function filtrar() {
    router.post(route('central.relatorio.filtrar'), form)
}
</script>

<template>

    <Head title="Relatório" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Relatório</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="filtrar" class="space-y-4 max-w-md mb-10">
                        <div>
                            <label class="font-semibold">Tenant</label>
                            <select v-model="form.tenant_id"
                                    class="border rounded p-2 w-full">
                                <option value="">Todas</option>
                                <option v-for="t in page.props.tenants"
                                        :key="t.id"
                                        :value="t.id">
                                    {{ t.id }}
                                </option>
                            </select>
                        </div>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded">
                            Gerar Relatório
                        </button>
                    </form>

                    <div v-if="page.props.resultado && page.props.resultado.length > 0">

                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border px-4 py-2 text-left">Tenant</th>
                                    <th class="border px-4 py-2 text-left">Total Usuários</th>
                                    <th class="border px-4 py-2 text-left">Total Alunos</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="linha in page.props.resultado" :key="linha.tenant">
                                    <td class="border px-4 py-2 font-semibold">
                                        {{ linha.tenant }}
                                    </td>
                                    <td class="border px-4 py-2">{{ linha.total_usuarios }}</td>
                                    <td class="border px-4 py-2">{{ linha.total_alunos }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div v-else class="text-gray-500 text-center">
                        Nenhum dado encontrado. Escolha um tenant e gere o relatório.
                    </div>
                </div>
            </div>
        </div>

        <FlashMessage />

    </AuthenticatedLayout>
</template>

<style>
    .text-center
    {
        text-align: center;
    }
</style>
