<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { App, useForm } from '@inertiajs/vue3';

const props = defineProps({
    statut_paiements: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    statut: '',
});

const submitForm = () => {
    form.post('/statuts_paiement', {
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
                <h1 class="text-3xl font-bold">Créer un Statut de Paiement</h1>
            </div>

            <form @submit.prevent="submitForm" class="space-y-6">
                <div>
                    <label
                        for="statut"
                        class="block text-sm font-medium text-gray-700"
                        >Statut</label
                    >
                    <input
                        v-model="form.statut"
                        type="text"
                        id="statut"
                        name="statut"
                        required
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                    />
                </div>

                <div>
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase hover:bg-blue-700"
                    >
                        Créer le Statut de Paiement
                    </button>
                </div>
            </form>
        </section>
    </AppLayout>
</template>
