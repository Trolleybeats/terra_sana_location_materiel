<script setup lang="ts">
import { reactive, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps<{
    materiel: any;
    categories: { id: number; nom: string }[];
    photos: any[];
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

const photoInput = ref(null);
const uploading = ref(false);
const uploadMessage = ref('');

function updateMateriel() {
    router.put(`/materiels/${props.materiel.id}`, form, {
        onSuccess: () => {
            console.log('Matériel mis à jour avec succès');
        },
        onError: (errors) => {
            console.error('Erreur lors de la mise à jour du matériel:', errors);
        },
    });
}

function ajouterPhoto() {
    if (
        photoInput.value &&
        photoInput.value.files &&
        photoInput.value.files.length > 0
    ) {
        const formData = new FormData();
        formData.append('photo', photoInput.value.files[0]);
        formData.append('materiel_id', props.materiel.id);

        uploading.value = true;
        uploadMessage.value = '';

        router.post('/photos-materiel', formData, {
            preserveScroll: true,
            onSuccess: () => {
                uploading.value = false;
                uploadMessage.value = 'Photo ajoutée avec succès !';
                if (photoInput.value) {
                    photoInput.value.value = '';
                }
                setTimeout(() => {
                    uploadMessage.value = '';
                }, 3000);
            },
            onError: (errors) => {
                uploading.value = false;
                uploadMessage.value = "Erreur lors de l'ajout de la photo.";
                console.error('Erreur:', errors);
            },
        });
    }
}

function supprimerPhoto(photoId: number) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette photo ?')) {
        router.delete(`/photos-materiel/${photoId}`, {
            preserveScroll: true,
            onSuccess: () => {
                uploadMessage.value = 'Photo supprimée avec succès !';
                setTimeout(() => {
                    uploadMessage.value = '';
                }, 3000);
            },
            onError: (errors) => {
                uploadMessage.value = 'Erreur lors de la suppression.';
                console.error('Erreur:', errors);
            },
        });
    }
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

                <!-- Section Gestion des Photos -->
                <div class="rounded-lg border border-gray-200 p-4">
                    <h3 class="mb-4 text-lg font-semibold">
                        Gestion des photos
                    </h3>

                    <!-- Upload de nouvelles photos -->
                    <div class="mb-4">
                        <label
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            Ajouter une photo
                        </label>
                        <div class="flex items-center gap-4">
                            <input
                                ref="photoInput"
                                type="file"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                class="block w-full rounded-md border border-gray-300 px-3 py-2 text-sm"
                                :disabled="uploading"
                            />
                            <button
                                @click.prevent="ajouterPhoto"
                                :disabled="uploading"
                                type="button"
                                class="rounded bg-green-500 px-4 py-2 whitespace-nowrap text-white hover:bg-green-600 disabled:bg-gray-400"
                            >
                                {{ uploading ? 'Upload...' : 'Ajouter' }}
                            </button>
                        </div>
                        <p
                            v-if="uploadMessage"
                            :class="
                                uploadMessage.includes('succès')
                                    ? 'text-green-600'
                                    : 'text-red-600'
                            "
                            class="mt-2 text-sm"
                        >
                            {{ uploadMessage }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500">
                            Formats acceptés : JPEG, PNG, JPG, GIF, WEBP (max
                            2MB)
                        </p>
                    </div>

                    <!-- Photos existantes -->
                    <div v-if="photos && photos.length > 0">
                        <h4 class="mb-2 text-sm font-medium text-gray-700">
                            Photos actuelles ({{ photos.length }})
                        </h4>
                        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                            <div
                                v-for="photo in photos"
                                :key="photo.id"
                                class="group relative"
                            >
                                <img
                                    :src="photo.url_photo"
                                    :alt="materiel.nom"
                                    class="h-32 w-full rounded-lg object-cover shadow"
                                />
                                <button
                                    @click.prevent="supprimerPhoto(photo.id)"
                                    type="button"
                                    class="absolute top-2 right-2 rounded-full bg-red-500 p-2 text-white opacity-0 transition-opacity group-hover:opacity-100 hover:bg-red-600"
                                    title="Supprimer cette photo"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        v-else
                        class="rounded-lg bg-gray-50 p-4 text-center text-sm text-gray-500"
                    >
                        Aucune photo pour ce matériel.
                    </div>
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
