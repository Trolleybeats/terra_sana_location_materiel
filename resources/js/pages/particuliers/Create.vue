<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    user_id: {
        type: [String, Number],
        default: '',
    },
});

const form = useForm({
    // Définir les champs du formulaire pour les particuliers
    user_id: props.user_id || '',
    nom: '',
    prenom: '',
    nom_rue: '',
    numero_rue: '',
    nom_commune_id: '',
    numero_commune_id: '',
    pays_id: '',
    langue_id: '',
});

<<<<<<< Updated upstream
=======
// Fonction pour mettre à jour automatiquement le code postal
const updateCodePostal = () => {
    const selectedCommune = props.communes.find(
        (commune) => commune.id === form.nom_commune_id,
    );
    if (selectedCommune) {
        form.numero_commune_id = selectedCommune.id;
    }
};

// Propriété computed pour afficher le code postal
const codePostal = computed(() => {
    const selectedCommune = props.communes.find(
        (commune) => commune.id === form.nom_commune_id,
    );
    return selectedCommune ? selectedCommune.numero_commune : '';
});

>>>>>>> Stashed changes
const submit = () => {
    form.post('/particuliers', {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Formulaire Particuliers</h1>
            <!-- Contenu de la page des particuliers -->
            <form @submit.prevent="submit">
                <!-- Champs du formulaire pour les particuliers -->
                <div>
                    <label
                        for="user_id"
                        class="mb-2 block font-medium text-gray-700"
                        >User ID</label
                    >
                    <input
                        type="text"
                        id="user_id"
                        name="user_id"
                        v-model="form.user_id"
                        required
                        :readonly="!!props.user_id"
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                        :class="{
                            'cursor-not-allowed bg-gray-100': !!props.user_id,
                        }"
                    />
                </div>
                <div>
                    <label
                        for="nom"
                        class="mb-2 block font-medium text-gray-700"
                        >Nom</label
                    >
                    <input
                        type="text"
                        id="nom"
                        name="nom"
                        v-model="form.nom"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
<<<<<<< Updated upstream
=======
                    <div
                        v-if="form.errors.nom"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.nom }}
                    </div>
>>>>>>> Stashed changes
                </div>
                <div>
                    <label
                        for="prenom"
                        class="mb-2 block font-medium text-gray-700"
                        >Prénom</label
                    >
                    <input
                        type="text"
                        id="prenom"
                        name="prenom"
                        v-model="form.prenom"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
<<<<<<< Updated upstream
=======
                    <div
                        v-if="form.errors.prenom"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.prenom }}
                    </div>
>>>>>>> Stashed changes
                </div>
                <div>
                    <label
                        for="nom_rue"
                        class="mb-2 block font-medium text-gray-700"
                        >Nom de la rue</label
                    >
                    <input
                        type="text"
                        id="nom_rue"
                        name="nom_rue"
                        v-model="form.nom_rue"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
<<<<<<< Updated upstream
=======
                    <div
                        v-if="form.errors.nom_rue"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.nom_rue }}
                    </div>
>>>>>>> Stashed changes
                </div>
                <div>
                    <label
                        for="numero_rue"
                        class="mb-2 block font-medium text-gray-700"
                        >Numéro de la rue</label
                    >
                    <input
                        type="number"
                        id="numero_rue"
                        name="numero_rue"
                        v-model="form.numero_rue"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
<<<<<<< Updated upstream
=======
                    <div
                        v-if="form.errors.numero_rue"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.numero_rue }}
                    </div>
>>>>>>> Stashed changes
                </div>
                <div>
                    <label
                        for="nom_commune_id"
                        class="mb-2 block font-medium text-gray-700"
                        >Nom de la commune ID</label
                    >
                    <input
                        type="text"
                        id="nom_commune_id"
                        name="nom_commune_id"
                        v-model="form.nom_commune_id"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
<<<<<<< Updated upstream
                    />
=======
                    >
                        <option value="">Sélectionnez une commune</option>
                        <option
                            v-for="commune in props.communes"
                            :key="commune.id"
                            :value="commune.id"
                        >
                            {{ commune.nom_commune }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.nom_commune_id"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.nom_commune_id }}
                    </div>
>>>>>>> Stashed changes
                </div>
                <div>
                    <label
                        for="code_postal"
                        class="mb-2 block font-medium text-gray-700"
                        >Numéro de la commune ID</label
                    >
                    <input
<<<<<<< Updated upstream
                        type="text"
                        id="numero_commune_id"
                        name="numero_commune_id"
                        v-model="form.numero_commune_id"
=======
                        type="number"
                        id="code_postal"
                        name="code_postal"
                        :value="codePostal"
>>>>>>> Stashed changes
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                </div>
                <div>
                    <label
                        for="pays_id"
                        class="mb-2 block font-medium text-gray-700"
                        >Pays ID</label
                    >
                    <input
                        type="text"
                        id="pays_id"
                        name="pays_id"
                        v-model="form.pays_id"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
<<<<<<< Updated upstream
                    />
=======
                    >
                        <option value="">Sélectionnez un pays</option>
                        <option
                            v-for="pays in props.pays"
                            :key="pays.id"
                            :value="pays.id"
                        >
                            {{ pays.nom_pays }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.pays_id"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.pays_id }}
                    </div>
>>>>>>> Stashed changes
                </div>
                <div>
                    <label
                        for="langue_id"
                        class="mb-2 block font-medium text-gray-700"
                        >Langue ID</label
                    >
                    <input
                        type="text"
                        id="langue_id"
                        name="langue_id"
                        v-model="form.langue_id"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
<<<<<<< Updated upstream
                    />
=======
                    >
                        <option value="">Sélectionnez une langue</option>
                        <option
                            v-for="langue in props.langues"
                            :key="langue.id"
                            :value="langue.id"
                        >
                            {{ langue.langue }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.langue_id"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.langue_id }}
                    </div>
>>>>>>> Stashed changes
                </div>
                <button
                    type="submit"
                    class="mt-4 rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                >
                    Soumettre
                </button>
            </form>
        </section>
    </AppLayout>
</template>
