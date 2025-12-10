<script setup lang="ts">
/* Importa o composable `usePage` do Inertia.js,
   que permite acessar as propriedades globais enviadas pelo backend Laravel */
import { router } from '@inertiajs/vue3';

/* Importar os ícones */
import { Trash2 } from 'lucide-vue-next';

/* Define a interface do usuário, útil para tipagem TypeScript */
interface Props {
    // URL da rota que será chamada para apagar o registro
    url: string
    // Título opcional que será exibido na confirmação do SweetAlert
    title?: string
    // Texto opcional que será exibido no botão
    buttonText?: string
}

// Recebe as props passadas para o componente e aplica a tipagem definida
const props = defineProps<Props>()

// Função de confirmação e exclusão
const confirmDelete = () => {
    const confirmMessage = props.title ?? "Tem certeza?";
    const result = confirm(`${confirmMessage}\nEssa ação não poderá ser desfeita!`);

    if (result) {
        router.delete(props.url);
    }
};
</script>

<template>

    <!-- Botão Apagar -->
    <button @click="confirmDelete" class="btn btn-delete">
        <span>{{ buttonText ?? 'Apagar' }}</span>
    </button>

</template>

<style>
    @reference "../../css/app.css";

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

    .btn-delete
    {
        color: var(--danger);
        background: rgba(224,49,49,0.06);
    }

    .btn-delete:hover { transform: translateY(-2px); }
</style>
