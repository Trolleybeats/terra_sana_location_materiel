<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    materiel: Object,
    categories: Array,
    photos: Array,
});

const retourListe = () => {
    router.visit('/materiels');
};

const modifierMateriel = () => {
    router.visit(`/materiels/${props.materiel.id}/edit`);
};
</script>
<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-3xl font-bold">Détails du Matériel</h1>
                <button
                    @click="retourListe"
                    class="rounded bg-gray-500 px-4 py-2 text-white hover:bg-gray-600"
                >
                    Retour à la liste
                </button>
            </div>

            <div v-if="materiel" class="rounded-lg bg-white p-6 shadow">
                <!-- Photos -->
                <div v-if="photos && photos.length > 0" class="mb-6">
                    <h3 class="mb-3 text-lg font-semibold">
                        Photos du matériel ({{ photos.length }})
                    </h3>
                    <div
                        class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4"
                    >
                        <img
                            v-for="photo in photos"
                            :key="photo.id"
                            :src="photo.url_photo"
                            :alt="materiel.nom"
                            class="h-48 w-full rounded-lg object-cover shadow"
                        />
                    </div>
                </div>
                <div
                    v-else
                    class="mb-6 rounded-lg bg-gray-50 p-4 text-center text-gray-500"
                >
                    Aucune photo pour ce matériel.
                </div>

                <!-- Informations principales -->
                <h2 class="mb-4 text-2xl font-semibold">
                    {{ materiel.nom }}
                </h2>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <p class="mb-2">
                            <strong>Catégorie:</strong>
                            {{ materiel.categorie?.nom || 'N/A' }}
                        </p>
                        <p class="mb-2">
                            <strong>Description:</strong>
                            {{ materiel.description || 'Aucune description' }}
                        </p>
                        <p class="mb-2">
                            <strong>Dimensions:</strong>
                            {{ materiel.dimensions || 'Non spécifiées' }}
                        </p>
                    </div>

                    <div>
                        <p class="mb-2">
                            <strong>Prix journalier:</strong>
                            {{
                                new Intl.NumberFormat('fr-FR', {
                                    style: 'currency',
                                    currency: 'EUR',
                                }).format(materiel.prix_journalier)
                            }}
                        </p>
                        <p class="mb-2">
                            <strong>Stock total:</strong>
                            {{ materiel.stock_total }}
                        </p>
                        <p class="mb-2">
                            <strong>Stock disponible:</strong>
                            {{ materiel.stock_disponible }}
                        </p>
                        <p>
                            <strong>Disponibilité:</strong>
                            <span
                                :class="
                                    materiel.stock_disponible > 0
                                        ? 'text-green-600'
                                        : 'text-red-600'
                                "
                            >
                                {{
                                    materiel.stock_disponible > 0
                                        ? 'Disponible'
                                        : 'Indisponible'
                                }}
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-6 flex gap-4">
                    <button
                        @click="modifierMateriel"
                        class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                    >
                        Modifier
                    </button>
                </div>
            </div>

            <div v-else class="py-12 text-center">
                <p class="mb-4 text-xl text-gray-600">Aucun matériel trouvé.</p>
            </div>
        </section>
    </AppLayout>
</template>
