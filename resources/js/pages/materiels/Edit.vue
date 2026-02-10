<script setup lang="ts">
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps<{
    materiel: any;
    categories: { id: number; nom: string }[];
}>();

const form = reactive({
    categorie_id: props.materiel.categorie_id,
    nom: props.materiel.nom,
    description: props.materiel.description,
    prix_journalier: props.materiel.prix_journalier,
    dimensions: props.materiel.dimensions,
    stock_total: props.materiel.stock_total,
    stock_disponible: props.materiel.stock_disponible,
});

function updateMateriel() {
    router.put(`/materiels/${props.materiel.id}`, form, {
        onSuccess: () => {
            // Gérer le succès, par exemple afficher un message ou rediriger
            console.log('Matériel mis à jour avec succès');
        },
        onError: (errors) => {
            // Gérer les erreurs, par exemple afficher un message d'erreur
            console.error('Erreur lors de la mise à jour du matériel:', errors);
        },
    });
}
</script>

<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-2xl font-bold">Modifier le matériel</h1>
            <form @submit.prevent="updateMateriel" class="space-y-6">
                <div>
                    <label
                        for="categorie_id"
                        class="block text-sm font-medium text-gray-700"
                        >Catégorie</label
                    >
                    <select
                        id="categorie_id"
                        v-model="form.categorie_id"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                    >
                        <option
                            v-for="categorie in categories"
                            :key="categorie.id"
                            :value="categorie.id"
                        >
                            {{ categorie.nom }}
                        </option>
                    </select>
                </div>
                <div>
                    <label
                        for="nom"
                        class="block text-sm font-medium text-gray-700"
                        >Nom</label
                    >
                    <input
                        type="text"
                        id="nom"
                        v-model="form.nom"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                    />
                </div>
                <div>
                    <label
                        for="description"
                        class="block text-sm font-medium text-gray-700"
                        >Description</label
                    >
                    <textarea
                        id="description"
                        v-model="form.description"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                    ></textarea>
                </div>
                <div>
                    <label
                        for="prix_journalier"
                        class="text sm block font-medium text-gray-700"
                        >Prix journalier</label
                    >
                    <input
                        type="number"
                        id="prix_journalier"
                        v-model="form.prix_journalier"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                    />
                </div>
                <div>
                    <label
                        for="dimensions"
                        class="block text-sm font-medium text-gray-700"
                        >Dimensions</label
                    >
                    <input
                        type="text"
                        id="dimensions"
                        v-model="form.dimensions"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                    />
                </div>
                <div>
                    <label
                        for="stock_total"
                        class="block text-sm font-medium text-gray-700"
                        >Stock total</label
                    >
                    <input
                        type="number"
                        id="stock_total"
                        v-model="form.stock_total"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                    />
                </div>
                <div>
                    <label
                        for="stock_disponible"
                        class="block text-sm font-medium text-gray-700"
                        >Stock disponible</label
                    >
                    <input
                        type="number"
                        id="stock_disponible"
                        v-model="form.stock_disponible"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                    />
                </div>
                <div>
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 font-semibold text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                    >
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </section>
    </AppLayout>
</template>
