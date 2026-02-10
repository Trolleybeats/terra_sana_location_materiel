<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
const props = defineProps({
    user_id: {
        type: [String, Number],
        default: '',
    },
    pays: {
        type: Array,
        default: () => [],
    },
    communes: {
        type: Array,
        default: () => [],
    },
    langues: {
        type: Array,
        default: () => [],
    },
});
const form = useForm({
    // Définir les champs du formulaire pour les professionnels
    user_id: props.user_id || '',
    nom_societe: '',
    nom_rue_siege: '',
    numero_rue_siege: '',
    nom_commune_siege_id: '',
    numero_commune_siege_id: '',
    nom_rue_livraison: '',
    numero_rue_livraison: '',
    nom_commune_livraison_id: '',
    numero_commune_livraison_id: '',
    pays_id: '',
    heure_ouverture: '',
    minute_ouverture: '',
    heure_fermeture: '',
    minute_fermeture: '',
    langue_id: '',
});

// Champs pour afficher les codes postaux (non envoyés au serveur)
const codePostalSiege = ref('');
const codePostalLivraison = ref('');

const submit = () => {
    form.post('/professionnels', {
        onSuccess: () => {
            form.reset();
        },
        onError: (errors) => {
            // Gérer les erreurs de validation si nécessaire
            console.log(errors);
        },
    });
};

// Fonction pour mettre à jour automatiquement le code postal
const updateCodePostalSiege = () => {
    const selectedCommune = props.communes.find(
        (commune) => commune.id === form.nom_commune_siege_id,
    );
    if (selectedCommune) {
        // Les deux champs doivent contenir l'ID de la commune
        form.numero_commune_siege_id = selectedCommune.id;
        // Afficher le code postal séparément
        codePostalSiege.value = selectedCommune.numero_commune;
    }
};

const updateCodePostalLivraison = () => {
    const selectedCommune = props.communes.find(
        (commune) => commune.id === form.nom_commune_livraison_id,
    );
    if (selectedCommune) {
        // Les deux champs doivent contenir l'ID de la commune
        form.numero_commune_livraison_id = selectedCommune.id;
        // Afficher le code postal séparément
        codePostalLivraison.value = selectedCommune.numero_commune;
    }
};
</script>
<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Formulaire Professionnels</h1>
            <!-- Contenu de la page des professionnels -->
            <form @submit.prevent="submit">
                <!-- Champs du formulaire pour les professionnels -->
                <div class="mb-4">
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
                <div class="mb-4">
                    <label
                        for="nom_societe"
                        class="mb-2 block font-medium text-gray-700"
                        >Nom de la société</label
                    >
                    <input
                        type="text"
                        id="nom_societe"
                        name="nom_societe"
                        v-model="form.nom_societe"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                    <div
                        v-if="form.errors.nom_societe"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.nom_societe }}
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        for="nom_rue_siege"
                        class="mb-2 block font-medium text-gray-700"
                        >Nom de la rue (siège)</label
                    >
                    <input
                        type="text"
                        id="nom_rue_siege"
                        name="nom_rue_siege"
                        v-model="form.nom_rue_siege"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                    <div
                        v-if="form.errors.nom_rue_siege"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.nom_rue_siege }}
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        for="numero_rue_siege"
                        class="mb-2 block font-medium text-gray-700"
                        >Numéro de la rue (siège)</label
                    >
                    <input
                        type="text"
                        id="numero_rue_siege"
                        name="numero_rue_siege"
                        v-model="form.numero_rue_siege"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                    <div
                        v-if="form.errors.numero_rue_siege"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.numero_rue_siege }}
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        for="nom_commune_siege_id"
                        class="mb-2 block font-medium text-gray-700"
                        >Nom de la commune (siège)</label
                    >
                    <select
                        id="nom_commune_siege_id"
                        name="nom_commune_siege_id"
                        v-model="form.nom_commune_siege_id"
                        @change="updateCodePostalSiege"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    >
                        <option value="">Choisir une commune</option>
                        <option
                            v-for="commune in communes"
                            :key="commune.id"
                            :value="commune.id"
                        >
                            {{ commune.nom_commune }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.nom_commune_siege_id"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.nom_commune_siege_id }}
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        for="code_postal_siege"
                        class="mb-2 block font-medium text-gray-700"
                        >Code Postal (siège)</label
                    >
                    <input
                        type="text"
                        id="code_postal_siege"
                        name="code_postal_siege"
                        v-model="codePostalSiege"
                        readonly
                        placeholder="Sélectionnez une commune"
                        class="w-full cursor-not-allowed rounded border border-gray-300 bg-gray-100 px-3 py-2 focus:outline-none"
                    />
                </div>
                <div class="mb-4">
                    <label
                        for="nom_rue_livraison"
                        class="mb-2 block font-medium text-gray-700"
                        >Nom de la rue (livraison)</label
                    >
                    <input
                        type="text"
                        id="nom_rue_livraison"
                        name="nom_rue_livraison"
                        v-model="form.nom_rue_livraison"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                    <div
                        v-if="form.errors.nom_rue_livraison"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.nom_rue_livraison }}
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        for="numero_rue_livraison"
                        class="mb-2 block font-medium text-gray-700"
                        >Numéro de la rue (livraison)</label
                    >
                    <input
                        type="number"
                        id="numero_rue_livraison"
                        name="numero_rue_livraison"
                        v-model="form.numero_rue_livraison"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                    <div
                        v-if="form.errors.numero_rue_livraison"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.numero_rue_livraison }}
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        for="nom_commune_livraison_id"
                        class="mb-2 block font-medium text-gray-700"
                        >Nom de la commune (livraison)</label
                    >
                    <select
                        id="nom_commune_livraison_id"
                        name="nom_commune_livraison_id"
                        v-model="form.nom_commune_livraison_id"
                        @change="updateCodePostalLivraison"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    >
                        <option value="" disabled>Choisir une commune</option>
                        <option
                            v-for="commune in communes"
                            :key="commune.id"
                            :value="commune.id"
                        >
                            {{ commune.nom_commune }}
                        </option>
                    </select>
                    <div
                        v-if="form.errors.nom_commune_livraison_id"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.nom_commune_livraison_id }}
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        for="code_postal_livraison"
                        class="mb-2 block font-medium text-gray-700"
                        >Code Postal (livraison)</label
                    >
                    <input
                        type="text"
                        id="code_postal_livraison"
                        name="code_postal_livraison"
                        v-model="codePostalLivraison"
                        readonly
                        placeholder="Sélectionnez une commune"
                        class="w-full cursor-not-allowed rounded border border-gray-300 bg-gray-100 px-3 py-2 focus:outline-none"
                    />
                </div>
                <div class="mb-4">
                    <label
                        for="pays_id"
                        class="mb-2 block font-medium text-gray-700"
                        >Pays</label
                    >
                    <select
                        id="pays_id"
                        name="pays_id"
                        v-model="form.pays_id"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    >
                        <option value="" disabled>Choisir un pays</option>
                        <option
                            v-for="pays in pays"
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
                </div>
                <div class="mb-4">
                    <label
                        for="heure_ouverture"
                        class="mb-2 block font-medium text-gray-700"
                        >Heure d'ouverture</label
                    >
                    <input
                        type="number"
                        id="heure_ouverture"
                        name="heure_ouverture"
                        v-model="form.heure_ouverture"
                        min="0"
                        max="23"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                    <div
                        v-if="form.errors.heure_ouverture"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.heure_ouverture }}
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        for="minute_ouverture"
                        class="mb-2 block font-medium text-gray-700"
                        >Minute d'ouverture</label
                    >
                    <input
                        type="number"
                        id="minute_ouverture"
                        name="minute_ouverture"
                        v-model="form.minute_ouverture"
                        min="0"
                        max="59"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                    <div
                        v-if="form.errors.minute_ouverture"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.minute_ouverture }}
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        for="heure_fermeture"
                        class="mb-2 block font-medium text-gray-700"
                        >Heure de fermeture</label
                    >
                    <input
                        type="number"
                        id="heure_fermeture"
                        name="heure_fermeture"
                        v-model="form.heure_fermeture"
                        min="0"
                        max="23"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                    <div
                        v-if="form.errors.heure_fermeture"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.heure_fermeture }}
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        for="minute_fermeture"
                        class="mb-2 block font-medium text-gray-700"
                        >Minute de fermeture</label
                    >
                    <input
                        type="number"
                        id="minute_fermeture"
                        name="minute_fermeture"
                        v-model="form.minute_fermeture"
                        min="0"
                        max="59"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                    <div
                        v-if="form.errors.minute_fermeture"
                        class="mt-1 text-sm text-red-500"
                    >
                        {{ form.errors.minute_fermeture }}
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        for="langue_id"
                        class="mb-2 block font-medium text-gray-700"
                        >Langue</label
                    >
                    <select
                        id="langue_id"
                        name="langue_id"
                        v-model="form.langue_id"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    >
                        <option value="">Choisir une langue</option>
                        <option
                            v-for="langue in langues"
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
                </div>
                <button
                    type="submit"
                    class="rounded bg-blue-600 px-4 py-2 font-medium text-white hover:bg-blue-700"
                >
                    Soumettre
                </button>
            </form>
        </section>
    </AppLayout>
</template>
