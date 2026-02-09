<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { watch, type PropType } from 'vue';

interface Fonction {
    id: number;
    nom: string;
}

const props = defineProps({
    professionnelId: {
        type: [String, Number],
        default: '',
    },
    fonctions: {
        type: Array as PropType<Fonction[]>,
        default: () => [],
    },
});

const form = useForm({
    professionnel_id: props.professionnelId || '',
    nom: '',
    prenom: '',
    email: '',
    telephone: '',
    fonction_id: '',
});

// Mettre à jour le form si professionnelId change
watch(
    () => props.professionnelId,
    (newValue) => {
        form.professionnel_id = newValue || '';
    },
    { immediate: true },
);

function submit() {
    form.post('/contact_pro', {
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>

<template>
    <AppLayout>
        <section class="max-w-7xl py-10 sm:px-6 lg:px-8">
            <h2 class="text-xl leading-tight font-semibold text-gray-800">
                Ajouter un contact professionnel
            </h2>

            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                    >
                        <div class="border-b border-gray-200 bg-white p-6">
                            <!-- Formulaire de création de contact professionnel -->
                            <form @submit.prevent="submit" class="space-y-6">
                                <!-- Champs du formulaire -->
                                <div class="">
                                    <label
                                        for="professionnel_id"
                                        class="block text-sm font-medium text-gray-700"
                                        >Professionnel</label
                                    >
                                    <input
                                        type="text"
                                        name="professionnel_id"
                                        id="professionnel_id"
                                        v-model="form.professionnel_id"
                                        required
                                        readonly
                                        class="mt-1 block w-full cursor-not-allowed rounded-md border-gray-300 bg-gray-100 shadow-sm sm:text-sm"
                                    />
                                </div>
                                <div class="">
                                    <label
                                        for="nom"
                                        class="block text-sm font-medium text-gray-700"
                                        >Nom</label
                                    >
                                    <input
                                        type="text"
                                        name="nom"
                                        id="nom"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required
                                        v-model="form.nom"
                                    />
                                </div>
                                <div class="">
                                    <label
                                        for="prenom"
                                        class="block text-sm font-medium text-gray-700"
                                        >Prénom</label
                                    >
                                    <input
                                        type="text"
                                        name="prenom"
                                        id="prenom"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required
                                        v-model="form.prenom"
                                    />
                                </div>
                                <div class="">
                                    <label
                                        for="email"
                                        class="block text-sm font-medium text-gray-700"
                                        >Email</label
                                    >
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required
                                        v-model="form.email"
                                    />
                                </div>
                                <div class="">
                                    <label
                                        for="telephone"
                                        class="block text-sm font-medium text-gray-700"
                                        >Téléphone</label
                                    >
                                    <input
                                        type="text"
                                        name="telephone"
                                        id="telephone"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required
                                        v-model="form.telephone"
                                    />
                                </div>
                                <div class="">
                                    <label
                                        for="fonction_id"
                                        class="block text-sm font-medium text-gray-700"
                                        >Fonction</label
                                    >
                                    <select
                                        name="fonction_id"
                                        id="fonction_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        required
                                        v-model="form.fonction_id"
                                    >
                                        <option value="">
                                            Sélectionnez une fonction
                                        </option>
                                        <option
                                            v-for="fonction in fonctions"
                                            :key="fonction.id"
                                            :value="fonction.id"
                                        >
                                            {{ fonction.fonction }}
                                        </option>
                                    </select>
                                </div>
                                <button
                                    type="submit"
                                    class="rounded bg-blue-600 px-4 py-2 font-medium text-white hover:bg-blue-700"
                                >
                                    Enregistrer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
