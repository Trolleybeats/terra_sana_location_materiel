<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { App, useForm } from '@inertiajs/vue3';

const props = defineProps({
    fonctions: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    fonction: '',
});

const submitForm = () => {
    form.post('/fonctions', {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold">Créer une Fonction</h1>
            </div>

            <form @submit.prevent="submitForm" class="space-y-6">
                <div>
                    <label
                        for="fonction"
                        class="block text-sm font-medium text-gray-700"
                        >Nom de la Fonction</label
                    >
                    <input
                        v-model="form.fonction"
                        type="text"
                        id="fonction"
                        name="fonction"
                        required
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                    />
                </div>

                <div>
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase hover:bg-blue-700"
                    >
                        Créer la Fonction
                    </button>
                </div>
            </form>
        </section>
    </AppLayout>
</template>
