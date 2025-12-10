<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import AuthenticatedLayout from '@/Layouts/Tenant/AuthenticatedLayout.vue';
import DeleteButton from '@/Components/DeleteButton.vue'
import { Head } from '@inertiajs/vue3';
import type { Aluno } from '@/Types/Aluno'

const props = defineProps<{
    alunos: {
        data: Aluno[];
        links: { url: string | null; label: string; active: boolean }[];
    };
}>();

</script>

<template>

    <Head title="Alunos" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Alunos</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="div-btn">
                        <Link href="/alunos/create"
                            class="btn btn-create">
                            <span>Cadastrar</span>
                        </Link>
                    </div>

                    <FlashMessage />

                    <div class="table-container">

                        <table class="table">
                            <thead>
                                <tr class="table-header">
                                    <th class="table-row-header">
                                        ID
                                    </th>
                                    <th class="table-row-header">
                                        Nome
                                    </th>
                                    <th class="table-row-header">
                                        Sexo
                                    </th>
                                    <th class="table-row-header">
                                        E-mail
                                    </th>
                                    <th class="table-row-header">
                                        Telefone
                                    </th>
                                    <th class="table-row-header">
                                        Data de Nascimento
                                    </th>
                                    <th class="table-row-header">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="element in props.alunos.data" :key="element.id" class="table-body">
                                    <td class="table-row-body ">
                                        {{ element.id }}
                                    </td>
                                    <td class="table-row-body ">
                                        {{ element.nome }}
                                    </td>
                                    <td class="table-row-body ">
                                        {{ element.sexo }}
                                    </td>
                                    <td class="table-row-body ">
                                        {{ element.email }}
                                    </td>
                                    <td class="table-row-body ">
                                        {{ element.telefone }}
                                    </td>
                                    <td class="table-row-body ">
                                        {{ element.data_nascimento }}
                                    </td>
                                    <td class="table-actions">
                                        <div class="table-actions-align">

                                            <Link :href="`/alunos/${element.id}`" class="btn btn-view">
                                                <span>Visualizar</span>
                                            </Link>

                                            <Link :href="`/alunos/${element.id}/edit`" class="btn btn-edit">
                                                <span>Editar</span>
                                            </Link>

                                            <DeleteButton :url="`/alunos/${element.id}`" title="Deseja realmente apagar este aluno?" />

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination :links="props.alunos.links" />

                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>

</template>

<style>

</style>
