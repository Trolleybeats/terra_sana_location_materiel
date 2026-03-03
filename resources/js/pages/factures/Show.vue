<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'process';

defineProps({
    facture: {
        type: Object,
        required: true,
    },
    commande: {
        type: Object,
        required: false,
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
                <div>
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
            </div>
            <!-- Lien pour télécharger la facture au format PDF -->
            <div class="mt-4">
                <a
                    :href="facture.url_pdf"
                    class="inline-block rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                    target="_blank"
                >
                    Télécharger la facture (PDF)
                </a>
            </div>
        </section>
    </AppLayout>
</template>
