<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import AuthenticatedLayout from '@/Layouts/Central/AuthenticatedLayout.vue';
import DeleteButton from '@/Components/DeleteButton.vue'
import { Head } from '@inertiajs/vue3';
import type { Tenant } from '../../Types/Tenant'

const props = defineProps<{
    tenants: {
        data: Tenant[];
        links: { url: string | null; label: string; active: boolean }[];
    };
}>();

</script>

<template>

    <Head title="Tenants" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tenants</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="div-btn">
                        <Link href="/tenants/create"
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
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="element in props.tenants.data" :key="element.id" class="table-body">
                                    <td class="table-row-body ">
                                        {{ element.id }}
                                    </td>
                                    <td class="table-row-body ">
                                        {{ element.name }}
                                    </td>
                                    <td class="table-actions">
                                        <div class="table-actions-align">

                                            <Link :href="`/tenants/${element.id}`" class="btn btn-view">
                                                <span>Visualizar</span>
                                            </Link>

                                            <Link :href="`/tenants/${element.id}/edit`" class="btn btn-edit">
                                                <span>Editar</span>
                                            </Link>

                                            <DeleteButton :url="`/tenants/${element.id}`" title="Deseja realmente apagar este aluno?" />

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination :links="props.tenants.links" />

                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>

</template>

<style>
    .div-btn
    {
        text-align: end;
        margin: 15px;
    }

    .table-container
    {
        padding: 10px 21px;
    }

    table
    {
        width: 100%;
        border-collapse: collapse;
        background: var(--bg);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        min-width: 320px;
    }

    .table thead
    {
        background: linear-gradient(180deg, rgba(255,255,255,0.6), rgba(245,247,250,0.6));
        position: sticky;
        top: 0;
        z-index: 2;
        backdrop-filter: blur(4px);
    }

    .table thead th
    {
        text-align: left;
        padding: var(--table-padding);
        font-size: 0.92rem;
        color: var(--muted);
        font-weight: 600;
        letter-spacing: 0.2px;
        border-bottom: 1px solid rgba(15,23,42,0.06);
    }

    .table tbody tr
    {
        transition: background-color 160ms ease, transform 120ms ease;
    }

    .table tbody tr:nth-child(even)
    {
        background: var(--stripe);
    }

    .table tbody tr:hover
    {
        background: rgba(31,122,237,0.05);
        transform: translateY(-1px);
    }


    .table td
    {
        padding: 12px 18px;
        font-size: 0.95rem;
        color: #101827;
        vertical-align: middle;
        border-bottom: 1px solid rgba(15,23,42,0.04);
    }

    .btn
    {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 10px;
        font-size: 0.85rem;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        background: transparent;
        transition: transform 120ms ease, box-shadow 120ms ease, opacity 120ms;
    }

    .btn + .btn
    {
        margin-left: 10px;
    }

    .btn:focus { outline: 3px solid rgba(31,122,237,0.18); outline-offset: 2px; }

    .btn-create
    {
        color: #0c7a43;
        background: rgba(12,122,67,0.08);
    }

    .btn-create:hover { transform: translateY(-2px); }

    .btn-view
    {
        color: var(--accent);
        background: rgba(31,122,237,0.08);
    }

    .btn-view:hover { transform: translateY(-2px); }

    .btn-edit
    {
        color: var(--accent-2);
        background: rgba(11,94,215,0.06);
    }

    .btn-edit:hover { transform: translateY(-2px); }

    .btn-delete
    {
        color: var(--danger);
        background: rgba(224,49,49,0.06);
    }

    .btn-delete:hover { transform: translateY(-2px); }
</style>
