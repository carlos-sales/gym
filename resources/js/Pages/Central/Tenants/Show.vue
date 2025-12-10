<script setup lang="ts">

import { Link, Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/Central/AuthenticatedLayout.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import DeleteButton from '@/Components/DeleteButton.vue'
import { Tenant } from '@/Types/Tenant';

const props = defineProps<{
    tenant: Tenant;
}>();


</script>

<template>

        <Head title="Tenant" />

        <AuthenticatedLayout>

            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalhes da Tenant</h2>
            </template>


            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <div class="content-box">

                            <div class="content-box-header">
                                <div class="content-box-btn">

                                    <div class="div-btn">
                                        <Link href="/tenants"
                                            class="btn btn-view">
                                            <span>Listar</span>
                                        </Link>
                                        <Link :href="`/tenants/${props.tenant.id}/edit`"
                                            class="btn btn-edit">
                                            <span>Editar</span>
                                        </Link>
                                        <DeleteButton :url="`/tenants/${props.tenant.name}`" title="Deseja realmente apagar esta tenant?" />
                                    </div>

                                </div>
                            </div>

                            <FlashMessage />

                            <div class="detail-box">

                                <p>
                                    <strong class="title-detail-content">
                                        ID:
                                    </strong>
                                    <span class="detail-content">
                                        {{ props.tenant.id }}
                                    </span>
                                </p>
                                <p>
                                    <strong class="title-detail-content">
                                        Nome:
                                    </strong>
                                    <span class="detail-content">
                                        {{ props.tenant.name }}
                                    </span>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </AuthenticatedLayout>

</template>

<style>
    .detail-box
    {
        background: #ffffff;
        padding: 22px 28px;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
        border: 1px solid rgba(55, 65, 81, 0.08);
        max-width: 600px;
        margin: 20px auto;
        display: grid;
        gap: 14px;
        font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
    }

    .detail-box p
    {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
        color: #1f2937;
    }

    .title-detail-content
    {
        min-width: 160px;
        font-weight: 600;
        color: #374151;
        text-transform: none;
        letter-spacing: 0.2px;
    }

    .div-btn
    {
        text-align: end;
        margin: 15px;
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
