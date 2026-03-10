<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';

defineProps({
    facture: {
        type: Object,
        required: true,
    },
    commande: {
        type: Object,
        required: false,
    },
    detailsCommandes: {
        type: Array,
        default: () => [],
    },
});

const formatDate = (date) => {
    if (!date) return '-';
    return new Date(date).toLocaleDateString('fr-FR');
};

const formatMontant = (montant) => {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR',
    }).format(montant);
};

const voirMateriel = (id) => {
    router.visit(`/materiels/${id}`);
};
</script>

<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <h1 class="mb-4 text-2xl font-bold">Détails de la facture</h1>
            <div class="rounded-lg bg-white p-6 shadow">
                <div class="mb-4">
                    <h2 class="mb-2 text-xl font-semibold">
                        Informations sur la facture
                    </h2>
                    <p><strong>N° Facture:</strong> {{ facture.id }}</p>
                    <p>
                        <strong>Type de document:</strong>
                        {{ facture.type_document?.document || '-' }}
                    </p>
                    <p>
                        <strong>Statut de paiement:</strong>
                        {{ facture.statut_paiement?.statut || '-' }}
                    </p>
                    <p>
                        <strong>Date de création:</strong>
                        {{ formatDate(facture.created_at) }}
                    </p>
                    <p>
                        <strong>Montant HT:</strong>
                        {{ formatMontant(facture.montant_ht) }}
                    </p>
                    <p>
                        <strong>Montant TVA:</strong>
                        {{ formatMontant(facture.montant_tva) }}
                    </p>
                    <p>
                        <strong>Montant TTC:</strong>
                        {{ formatMontant(facture.montant_ttc) }}
                    </p>
                </div>

                <!-- Détails de la commande -->
                <div v-if="commande" class="mt-6">
                    <h2 class="mb-2 text-xl font-semibold">
                        Informations sur la commande
                    </h2>
                    <p>
                        <strong>N° Commande:</strong>
                        {{ commande.numero_commande }}
                    </p>
                    <p>
                        <strong>Client:</strong>
                        {{ commande.user?.email || '-' }}
                    </p>
                    <p>
                        <strong>Adresse:</strong>
                        {{ commande.nom_rue }} {{ commande.numero_rue }},
                        {{ commande.commune?.numero_commune || '' }}
                        {{ commande.commune?.nom_commune || '' }},
                        {{ commande.pays?.nom_pays || '' }}
                    </p>
                    <p>
                        <strong>Date de commande:</strong>
                        {{ formatDate(commande.created_at) }}
                    </p>
                    <p>
                        <strong>Date de début:</strong>
                        {{ formatDate(commande.date_debut) }}
                    </p>
                    <p>
                        <strong>Date de fin:</strong>
                        {{ formatDate(commande.date_fin) }}
                    </p>
                    <p>
                        <strong>Statut de la commande:</strong>
                        {{ commande.statut?.statut || '-' }}
                    </p>
                    <p>
                        <strong>Mode de livraison:</strong>
                        {{ commande.mode_livraison?.mode_livraison || '-' }}
                    </p>
                    <p>
                        <strong>Mode de retour:</strong>
                        {{ commande.mode_retour?.mode_retour || '-' }}
                    </p>
                </div>

                <!-- Liste des matériels loués -->
                <div class="mt-6">
                    <h2 class="mb-2 text-xl font-semibold">Matériels loués</h2>

                    <div
                        v-if="detailsCommandes && detailsCommandes.length > 0"
                        class="mt-4 overflow-x-auto"
                    >
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        Matériel
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        Catégorie
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        Quantité
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        Prix unitaire HT
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        Total HT
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr
                                    v-for="detail in detailsCommandes"
                                    :key="detail.id"
                                    @click="voirMateriel(detail.materiel_id)"
                                    class="cursor-pointer hover:bg-gray-50"
                                >
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div
                                                    class="text-sm font-medium text-gray-900"
                                                >
                                                    {{
                                                        detail.materiel?.nom ||
                                                        '-'
                                                    }}
                                                </div>
                                                <div
                                                    class="text-sm text-gray-500"
                                                >
                                                    Réf: #{{
                                                        detail.materiel?.id
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm whitespace-nowrap text-gray-900"
                                    >
                                        {{
                                            detail.materiel?.categorie?.nom ||
                                            '-'
                                        }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm whitespace-nowrap text-gray-900"
                                    >
                                        {{ detail.quantite || 1 }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm whitespace-nowrap text-gray-900"
                                    >
                                        {{
                                            formatMontant(
                                                detail.prix_unitaire || 0,
                                            )
                                        }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900"
                                    >
                                        {{
                                            formatMontant(
                                                detail.sous_total || 0,
                                            )
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <p v-else class="mt-4 text-gray-500">
                        Aucun matériel associé à cette facture.
                    </p>
                </div>
            </div>
            <!-- Lien pour télécharger la facture au format PDF -->
            <div class="mt-4">
                <a
                    :href="`/factures/${facture.id}/download-pdf`"
                    class="inline-block rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                >
                    Télécharger la facture (PDF)
                </a>
            </div>
        </section>
    </AppLayout>
</template>
