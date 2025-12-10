<script setup lang="ts">
import { Link, Head, useForm } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import AuthenticatedLayout from '@/Layouts/Central/AuthenticatedLayout.vue';

const props = defineProps<{
    tenant: {
        id: string
        nome: string
    }
}>()

const form = useForm({
    nome: props?.tenant?.nome || '',
    id: props?.tenant?.id || '',
});

const submit = () => {
    if( props?.tenant?.id )
    {
        form.put(`/tenants/${props.tenant.id}`)
    }
    else
    {
        form.post('/tenants');
    }
};
</script>

<template>

    <Head title="tenants" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastrar Tenant</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="div-btn">
                        <Link href="/tenants"
                            class="btn btn-view">
                            <span>Listar</span>
                        </Link>
                    </div>

                    <FlashMessage />

                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label for="nome" class="form-label">Nome *</label>
                            <input id="nome" v-model="form.nome" type="text" class="form-input" placeholder="Digite o nome da tenant" required/>
                            <div v-if="form.errors.nome" class="form-error">{{ form.errors.nome }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="id" class="form-label">Database *</label>
                            <input id="id" v-model="form.id" type="text" class="form-input" placeholder="Digite o nome da database" required/>
                            <div v-if="form.errors.id" class="form-error">{{ form.errors.id }}</div>
                        </div>

                        <div class="mb-4">
                            <span class="required-field">* Campo obrigatório</span>
                        </div>

                        <button type="submit" class="btn-success align-icon-btn" :disabled="form.processing">
                            <span>{{ form.processing ? 'Salvando...' : 'Cadastrar' }}</span>
                        </button>
                    </form>

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

    .btn-view
    {
        color: var(--accent);
        background: rgba(31,122,237,0.08);
    }

    .btn-view:hover { transform: translateY(-2px); }

    form
    {
        background: #ffffff;
        padding: 26px 32px;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
        border: 1px solid rgba(55, 65, 81, 0.08);
        max-width: 600px;
        margin: 20px auto;
        font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
    }

    .mb-4
    {
        margin-bottom: 18px;
    }

    .form-label
    {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        font-size: 0.92rem;
    }

    .form-input
    {
        width: 100%;
        padding: 12px 14px;
        font-size: 1rem;
        border-radius: 10px;
        border: 1px solid rgba(148, 163, 184, 0.5);
        background: #f9fafb;
        transition: border-color 160ms ease, box-shadow 160ms ease, background-color 180ms ease;
        color: #0f172a;
    }

    .form-input:hover
    {
        background: #ffffff;
        border-color: rgba(55, 125, 255, 0.5);
    }

    .form-input:focus
    {
        outline: none;
        background: #fff;
        border-color: #1f7aed;
        box-shadow: 0 0 0 3px rgba(31, 122, 237, 0.15);
    }

    .form-error
    {
        margin-top: 6px;
        font-size: 0.85rem;
        color: #d00000;
        font-weight: 500;
    }

    .required-field
    {
        font-size: 0.85rem;
        color: #6b7280;
        font-style: italic;
    }

    .btn-success
    {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        font-size: 1rem;
        border-radius: 10px;
        font-weight: 600;
        background-color: #0c7a43;
        color: #ffffff;
        border: none;
        cursor: pointer;
        transition: transform 120ms ease, box-shadow 160ms ease, background-color 160ms ease;
    }

    .btn-success:hover:not(:disabled)
    {
        background-color: #0a6538;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(12, 122, 67, 0.35);
    }

    .btn-success:disabled
    {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .align-icon-btn span {
        display: inline-flex;
        align-items: center;
    }


</style>
