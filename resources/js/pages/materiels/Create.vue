<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    categories: { id: number; nom: string }[];
}>();

const form = useForm({
    nom: '',
    description: '',
    prix_journalier: '',
    categorie_id: '',
    dimensions: '',
    stock_total: '',
    stock_disponible: '',
});

function submit() {
    form.post('/materiels', {
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>

<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Ajouter un matériel</h1>
            <p>
                Remplissez le formulaire ci-dessous pour ajouter un nouveau
                matériel à la location.
            </p>

            <form @submit.prevent="submit" class="mt-6 space-y-6">
                <div>
                    <label
                        for="nom"
                        class="block text-sm font-medium text-gray-700"
                        >Nom</label
                    >
                    <input
                        v-model="form.nom"
                        type="text"
                        id="nom"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required
                    />
                    <div
                        v-if="form.errors.nom"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.nom }}
                    </div>
                </div>

                <div>
                    <label
                        for="description"
                        class="block text-sm font-medium text-gray-700"
                        >Description</label
                    >
                    <textarea
                        v-model="form.description"
                        id="description"
                        rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    ></textarea>
                    <div
                        v-if="form.errors.description"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.description }}
                    </div>
                </div>

                <div>
                    <label
                        for="prix_journalier"
                        class="block text-sm font-medium text-gray-700"
                        >Prix journalier (€)</label
                    >
                    <input
                        v-model="form.prix_journalier"
                        type="number"
                        step="0.01"
                        id="prix_journalier"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required
                    />
                    <div
                        v-if="form.errors.prix_journalier"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.prix_journalier }}
                    </div>
                </div>

                <div>
                    <label
                        for="categorie_id"
                        class="block text-sm font-medium text-gray-700"
                        >Catégorie</label
                    >
                    <select
                        v-model="form.categorie_id"
                        id="categorie_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required
                    >
                        <option value="" disabled>
                            Choisissez une catégorie
                        </option>
                        <option
                            v-for="categorie in props.categories"
                            :key="categorie.id"
                            :value="categorie.id"
                        >
                            {{ categorie.nom }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.categorie_id"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.categorie_id }}
                    </div>
                </div>

                <div>
                    <label
                        for="dimensions"
                        class="block text-sm font-medium text-gray-700"
                        >Dimensions (L x l x H)</label
                    >
                    <input
                        v-model="form.dimensions"
                        type="text"
                        id="dimensions"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    />
                    <div
                        v-if="form.errors.dimensions"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.dimensions }}
                    </div>
                </div>

                <div>
                    <label
                        for="stock_total"
                        class="block text-sm font-medium text-gray-700"
                        >Stock total</label
                    >
                    <input
                        v-model="form.stock_total"
                        type="number"
                        id="stock_total"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required
                    />
                    <div
                        v-if="form.errors.stock_total"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.stock_total }}
                    </div>
                </div>

                <div>
                    <label
                        for="stock_disponible"
                        class="block text-sm font-medium text-gray-700"
                        >Stock disponible</label
                    >
                    <input
                        v-model="form.stock_disponible"
                        type="number"
                        id="stock_disponible"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required
                    />
                    <div
                        v-if="form.errors.stock_disponible"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.stock_disponible }}
                    </div>
                </div>

                <button
                    type="submit"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                >
                    Ajouter le matériel
                </button>
            </form>
        </section>
    </AppLayout>
</template>
