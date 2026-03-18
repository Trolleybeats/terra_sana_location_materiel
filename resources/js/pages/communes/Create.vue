<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    communes: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    nom_commune: '',
    numero_commune: '',
});

const submitForm = () => {
    form.post('/communes', {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
<template>
    <AppLayout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-2xl font-bold">Créer une Commune</h1>
            <form @submit.prevent="submitForm" class="space-y-6">
                <div>
                    <label
                        for="nom_commune"
                        class="block text-sm font-medium text-gray-700"
                        >Nom de la Commune</label
                    >
                    <input
                        v-model="form.nom_commune"
                        type="text"
                        id="nom_commune"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    />
                </div>
                <div>
                    <label
                        for="numero_commune"
                        class="text -sm block font-medium text-gray-700"
                        >Numéro de la Commune</label
                    >
                    <input
                        v-model="form.numero_commune"
                        type="text"
                        id="numero_commune"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    />
                </div>
                <div>
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
                    >
                        Créer la Commune
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
