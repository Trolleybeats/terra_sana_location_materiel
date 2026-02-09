<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps<{
    materiels: any[];
}>();
</script>
<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Matériels</h1>
            <p>Liste des matériels disponibles à la location.</p>

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
                            {{ materiel.dimensions }}
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
