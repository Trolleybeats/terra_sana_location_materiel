<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm, usePage, router } from '@inertiajs/vue3';
import { ref, watch, computed } from 'vue';

const page = usePage();

const props = defineProps({
    commande: {
        type: Object,
        required: false,
        default: null,
    },
    detailsCommandes: {
        type: Array,
        default: () => [],
    },
    statuts: {
        type: Array,
        default: () => [],
    },
    modeLivraison: {
        type: Array,
        default: () => [],
    },
    fraisLivraison: {
        type: Array,
        default: () => [],
    },
    modeRetour: {
        type: Array,
        default: () => [],
    },
    communes: {
        type: Array,
        default: () => [],
    },
    pays: {
        type: Array,
        default: () => [],
    },
});

// Helper function to format date to yyyy-MM-dd
const formatDate = (dateString: string | null) => {
    if (!dateString) return null;
    return dateString.split(' ')[0]; // Extract only the date part
};

const form = useForm({
    user_id: props.commande ? props.commande.user_id : null,
    numero_commande: props.commande ? props.commande.numero_commande : null,
    date_debut: props.commande ? formatDate(props.commande.date_debut) : null,
    date_fin: props.commande ? formatDate(props.commande.date_fin) : null,
    date_commande: props.commande
        ? formatDate(props.commande.date_commande)
        : null,
    statut_id: props.commande ? props.commande.statut_id : null,
    mode_livraison_id: props.commande ? props.commande.mode_livraison_id : null,
    mode_retour_id: props.commande ? props.commande.mode_retour_id : null,
    nom_rue: '',
    numero_rue: null,
    nom_commune_id: props.commande ? props.commande.nom_commune_id : null,
    numero_commune_id: props.commande ? props.commande.numero_commune_id : null,
    pays_id: props.commande ? props.commande.pays_id : null,
    montant_total: props.commande ? props.commande.montant_total : null,
    frais_livraison: props.commande ? props.commande.frais_livraison : null,
    code_reduction_id: null,
    montant_reduction: 0,
});

const codePostal = ref('');
const codeReduction = ref('');
const codeReductionApplique = ref(false);
const messageCodeReduction = ref('');
const typeCodeReduction = ref('');
const isVerifyingCode = ref(false);

// Initialiser le code postal si une commande existe
if (props.commande && props.commande.nom_commune_id) {
    const commune = props.communes.find(
        (c) => c.id === props.commande.nom_commune_id,
    );
    if (commune) {
        codePostal.value = commune.numero_commune;
    }
}

const updateCodePostal = () => {
    const selectedCommune = props.communes.find(
        (c) => c.id === form.nom_commune_id,
    );
    if (selectedCommune) {
        // Les deux champs doivent contenir l'ID de la commune
        form.numero_commune_id = selectedCommune.id;
        // Afficher le code postal séparément
        codePostal.value = selectedCommune.numero_commune;
    } else {
        codePostal.value = '';
        form.numero_commune_id = null;
    }
};

// Fonction pour obtenir le jour de la semaine en français
const getJourSemaine = (dateString: string | null): string | null => {
    if (!dateString) return null;

    const jours = [
        'dimanche',
        'lundi',
        'mardi',
        'mercredi',
        'jeudi',
        'vendredi',
        'samedi',
    ];
    const date = new Date(dateString);
    return jours[date.getDay()];
};

// Fonction pour calculer les frais de livraison
const calculerFraisLivraison = () => {
    let totalFrais = 0;

    // Fonction helper pour trouver les frais selon le jour
    const trouverFrais = (jour: string | null) => {
        if (!jour) return null;

        // Chercher d'abord une correspondance exacte
        let frais = props.fraisLivraison.find(
            (f: any) => f.jour_semaine.toLowerCase() === jour.toLowerCase(),
        );

        // Si pas trouvé et que c'est un jour de semaine (lundi à vendredi)
        if (
            !frais &&
            ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'].includes(
                jour.toLowerCase(),
            )
        ) {
            frais = props.fraisLivraison.find(
                (f: any) =>
                    f.jour_semaine.toLowerCase().includes('lundi') &&
                    f.jour_semaine.toLowerCase().includes('vendredi'),
            );
        }

        return frais;
    };

    // Vérifier si le mode de livraison nécessite une livraison
    const modeLivraisonSelectionne = props.modeLivraison.find(
        (m: any) => m.id === form.mode_livraison_id,
    );

    if (
        modeLivraisonSelectionne &&
        modeLivraisonSelectionne.mode_livraison.toLowerCase() === 'livraison' &&
        form.date_debut
    ) {
        const jour = getJourSemaine(form.date_debut);
        if (jour) {
            const frais = trouverFrais(jour);
            if (frais) {
                totalFrais += parseFloat(frais.montant);
            }
        }
    }

    // Vérifier si le mode de retour nécessite une livraison
    const modeRetourSelectionne = props.modeRetour.find(
        (m: any) => m.id === form.mode_retour_id,
    );

    if (
        modeRetourSelectionne &&
        modeRetourSelectionne.mode_retour.toLowerCase() === 'livraison' &&
        form.date_fin
    ) {
        const jour = getJourSemaine(form.date_fin);
        if (jour) {
            const frais = trouverFrais(jour);
            if (frais) {
                totalFrais += parseFloat(frais.montant);
            }
        }
    }

    // Assigner la valeur numérique (pas de string)
    form.frais_livraison = totalFrais > 0 ? Number(totalFrais.toFixed(2)) : 0;
};

// Surveiller les changements pour recalculer les frais automatiquement
watch(
    () => [
        form.mode_livraison_id,
        form.mode_retour_id,
        form.date_debut,
        form.date_fin,
    ],
    () => {
        calculerFraisLivraison();
    },
    { immediate: true }, // Calculer dès le chargement initial
);

// Fonction pour vérifier et appliquer le code de réduction
const verifierCodeReduction = async () => {
    if (!codeReduction.value || codeReduction.value.trim() === '') {
        messageCodeReduction.value = 'Veuillez entrer un code de réduction.';
        codeReductionApplique.value = false;
        return;
    }

    isVerifyingCode.value = true;
    messageCodeReduction.value = '';

    try {
        const response = await fetch('/code-reduction/verifier', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-XSRF-TOKEN': decodeURIComponent(
                    document.cookie
                        .split('; ')
                        .find((row) => row.startsWith('XSRF-TOKEN='))
                        ?.split('=')[1] || '',
                ),
            },
            credentials: 'same-origin',
            body: JSON.stringify({
                code: codeReduction.value,
            }),
        });

        const data = await response.json();

        if (data.valid) {
            codeReductionApplique.value = true;
            messageCodeReduction.value = data.message;
            form.code_reduction_id = data.code_reduction_id;
            typeCodeReduction.value = data.type;

            // Calculer le montant de la réduction
            const montantDetailsCommandes = props.detailsCommandes.reduce(
                (sum: number, detail: any) =>
                    sum +
                    (Number(detail.sous_total) ||
                        Number(detail.quantite) * Number(detail.prix_unitaire)),
                0,
            );

            if (data.type.toLowerCase() === 'pourcentage') {
                form.montant_reduction = Number(
                    ((montantDetailsCommandes * data.montant) / 100).toFixed(2),
                );
            } else {
                // Montant fixe
                form.montant_reduction = Number(data.montant);
            }
        } else {
            codeReductionApplique.value = false;
            messageCodeReduction.value = data.message;
            form.code_reduction_id = null;
            form.montant_reduction = 0;
        }
    } catch (error) {
        codeReductionApplique.value = false;
        messageCodeReduction.value = 'Erreur lors de la vérification du code.';
        form.code_reduction_id = null;
        form.montant_reduction = 0;
    } finally {
        isVerifyingCode.value = false;
    }
};

// Fonction pour retirer le code de réduction
const retirerCodeReduction = () => {
    codeReduction.value = '';
    codeReductionApplique.value = false;
    messageCodeReduction.value = '';
    form.code_reduction_id = null;
    form.montant_reduction = 0;
    typeCodeReduction.value = '';
};

// Computed pour le total final
const totalFinal = computed(() => {
    // Calculer le montant de base à partir des détails de commande
    const montantBase = props.detailsCommandes.reduce(
        (sum: number, detail: any) =>
            sum +
            (Number(detail.sous_total) ||
                Number(detail.quantite) * Number(detail.prix_unitaire)),
        0,
    );
    const fraisLivraison = Number(form.frais_livraison) || 0;
    const montantReduction = Number(form.montant_reduction) || 0;
    const total = montantBase + fraisLivraison - montantReduction;
    return Math.max(0, total).toFixed(2);
});

function submit() {
    // Mettre à jour montant_total avec le calcul des détails de commande
    form.montant_total = props.detailsCommandes.reduce(
        (sum: number, detail: any) =>
            sum +
            (Number(detail.sous_total) ||
                Number(detail.quantite) * Number(detail.prix_unitaire)),
        0,
    );

    form.post('/commandes', {
        onSuccess: () => {
            // Réinitialiser le formulaire après la soumission réussie
            form.reset();
        },
    });
}
</script>

<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <!-- Message d'erreur flash -->
            <div
                v-if="page.props.flash?.error"
                class="mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
                role="alert"
            >
                <strong class="font-bold">Erreur :</strong>
                <span class="block sm:inline">{{
                    page.props.flash.error
                }}</span>
            </div>

            <!-- Message de succès flash -->
            <div
                v-if="page.props.flash?.success"
                class="mb-4 rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700"
                role="alert"
            >
                <strong class="font-bold">Succès :</strong>
                <span class="block sm:inline">{{
                    page.props.flash.success
                }}</span>
            </div>

            <h1 class="mb-4 text-2xl font-bold">
                Récapitulatif de la commande
            </h1>
            <article
                v-if="props.detailsCommandes.length > 0"
                class="mb-6 rounded border bg-white p-4 shadow"
            >
                <h2 class="mb-4 text-xl font-semibold">Matériels loués</h2>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="px-4 py-2 text-left">Matériel</th>
                                <th class="px-4 py-2 text-right">Quantité</th>
                                <th class="px-4 py-2 text-right">
                                    Prix unitaire
                                </th>
                                <th class="px-4 py-2 text-right">Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(
                                    detail, index
                                ) in props.detailsCommandes"
                                :key="index"
                                class="border-b hover:bg-gray-50"
                            >
                                <td class="px-4 py-2">
                                    {{ detail.materiel.nom }}
                                </td>
                                <td class="px-4 py-2 text-right">
                                    {{ detail.quantite }}
                                </td>
                                <td class="px-4 py-2 text-right">
                                    {{
                                        Number(detail.prix_unitaire).toFixed(2)
                                    }}€
                                </td>
                                <td class="px-4 py-2 text-right font-semibold">
                                    {{
                                        detail.sous_total
                                            ? Number(detail.sous_total).toFixed(
                                                  2,
                                              )
                                            : (
                                                  Number(detail.quantite) *
                                                  Number(detail.prix_unitaire)
                                              ).toFixed(2)
                                    }}€
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 bg-gray-50 font-semibold">
                                <td colspan="3" class="px-4 py-3 text-right">
                                    Total des matériels:
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                        props.detailsCommandes
                                            .reduce(
                                                (sum, detail) =>
                                                    sum +
                                                    (Number(
                                                        detail.sous_total,
                                                    ) ||
                                                        Number(
                                                            detail.quantite,
                                                        ) *
                                                            Number(
                                                                detail.prix_unitaire,
                                                            )),
                                                0,
                                            )
                                            .toFixed(2)
                                    }}€
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </article>
            <!-- Vous pouvez afficher les détails de la commande ici en utilisant les données de props.commande -->
            <div v-if="props.commande" class="mt-6">
                <h2 class="mb-2 text-xl font-semibold">Détails de livraison</h2>
                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label for="user_id"><strong>Client:</strong></label>
                        <input
                            id="user_id"
                            type="text"
                            v-model="form.user_id"
                            class="w-full rounded border bg-gray-100 px-3 py-2"
                            disabled
                        />
                    </div>
                    <div class="mb-4">
                        <label for="numero_commande"
                            ><strong>Numéro de commande:</strong></label
                        >
                        <input
                            id="numero_commande"
                            type="text"
                            v-model="form.numero_commande"
                            class="w-full rounded border bg-gray-100 px-3 py-2"
                            disabled
                        />
                    </div>
                    <div class="mb-4">
                        <label for="date_debut"
                            ><strong>Date de début de location:</strong></label
                        >
                        <input
                            id="date_debut"
                            type="date"
                            v-model="form.date_debut"
                            class="w-full rounded border px-3 py-2"
                            :class="{
                                'border-red-500': form.errors.date_debut,
                            }"
                        />
                        <p
                            v-if="form.errors.date_debut"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.date_debut }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="date_fin"
                            ><strong>Date de fin de location:</strong></label
                        >
                        <input
                            id="date_fin"
                            type="date"
                            v-model="form.date_fin"
                            class="w-full rounded border px-3 py-2"
                            :class="{ 'border-red-500': form.errors.date_fin }"
                        />
                        <p
                            v-if="form.errors.date_fin"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.date_fin }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="date_commande"
                            ><strong>Date de la commande:</strong></label
                        >
                        <input
                            id="date_commande"
                            type="date"
                            v-model="form.date_commande"
                            class="w-full rounded border bg-gray-100 px-3 py-2"
                            disabled
                        />
                    </div>
                    <div class="mb-4">
                        <label for="statut_id"><strong>Statut:</strong></label>
                        <input
                            id="statut_id"
                            type="text"
                            v-model="form.statut_id"
                            class="w-full rounded border bg-gray-100 px-3 py-2"
                            disabled
                        />
                    </div>
                    <div class="mb-4">
                        <label for="mode_livraison_id"
                            ><strong>Mode de livraison:</strong></label
                        >
                        <select
                            id="mode_livraison_id"
                            v-model="form.mode_livraison_id"
                            class="w-full rounded border px-3 py-2"
                            :class="{
                                'border-red-500': form.errors.mode_livraison_id,
                            }"
                        >
                            <option value="">Sélectionnez un mode</option>
                            <option
                                v-for="mode in props.modeLivraison"
                                :key="mode.id"
                                :value="mode.id"
                            >
                                {{ mode.mode_livraison }}
                            </option>
                        </select>
                        <p
                            v-if="form.errors.mode_livraison_id"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.mode_livraison_id }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="mode_retour_id"
                            ><strong>Mode de retour:</strong></label
                        >
                        <select
                            id="mode_retour_id"
                            v-model="form.mode_retour_id"
                            class="w-full rounded border px-3 py-2"
                            :class="{
                                'border-red-500': form.errors.mode_retour_id,
                            }"
                        >
                            <option value="">Sélectionnez un mode</option>
                            <option
                                v-for="mode in props.modeRetour"
                                :key="mode.id"
                                :value="mode.id"
                            >
                                {{ mode.mode_retour }}
                            </option>
                        </select>
                        <p
                            v-if="form.errors.mode_retour_id"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.mode_retour_id }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="nom_rue_id"
                            ><strong>Nom de la rue:</strong></label
                        >
                        <input
                            id="nom_rue_id"
                            type="text"
                            v-model="form.nom_rue"
                            class="w-full rounded border px-3 py-2"
                            :class="{ 'border-red-500': form.errors.nom_rue }"
                            placeholder="Entrez le nom de la rue"
                        />
                        <p
                            v-if="form.errors.nom_rue"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.nom_rue }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="numero_rue_id"
                            ><strong>Numéro de rue:</strong></label
                        >
                        <input
                            id="numero_rue_id"
                            type="number"
                            v-model="form.numero_rue"
                            class="w-full rounded border px-3 py-2"
                            :class="{
                                'border-red-500': form.errors.numero_rue,
                            }"
                            placeholder="Entrez le numéro de rue"
                        />
                        <p
                            v-if="form.errors.numero_rue"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.numero_rue }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="nom_commune_id"
                            ><strong>Commune:</strong></label
                        >
                        <select
                            id="nom_commune_id"
                            v-model="form.nom_commune_id"
                            @change="updateCodePostal"
                            class="w-full rounded border px-3 py-2"
                            :class="{
                                'border-red-500': form.errors.nom_commune_id,
                            }"
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
                        <p
                            v-if="form.errors.nom_commune_id"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.nom_commune_id }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="code_postal"
                            ><strong>Code postal:</strong></label
                        >
                        <input
                            id="code_postal"
                            type="text"
                            v-model="codePostal"
                            class="w-full rounded border bg-gray-100 px-3 py-2"
                            placeholder="Sélectionnez une commune"
                            readonly
                            disabled
                        />
                    </div>
                    <div class="mb-4">
                        <label for="pays_id"><strong>Pays:</strong></label>
                        <select
                            id="pays_id"
                            v-model="form.pays_id"
                            class="w-full rounded border px-3 py-2"
                            :class="{ 'border-red-500': form.errors.pays_id }"
                        >
                            <option value="">Sélectionnez un pays</option>
                            <option
                                v-for="p in props.pays"
                                :key="p.id"
                                :value="p.id"
                            >
                                {{ p.nom_pays }}
                            </option>
                        </select>
                        <p
                            v-if="form.errors.pays_id"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.pays_id }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <label for="frais_livraison"
                            ><strong>Frais de livraison (€):</strong></label
                        >
                        <input
                            id="frais_livraison"
                            type="number"
                            step="0.01"
                            v-model="form.frais_livraison"
                            class="w-full rounded border bg-gray-100 px-3 py-2"
                            readonly
                            disabled
                        />
                        <p class="mt-1 text-sm text-gray-600">
                            Calculé automatiquement selon le mode de
                            livraison/retour et les dates
                        </p>
                    </div>

                    <!-- Code de réduction -->
                    <div
                        class="mb-4 rounded border border-gray-300 bg-gray-50 p-4"
                    >
                        <label for="code_reduction"
                            ><strong
                                >Code de réduction (optionnel):</strong
                            ></label
                        >
                        <div class="mt-2 flex gap-2">
                            <input
                                id="code_reduction"
                                type="text"
                                v-model="codeReduction"
                                :disabled="codeReductionApplique"
                                class="flex-1 rounded border px-3 py-2 uppercase"
                                :class="{
                                    'bg-gray-100': codeReductionApplique,
                                }"
                                placeholder="Entrez votre code"
                            />
                            <button
                                v-if="!codeReductionApplique"
                                type="button"
                                @click="verifierCodeReduction"
                                :disabled="isVerifyingCode"
                                class="rounded bg-green-600 px-4 py-2 text-white hover:bg-green-700 disabled:bg-gray-400"
                            >
                                {{
                                    isVerifyingCode
                                        ? 'Vérification...'
                                        : 'Appliquer'
                                }}
                            </button>
                            <button
                                v-else
                                type="button"
                                @click="retirerCodeReduction"
                                class="rounded bg-red-600 px-4 py-2 text-white hover:bg-red-700"
                            >
                                Retirer
                            </button>
                        </div>
                        <p
                            v-if="messageCodeReduction"
                            class="mt-2 text-sm"
                            :class="{
                                'text-green-600': codeReductionApplique,
                                'text-red-600': !codeReductionApplique,
                            }"
                        >
                            {{ messageCodeReduction }}
                        </p>
                        <div
                            v-if="
                                codeReductionApplique &&
                                form.montant_reduction > 0
                            "
                            class="mt-2 rounded bg-green-100 p-2"
                        >
                            <p class="text-sm font-semibold text-green-800">
                                Réduction appliquée : -{{
                                    form.montant_reduction.toFixed(2)
                                }}€
                            </p>
                        </div>
                    </div>

                    <!-- Récapitulatif des montants -->
                    <div
                        class="mb-6 rounded border-2 border-blue-200 bg-blue-50 p-4"
                    >
                        <h3 class="mb-3 text-lg font-semibold text-blue-900">
                            Récapitulatif des montants
                        </h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>Sous-total matériels :</span>
                                <span class="font-semibold">
                                    {{
                                        props.detailsCommandes
                                            .reduce(
                                                (sum, detail) =>
                                                    sum +
                                                    (Number(
                                                        detail.sous_total,
                                                    ) ||
                                                        Number(
                                                            detail.quantite,
                                                        ) *
                                                            Number(
                                                                detail.prix_unitaire,
                                                            )),
                                                0,
                                            )
                                            .toFixed(2)
                                    }}€
                                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Frais de livraison :</span>
                                <span class="font-semibold">
                                    {{
                                        Number(
                                            form.frais_livraison || 0,
                                        ).toFixed(2)
                                    }}€
                                </span>
                            </div>
                            <div
                                v-if="form.montant_reduction > 0"
                                class="flex justify-between text-sm text-green-700"
                            >
                                <span>Réduction :</span>
                                <span class="font-semibold">
                                    -{{
                                        Number(form.montant_reduction).toFixed(
                                            2,
                                        )
                                    }}€
                                </span>
                            </div>
                            <div class="border-t-2 border-blue-300 pt-2">
                                <div
                                    class="flex justify-between text-lg font-bold text-blue-900"
                                >
                                    <span>Total à payer :</span>
                                    <span>{{ totalFinal }}€</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="mx-auto block rounded bg-blue-600 px-6 py-3 text-lg font-semibold text-white hover:bg-blue-700"
                    >
                        Confirmer la commande
                    </button>
                </form>
            </div>
            <div v-else class="mt-6">
                <p class="text-gray-500">Aucune commande disponible.</p>
            </div>
        </section>
    </AppLayout>
</template>
