<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { type PropType } from 'vue';

interface Fonction {
    id: number;
    fonction: string;
}

const props = defineProps({
    contactPro: {
        type: Object as PropType<{
            id: number;
            professionnel_id: number;
            nom: string;
            prenom: string;
            email: string;
            telephone: string;
            fonction_id: number;
        }>,
        required: true,
    },
    fonctions: {
        type: Array as PropType<Fonction[]>,
        default: () => [],
    },
});

const form = useForm({
    professionnel_id: props.contactPro.professionnel_id,
    nom: props.contactPro.nom,
    prenom: props.contactPro.prenom,
    email: props.contactPro.email,
    telephone: props.contactPro.telephone,
    fonction_id: props.contactPro.fonction_id,
});

function submit() {
    form.put(`/contact_pro/${props.contactPro.id}`);
}
</script>

<template>
    <AppLayout>
        <section class="max-w-7xl py-10 sm:px-6 lg:px-8">
            <h2 class="text-xl leading-tight font-semibold text-gray-800">
                Modifier le contact professionnel
            </h2>

            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                    >
                        <div class="border-b border-gray-200 bg-white p-6">
                            <form @submit.prevent="submit">
                                <div class="mb-4">
                                    <label
                                        for="nom"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Nom
                                    </label>
                                    <input
                                        v-model="form.nom"
                                        type="text"
                                        id="nom"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    />
                                    <div
                                        v-if="form.errors.nom"
                                        class="mt-1 text-sm text-red-600"
                                    >
                                        {{ form.errors.nom }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label
                                        for="prenom"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Prénom
                                    </label>
                                    <input
                                        v-model="form.prenom"
                                        type="text"
                                        id="prenom"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    />
                                    <div
                                        v-if="form.errors.prenom"
                                        class="mt-1 text-sm text-red-600"
                                    >
                                        {{ form.errors.prenom }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label
                                        for="email"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Email
                                    </label>
                                    <input
                                        v-model="form.email"
                                        type="email"
                                        id="email"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    />
                                    <div
                                        v-if="form.errors.email"
                                        class="mt-1 text-sm text-red-600"
                                    >
                                        {{ form.errors.email }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label
                                        for="telephone"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Téléphone
                                    </label>
                                    <input
                                        v-model="form.telephone"
                                        type="text"
                                        id="telephone"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    />
                                    <div
                                        v-if="form.errors.telephone"
                                        class="mt-1 text-sm text-red-600"
                                    >
                                        {{ form.errors.telephone }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label
                                        for="fonction_id"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Fonction
                                    </label>
                                    <select
                                        v-model="form.fonction_id"
                                        id="fonction_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
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
                                    <div
                                        v-if="form.errors.fonction_id"
                                        class="mt-1 text-sm text-red-600"
                                    >
                                        {{ form.errors.fonction_id }}
                                    </div>
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
        </section></AppLayout
    >
</template>
