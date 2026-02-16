<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    commande: {
        type: Object,
        required: false,
        default: null,
    },
});

const form = useForm({
    user_id: props.commande ? props.commande.user_id : null,
    numero_commande: props.commande ? props.commande.numero_commande : null,
    date_debut: props.commande ? props.commande.date_debut : null,
    date_fin: props.commande ? props.commande.date_fin : null,
    date_commande: props.commande ? props.commande.date_commande : null,
    statut_id: props.commande ? props.commande.statut_id : null,
    mode_livraison_id: props.commande ? props.commande.mode_livraison_id : null,
    mode_retour_id: props.commande ? props.commande.mode_retour_id : null,
    nom_rue_id: props.commande ? props.commande.nom_rue_id : null,
    numero_rue_id: props.commande ? props.commande.numero_rue_id : null,
    nom_commune_id: props.commande ? props.commande.nom_commune_id : null,
    numero_commune_id: props.commande ? props.commande.numero_commune_id : null,
    pays_id: props.commande ? props.commande.pays_id : null,
    montant_total: props.commande ? props.commande.montant_total : null,
    frais_livraison: props.commande ? props.commande.frais_livraison : null,
});

function submit() {
    (form.post('/commandes'),
        {
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
            <h1 class="mb-4 text-2xl font-bold">
                Récapitulatif de la commande
            </h1>
            <p>Cette page est en cours de développement.</p>
            <!-- Vous pouvez afficher les détails de la commande ici en utilisant les données de props.commande -->
            <div v-if="props.commande" class="mt-6">
                <h2 class="mb-2 text-xl font-semibold">
                    Détails de la commande
                </h2>
                <p><strong>Client:</strong> {{ props.commande.user_id }}</p>
                <p>
                    <strong>Numéro de commande:</strong>
                    {{ props.commande.numero_commande }}
                </p>
                <p>
                    <strong>Date de début:</strong>
                    {{ props.commande.date_debut }}
                </p>
                <p>
                    <strong>Date de fin:</strong>
                    {{ props.commande.date_fin }}
                </p>
                <p>
                    <strong>Date de la commande:</strong>
                    {{
                        new Date(props.commande.created_at).toLocaleDateString()
                    }}
                </p>
                <p>
                    <strong>Statut:</strong>
                    {{ props.commande.statut_id }}
                </p>
                <p>
                    <strong>Mode de livraison:</strong>
                    {{ props.commande.mode_livraison_id }}
                </p>
                <p>
                    <strong>Mode de retour:</strong>
                    {{ props.commande.mode_retour_id }}
                </p>
                <p>
                    <strong>Nom de la rue:</strong>
                    {{ props.commande.nom_rue_id }}
                </p>
                <p>
                    <strong>Numéro de rue:</strong>
                    {{ props.commande.numero_rue_id }}
                </p>
                <p>
                    <strong>Nom de la commune:</strong>
                    {{ props.commande.nom_commune_id }}
                </p>
                <p>
                    <strong>Numéro de commune:</strong>
                    {{ props.commande.numero_commune_id }}
                </p>
                <p>
                    <strong>Pays:</strong>
                    {{ props.commande.pays_id }}
                </p>
                <p>
                    <strong>Frais de livraison:</strong>
                    {{ Number(props.commande.frais_livraison).toFixed(2) }} €
                </p>
                <p>
                    <strong>Total (Hors frais de livraison):</strong>
                    {{ Number(props.commande.montant_total).toFixed(2) }} €
                </p>
            </div>
            <div v-else class="mt-6">
                <p class="text-gray-500">Aucune commande disponible.</p>
            </div>
        </section>
    </AppLayout>
</template>
