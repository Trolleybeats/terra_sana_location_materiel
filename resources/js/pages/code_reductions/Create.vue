<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    type_reductions: {
        type: Array,
        default: () => [],
    },
    users: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    code: '',
    type_reduction_id: '',
    montant: '',
    hors_tva: false,
    date_debut: '',
    date_fin: '',
    utilisation_max: '',
    user_id: '',
});

const submitForm = () => {
    form.post('/code_reductions', {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <AppLayout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-2xl font-bold">Créer un Code de Réduction</h1>
            <form @submit.prevent="submitForm" class="space-y-6">
                <div>
                    <label
                        for="code"
                        class="block text-sm font-medium text-gray-700"
                        >Code de Réduction</label
                    >
                    <input
                        v-model="form.code"
                        type="text"
                        id="code"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    />
                    <div
                        v-if="form.errors.code"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.code }}
                    </div>
                </div>
                <div>
                    <label
                        for="type_reduction_id"
                        class="block text-sm font-medium text-gray-700"
                        >Type de Réduction</label
                    >
                    <select
                        v-model="form.type_reduction_id"
                        id="type_reduction_id"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    >
                        <option value="" disabled>
                            -- Sélectionnez un type --
                        </option>
                        <option
                            v-for="type in type_reductions"
                            :key="type.id"
                            :value="type.id"
                        >
                            {{ type.reduction }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.type_reduction_id"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.type_reduction_id }}
                    </div>
                </div>
                <div>
                    <label
                        for="montant"
                        class="block text-sm font-medium text-gray-700"
                        >Montant de la Réduction</label
                    >
                    <input
                        v-model="form.montant"
                        type="number"
                        step="0.01"
                        id="montant"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    />
                    <div
                        v-if="form.errors.montant"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.montant }}
                    </div>
                </div>
                <div>
                    <label
                        class="flex items-center text-sm font-medium text-gray-700"
                    >
                        <input
                            v-model="form.hors_tva"
                            type="checkbox"
                            class="focus:ring-opacity-50 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring focus:ring-indigo-200"
                        />
                        <span class="ml-2">Hors TVA</span>
                    </label>
                </div>
                <div>
                    <label
                        for="date_debut"
                        class="block text-sm font-medium text-gray-700"
                        >Date de Début</label
                    >
                    <input
                        v-model="form.date_debut"
                        type="date"
                        id="date_debut"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    />
                    <div
                        v-if="form.errors.date_debut"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.date_debut }}
                    </div>
                </div>
                <div>
                    <label
                        for="date_fin"
                        class="block text-sm font-medium text-gray-700"
                        >Date de Fin</label
                    >
                    <input
                        v-model="form.date_fin"
                        type="date"
                        id="date_fin"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    />
                    <div
                        v-if="form.errors.date_fin"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.date_fin }}
                    </div>
                </div>
                <div>
                    <label
                        for="utilisation_max"
                        class="block text-sm font-medium text-gray-700"
                        >Utilisations Max</label
                    >
                    <input
                        v-model="form.utilisation_max"
                        type="number"
                        id="utilisation_max"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    />
                    <div
                        v-if="form.errors.utilisation_max"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.utilisation_max }}
                    </div>
                </div>
                <div>
                    <label
                        for="user_id"
                        class="block text-sm font-medium text-gray-700"
                        >Attribuer à un Utilisateur</label
                    >
                    <select
                        v-model="form.user_id"
                        id="user_id"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                    >
                        <option value="">-- Tous les utilisateurs --</option>
                        <option
                            v-for="user in users"
                            :key="user.id"
                            :value="user.id"
                        >
                            {{ user.name }} ({{ user.email }})
                        </option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500">
                        Laissez vide pour un code accessible à tous les
                        utilisateurs. Sélectionnez un utilisateur pour lui
                        attribuer ce code spécifiquement.
                    </p>
                    <div
                        v-if="form.errors.user_id"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.user_id }}
                    </div>
                </div>
                <div>
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase hover:bg-blue-700"
                    >
                        Créer le Code de Réduction
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
