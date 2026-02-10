<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Professionnel, Commune, Langue, Pays } from '@/types';
import { computed, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    professionnel: Professionnel;
    communes: Commune[];
    langues: Langue[];
    pays: Pays[];
}>();

// Initialiser le formulaire avec les données existantes du professionnel
const form = useForm({
    user_id: props.professionnel.user_id,
    nom_societe: props.professionnel.nom_societe,
    nom_rue_siege: props.professionnel.nom_rue_siege,
    numero_rue_siege: props.professionnel.numero_rue_siege,
    nom_commune_siege_id: props.professionnel.nom_commune_siege_id,
    numero_commune_siege_id: props.professionnel.numero_commune_siege_id,
    nom_rue_livraison: props.professionnel.nom_rue_livraison,
    numero_rue_livraison: props.professionnel.numero_rue_livraison,
    nom_commune_livraison_id: props.professionnel.nom_commune_livraison_id,
    numero_commune_livraison_id:
        props.professionnel.numero_commune_livraison_id,
    heure_ouverture: props.professionnel.heure_ouverture,
    minute_ouverture: props.professionnel.minute_ouverture,
    heure_fermeture: props.professionnel.heure_fermeture,
    minute_fermeture: props.professionnel.minute_fermeture,
    pays_id: props.professionnel.pays_id,
    langue_id: props.professionnel.langue_id,
});

// Calculer le code postal du siège basé sur la commune sélectionnée
const codePostalSiege = computed(() => {
    const commune = props.communes.find(
        (c) => c.id === form.nom_commune_siege_id,
    );
    return commune ? commune.numero_commune : '';
});

// Calculer le code postal de livraison basé sur la commune sélectionnée
const codePostalLivraison = computed(() => {
    const commune = props.communes.find(
        (c) => c.id === form.nom_commune_livraison_id,
    );
    return commune ? commune.numero_commune : '';
});

// Mettre à jour automatiquement le numero_commune_siege_id quand la commune change
watch(
    () => form.nom_commune_siege_id,
    (newValue) => {
        const selectedCommune = props.communes.find((c) => c.id === newValue);
        if (selectedCommune) {
            form.numero_commune_siege_id = selectedCommune.id;
        }
    },
);

// Mettre à jour automatiquement le numero_commune_livraison_id quand la commune change
watch(
    () => form.nom_commune_livraison_id,
    (newValue) => {
        const selectedCommune = props.communes.find((c) => c.id === newValue);
        if (selectedCommune) {
            form.numero_commune_livraison_id = selectedCommune.id;
        }
    },
);

const submit = () => {
    form.put(`/professionnels/${props.professionnel.id}`, {
        onSuccess: () => {
            // Redirection ou message de succès géré par le backend
            form.reset();
        },
        onError: (errors) => {
            console.error('Erreurs de validation:', errors);
        },
    });
};
</script>
<template>
    <AppLayout>
        <section class="mx-auto max-w-4xl px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Modifier le Professionnel</h1>
            <!-- Formulaire de modification du professionnel -->
            <div class="rounded-lg bg-white p-6 shadow-md">
                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label
                            for="nom_societe"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Nom de la Société
                        </label>
                        <input
                            type="text"
                            id="nom_societe"
                            v-model="form.nom_societe"
                            class="w-full rounded border border-gray-300 p-2"
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
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Nom de Rue Siège
                        </label>
                        <input
                            type="text"
                            id="nom_rue_siege"
                            v-model="form.nom_rue_siege"
                            class="w-full rounded border border-gray-300 p-2"
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
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Numéro de Rue Siège
                        </label>
                        <input
                            type="text"
                            id="numero_rue_siege"
                            v-model="form.numero_rue_siege"
                            class="w-full rounded border border-gray-300 p-2"
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
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Commune de Siège
                        </label>
                        <select
                            id="nom_commune_siege_id"
                            name="nom_commune_siege_id"
                            v-model="form.nom_commune_siege_id"
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
                            for="numero_commune_siege_id"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Code postal du Siège
                        </label>
                        <input
                            type="number"
                            id="numero_commune_siege_id"
                            :value="codePostalSiege"
                            readonly
                            class="w-full cursor-not-allowed rounded border border-gray-300 bg-gray-100 px-3 py-2 focus:outline-none"
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="nom_rue_livraison"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Nom de Rue Livraison
                        </label>
                        <input
                            type="text"
                            id="nom_rue_livraison"
                            v-model="form.nom_rue_livraison"
                            class="w-full rounded border border-gray-300 p-2"
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
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Numéro de Rue Livraison
                        </label>
                        <input
                            type="text"
                            id="numero_rue_livraison"
                            v-model="form.numero_rue_livraison"
                            class="w-full rounded border border-gray-300 p-2"
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
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Commune de Livraison
                        </label>
                        <select
                            id="nom_commune_livraison_id"
                            name="nom_commune_livraison_id"
                            v-model="form.nom_commune_livraison_id"
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
                            v-if="form.errors.nom_commune_livraison_id"
                            class="mt-1 text-sm text-red-500"
                        >
                            {{ form.errors.nom_commune_livraison_id }}
                        </div>
                    </div>
                    <div class="mb-4">
                        <label
                            for="numero_commune_livraison_id"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Code postal de Livraison
                        </label>
                        <input
                            type="number"
                            id="numero_commune_livraison_id"
                            :value="codePostalLivraison"
                            readonly
                            class="w-full cursor-not-allowed rounded border border-gray-300 bg-gray-100 px-3 py-2 focus:outline-none"
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="heure_ouverture"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Heure d'Ouverture
                        </label>
                        <input
                            type="number"
                            id="heure_ouverture"
                            v-model="form.heure_ouverture"
                            class="w-full rounded border border-gray-300 p-2"
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
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Minute d'Ouverture
                        </label>
                        <input
                            type="number"
                            id="minute_ouverture"
                            v-model="form.minute_ouverture"
                            class="w-full rounded border border-gray-300 p-2"
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
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Heure de Fermeture
                        </label>
                        <input
                            type="number"
                            id="heure_fermeture"
                            v-model="form.heure_fermeture"
                            class="w-full rounded border border-gray-300 p-2"
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
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Minute de Fermeture
                        </label>
                        <input
                            type="number"
                            id="minute_fermeture"
                            v-model="form.minute_fermeture"
                            class="w-full rounded border border-gray-300 p-2"
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
                            for="pays_id"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Pays
                        </label>
                        <select
                            id="pays_id"
                            name="pays_id"
                            v-model="form.pays_id"
                            class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                        >
                            <option value="">Choisir un pays</option>
                            <option v-for="p in pays" :key="p.id" :value="p.id">
                                {{ p.nom_pays }}
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
                            for="langue_id"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Langue
                        </label>
                        <select
                            id="langue_id"
                            name="langue_id"
                            v-model="form.langue_id"
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
                        class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                    >
                        Enregistrer les modifications
                    </button>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
