<script setup lang="ts">
import { Link, Head, useForm } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import AuthenticatedLayout from '@/Layouts/Tenant/AuthenticatedLayout.vue';

const props = defineProps<{
    aluno: {
        id: number
        sexo: string
        nome: string
        email: string
        telefone: string
        data_nascimento: string
    }
}>()

const form = useForm({
    nome: props?.aluno?.nome || '',
    sexo: props?.aluno?.sexo || '',
    email: props?.aluno?.email || '',
    telefone: props?.aluno?.telefone || '',
    data_nascimento: props?.aluno?.data_nascimento || ''
});

const submit = () => {
    if( props?.aluno?.id )
    {
        form.put(`/alunos/${props.aluno.id}`)
    }
    else
    {
        form.post('/alunos');
    }
};
</script>

<template>

    <Head title="Alunos" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastrar Aluno</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="div-btn">
                        <Link href="/alunos"
                            class="btn btn-view">
                            <span>Listar</span>
                        </Link>
                    </div>

                    <FlashMessage />

                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label for="nome" class="form-label">Nome *</label>
                            <input id="nome" v-model="form.nome" type="text" class="form-input" placeholder="Digite o nome do aluno" required/>
                            <div v-if="form.errors.nome" class="form-error">{{ form.errors.nome }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="sexo" class="form-label">Gênero *</label>
                            <label>
                                <input type="radio" value="F" v-model="form.sexo" />
                                Feminino
                            </label>
                            <label>
                                <input type="radio" value="M" v-model="form.sexo" />
                                Masculino
                            </label>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">E-mail</label>
                            <input id="email" v-model="form.email" type="email" class="form-input" placeholder="Digite o e-mail do aluno" />
                            <div v-if="form.errors.email" class="form-error">{{ form.errors.email }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="telefone" class="form-label">Telefone *</label>
                            <input id="telefone" v-model="form.telefone" type="text" class="form-input" placeholder="Digite o telefone do aluno" required/>
                            <div v-if="form.errors.telefone" class="form-error">{{ form.errors.telefone }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="data_nascimento" class="form-label">Data de Nascimento *</label>
                            <input id="data_nascimento" v-model="form.data_nascimento" type="date" class="form-input" required />
                            <div v-if="form.errors.data_nascimento" class="form-error">{{ form.errors.data_nascimento }}</div>
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
    .mb-4
    {
        margin-bottom: 18px;
    }

    .align-icon-btn span {
        display: inline-flex;
        align-items: center;
    }
</style>
