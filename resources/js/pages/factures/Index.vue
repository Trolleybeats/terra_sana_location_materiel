<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
    factures: {
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
</script>

<template>
    <Head title="Factures" />

    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold">Liste des Factures</h1>
            </div>

            <!-- Message si aucune facture -->
            <div v-if="factures.length === 0" class="py-12 text-center">
                <p class="mb-4 text-xl text-gray-600">
                    Aucune facture disponible.
                </p>
                <Link
                    :href="route('commandes.create')"
                    class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase hover:bg-blue-700"
                >
                    Créer une commande
                </Link>
            </div>

            <!-- Table des factures -->
            <div v-else class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200 bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                N° Facture
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                Client
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                Date Émission
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                Date Échéance
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                Montant HT
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                TVA
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                Montant TTC
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                Statut
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr
                            v-for="facture in factures"
                            :key="facture.id"
                            class="hover:bg-gray-50"
                        >
                            <td
                                class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900"
                            >
                                {{ facture.numero_facture }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500"
                            >
                                {{ facture.commande?.user?.name || '-' }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500"
                            >
                                {{ formatDate(facture.date_emission) }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500"
                            >
                                {{ formatDate(facture.date_echeance) }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500"
                            >
                                {{ formatMontant(facture.montant_ht) }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500"
                            >
                                {{ formatMontant(facture.montant_tva) }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm font-semibold whitespace-nowrap text-gray-900"
                            >
                                {{ formatMontant(facture.montant_ttc) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex rounded-full px-2 text-xs leading-5 font-semibold"
                                    :class="{
                                        'bg-yellow-100 text-yellow-800':
                                            facture.statut_paiement?.statut ===
                                            'En attente',
                                        'bg-green-100 text-green-800':
                                            facture.statut_paiement?.statut ===
                                            'Payée',
                                        'bg-red-100 text-red-800':
                                            facture.statut_paiement?.statut ===
                                            'Non payée',
                                    }"
                                >
                                    {{ facture.statut_paiement?.statut || '-' }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </AppLayout>
</template>
