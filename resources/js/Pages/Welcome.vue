<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const tenant = usePage().props.tenant;
const isTenant = tenant !== null;

</script>

<template>
    <Head title="Home" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">

                <Link
                    :href="route('central.login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Login</Link>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">

            <div class="flex justify-center">
                <h1 v-if="isTenant">
                    Bem-Vindo à Área Administrativa
                </h1>
                <h1 v-else="isTenant">
                    Bem-Vindo à sua academia
                </h1>
            </div>

        </div>
    </div>
</template>

<style>
    h1{color:#FFF}
</style>
