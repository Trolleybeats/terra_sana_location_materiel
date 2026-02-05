<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Particulier, Commune, Langue, Pays } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

const props = defineProps<{
    particulier: Particulier;
    communes: Commune[];
    langues: Langue[];
    pays: Pays[];
}>();

const form = useForm({
    nom: props.particulier.nom,
    prenom: props.particulier.prenom,
    nom_rue: props.particulier.nom_rue,
    numero_rue: props.particulier.numero_rue,
    nom_commune_id: props.particulier.nom_commune_id,
    numero_commune_id: props.particulier.numero_commune_id,
    pays_id: props.particulier.pays_id,
    langue_id: props.particulier.langue_id,
});

const codePostal = computed(() => {
    const commune = props.communes.find((c) => c.id === form.nom_commune_id);
    return commune ? commune.numero_commune : '';
});

// Mettre à jour automatiquement le numero_commune_id quand la commune change
watch(
    () => form.nom_commune_id,
    (newValue) => {
        const selectedCommune = props.communes.find((c) => c.id === newValue);
        if (selectedCommune) {
            form.numero_commune_id = selectedCommune.id;
        }
    },
);

const submit = () => {
    form.put(`/particuliers/${props.particulier.id}`, {
        onSuccess: () => {
            // Gérer le succès, par exemple afficher un message ou rediriger
            form.reset();
        },
        onError: (errors) => {
            // Gérer les erreurs, par exemple afficher un message d'erreur
            console.error(
                'Erreur lors de la mise à jour du particulier:',
                errors,
            );
        },
    });
};
</script>

<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Modifier le Particulier</h1>
            <div class="rounded-lg bg-white p-6 shadow-md">
                <p class="mb-4"><strong>Id:</strong> {{ particulier.id }}</p>
                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label
                            for="nom"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Nom
                        </label>
                        <input
                            type="text"
                            id="nom"
                            v-model="form.nom"
                            class="w-full rounded border border-gray-300 p-2"
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="prenom"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Prénom
                        </label>
                        <input
                            type="text"
                            id="prenom"
                            v-model="form.prenom"
                            class="w-full rounded border border-gray-300 p-2"
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="nom_rue"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Nom de la rue
                        </label>
                        <input
                            type="text"
                            id="nom_rue"
                            v-model="form.nom_rue"
                            class="w-full rounded border border-gray-300 p-2"
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="numero_rue"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Numéro de la rue
                        </label>
                        <input
                            type="text"
                            id="numero_rue"
                            v-model="form.numero_rue"
                            class="w-full rounded border border-gray-300 p-2"
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="commune"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Commune
                        </label>
                        <select
                            id="commune"
                            v-model="form.nom_commune_id"
                            class="w-full rounded border border-gray-300 p-2"
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
                    </div>
                    <div class="mb-4">
                        <label
                            for="code_postal"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Code Postal
                        </label>
                        <input
                            type="text"
                            id="code_postal"
                            :value="codePostal"
                            readonly
                            class="w-full cursor-not-allowed rounded border border-gray-300 bg-gray-100 p-2"
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="pays"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Pays
                        </label>
                        <select
                            id="pays"
                            v-model="form.pays_id"
                            class="w-full rounded border border-gray-300 p-2"
                        >
                            <option value="">Choisir un pays</option>
                            <option v-for="p in pays" :key="p.id" :value="p.id">
                                {{ p.nom_pays }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label
                            for="langue"
                            class="mb-2 block font-bold text-gray-700"
                        >
                            Langue
                        </label>
                        <select
                            id="langue"
                            v-model="form.langue_id"
                            class="w-full rounded border border-gray-300 p-2"
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
