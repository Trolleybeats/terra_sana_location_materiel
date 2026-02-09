<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { reactive, watch } from 'vue';

const props = defineProps<{
    materiels: any[];
    categories: { id: number; nom: string }[];
    filters: {
        categorie?: string;
        prix?: string;
    };
}>();

const form = reactive({
    categorie: props.filters.categorie ?? '',
    prix: props.filters.prix ?? '',
});

function applyFilters() {
    router.get(
        '/materiels',
        { ...form },
        { preserveState: true, replace: true },
    );
}

function resetFilters() {
    form.categorie = '';
    form.prix = '';
    applyFilters();
}
</script>
<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Matériels</h1>
            <button
                class="mb-4 rounded-md bg-green-600 px-4 py-2 text-white hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:outline-none"
                @click="$inertia.visit('/materiels/create')"
            >
                Ajouter un matériel
            </button>
            <p>Liste des matériels disponibles à la location.</p>

            <!--Filtre de recherche-->

            <form
                class="mt-4 flex items-center space-x-4"
                @submit.prevent="applyFilters"
            >
                <select
                    v-model="form.categorie"
                    class="rounded-md border-gray-300 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Toutes les catégories</option>
                    <option
                        v-for="cat in categories"
                        :key="cat.id"
                        :value="cat.id"
                    >
                        {{ cat.nom }}
                    </option>
                </select>
                <select
                    v-model="form.prix"
                    class="rounded-md border-gray-300 text-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Tous les prix</option>
                    <option value="0-50">0 - 50 €</option>
                    <option value="50-100">50 - 100 €</option>
                    <option value="100-200">100 - 200 €</option>
                    <option value="200+">200 € et plus</option>
                </select>
                <button
                    type="submit"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                >
                    Rechercher
                </button>
                <button
                    type="button"
                    class="rounded-md bg-gray-200 px-4 py-2 text-gray-700 hover:bg-gray-300 focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:outline-none"
                    @click="resetFilters"
                >
                    Réinitialiser
                </button>
            </form>

            <!-- Table des matériels -->

            <table class="mt-4 min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                        >
                            ID
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                        >
                            Catégorie
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                        >
                            Nom
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                        >
                            Description
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                        >
                            Prix journalier
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                        >
                            Dimensions
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                        >
                            Stock total
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                        >
                            Stock disponible
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="materiel in materiels" :key="materiel.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ materiel.id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{
                                materiel.categorie
                                    ? materiel.categorie.nom
                                    : 'Inconnu'
                            }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ materiel.nom }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ materiel.description }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ materiel.prix_journalier }} €
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ materiel.dimensions }} cm
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ materiel.stock_total }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ materiel.stock_disponible }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </AppLayout>
</template>
