<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

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
    photos: [] as File[],
});

const photosPreview = ref<string[]>([]);

function handlePhotoChange(event: Event) {
    const target = event.target as HTMLInputElement;
    if (target.files) {
        const files = Array.from(target.files);
        form.photos = files;

        // Créer les previews
        photosPreview.value = [];
        files.forEach((file) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                if (e.target?.result) {
                    photosPreview.value.push(e.target.result as string);
                }
            };
            reader.readAsDataURL(file);
        });
    }
}

function removePhoto(index: number) {
    const dt = new DataTransfer();
    const files = Array.from(form.photos);
    files.splice(index, 1);
    files.forEach((file) => dt.items.add(file));
    form.photos = Array.from(dt.files);
    photosPreview.value.splice(index, 1);
}

function submit() {
    form.post('/materiels', {
        onSuccess: () => {
            form.reset();
            photosPreview.value = [];
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

                <div>
                    <label
                        for="photos"
                        class="block text-sm font-medium text-gray-700"
                        >Photos du matériel</label
                    >
                    <input
                        @change="handlePhotoChange"
                        type="file"
                        id="photos"
                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                        multiple
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    />
                    <p class="mt-1 text-xs text-gray-500">
                        Vous pouvez sélectionner plusieurs photos (JPEG, PNG,
                        JPG, GIF, WEBP - max 2MB chacune)
                    </p>
                    <div
                        v-if="form.errors.photos"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.photos }}
                    </div>

                    <!-- Preview des photos -->
                    <div
                        v-if="photosPreview.length > 0"
                        class="mt-4 grid grid-cols-2 gap-4 md:grid-cols-4"
                    >
                        <div
                            v-for="(preview, index) in photosPreview"
                            :key="index"
                            class="group relative"
                        >
                            <img
                                :src="preview"
                                :alt="`Preview ${index + 1}`"
                                class="h-32 w-full rounded-lg object-cover shadow"
                            />
                            <button
                                @click.prevent="removePhoto(index)"
                                type="button"
                                class="absolute top-1 right-1 rounded-full bg-red-500 p-1 text-white opacity-0 transition-opacity group-hover:opacity-100 hover:bg-red-600"
                                title="Retirer cette photo"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </div>
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
