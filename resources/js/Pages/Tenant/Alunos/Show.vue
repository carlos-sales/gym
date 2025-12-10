<script setup lang="ts">

import { Link, Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/Tenant/AuthenticatedLayout.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import DeleteButton from '@/Components/DeleteButton.vue'
import type { Aluno } from '@/Types/Aluno'

const props = defineProps<{
    aluno: Aluno;
}>();


</script>

<template>

        <Head title="Aluno" />

        <AuthenticatedLayout>

            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalhes do Aluno</h2>
            </template>


            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <div class="content-box">

                            <div class="content-box-header">
                                <div class="content-box-btn">

                                    <div class="div-btn">
                                        <Link href="/alunos"
                                            class="btn btn-view">
                                            <span>Listar</span>
                                        </Link>
                                        <Link :href="`/alunos/${props.aluno.id}/edit`"
                                            class="btn btn-edit">
                                            <span>Editar</span>
                                        </Link>
                                        <DeleteButton :url="`/alunos/${props.aluno.id}`" title="Deseja realmente apagar este aluno?" />
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
                                        {{ props.aluno.id }}
                                    </span>
                                </p>
                                <p>
                                    <strong class="title-detail-content">
                                        Nome:
                                    </strong>
                                    <span class="detail-content">
                                        {{ props.aluno.nome }}
                                    </span>
                                </p>
                                <p>
                                    <strong class="title-detail-content">
                                        Sexo:
                                    </strong>
                                    <span class="detail-content">
                                        {{ props.aluno.sexo }}
                                    </span>
                                </p>
                                <p>
                                    <strong class="title-detail-content">
                                        E-mail:
                                    </strong>
                                    <span class="detail-content">
                                        {{ props.aluno.email }}
                                    </span>
                                </p>
                                <p>
                                    <strong class="title-detail-content">
                                        Telefone:
                                    </strong>
                                    <span class="detail-content">
                                        {{ props.aluno.telefone }}
                                    </span>
                                </p>
                                <p>
                                    <strong class="title-detail-content">
                                        Data de Nascimento:
                                    </strong>
                                    <span class="detail-content">
                                        {{ props.aluno.data_nascimento }}
                                    </span>
                                </p>
                                <p>
                                    <strong class="title-detail-content">
                                        Criado em:
                                    </strong>
                                    <span class="detail-content">
                                        {{ props.aluno.created_at }}
                                    </span>
                                </p>
                                <p>
                                    <strong class="title-detail-content">
                                        Atualizado em::
                                    </strong>
                                    <span class="detail-content">
                                        {{ props.aluno.updated_at }}
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

</style>
