<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { App, useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories_materiel: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    nom: '',
    description: '',
});

const submitForm = () => {
    form.post('/categories_materiel', {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <AppLayout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-2xl font-bold">
                Créer une Catégorie de Matériel
            </h1>
            <form @submit.prevent="submitForm" class="space-y-6">
                <div>
                    <label
                        for="nom"
                        class="block text-sm font-medium text-gray-700"
                        >Nom de la Catégorie</label
                    >
                    <input
                        v-model="form.nom"
                        type="text"
                        id="nom"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    />
                </div>
                <div>
                    <label
                        for="description"
                        class="text -sm block font-medium text-gray-700"
                        >Description de la Catégorie</label
                    >
                    <textarea
                        v-model="form.description"
                        id="description"
                        rows="4"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                    ></textarea>
                </div>
                <div>
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase hover:bg-blue-700"
                    >
                        Créer la Catégorie
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
