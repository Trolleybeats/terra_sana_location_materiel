<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';

const props = defineProps<{
    panier: Array<{
        id: number;
        materiel: any;
        quantite: number;
        sous_total: number;
    }>;
    montantTotal: number;
}>();

const deleteDialog = ref(false);
const detailToRemove = ref<number | null>(null);

function openRemoveDialog(detailId: number) {
    detailToRemove.value = detailId;
    deleteDialog.value = true;
}

function retirerDuPanier() {
    if (detailToRemove.value) {
        router.delete(`/panier/${detailToRemove.value}`, {
            onSuccess: () => {
                deleteDialog.value = false;
                detailToRemove.value = null;
            },
            onError: (errors) => {
                console.error('Erreur lors du retrait du panier.', errors);
            },
        });
    }
}

function mettreAJourQuantite(detailId: number, quantite: number) {
    if (quantite < 1) return;

    router.put(
        `/panier/${detailId}`,
        { quantite },
        {
            preserveState: true,
            onError: (errors) => {
                console.error('Erreur lors de la mise à jour.', errors);
            },
        },
    );
}

function viderPanier() {
    if (confirm('Êtes-vous sûr de vouloir vider le panier ?')) {
        router.delete('/panier', {
            onError: (errors) => {
                console.error('Erreur lors du vidage du panier.', errors);
            },
        });
    }
}
</script>

<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-3xl font-bold">Panier / Commande en cours</h1>
                <Button
                    v-if="panier.length > 0"
                    variant="outline"
                    @click="viderPanier"
                >
                    Vider le panier
                </Button>
            </div>

            <div v-if="panier.length === 0" class="py-12 text-center">
                <p class="mb-4 text-xl text-gray-600">Votre panier est vide</p>
                <Button @click="$inertia.visit('/materiels')">
                    Parcourir les matériels
                </Button>
            </div>

            <div v-else>
                <!-- Table du panier -->
                <div class="mb-6 overflow-x-auto rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200 bg-white">
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
                                    Prix journalier
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                >
                                    Quantité
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                >
                                    Sous-total
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="item in panier" :key="item.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ item.materiel.nom }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ item.materiel.description }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{
                                        item.materiel.categorie
                                            ? item.materiel.categorie.nom
                                            : 'Inconnu'
                                    }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ item.materiel.prix_journalier }} €
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <button
                                            class="rounded bg-gray-200 px-2 py-1 text-sm hover:bg-gray-300"
                                            @click="
                                                mettreAJourQuantite(
                                                    item.id,
                                                    item.quantite - 1,
                                                )
                                            "
                                            :disabled="item.quantite <= 1"
                                        >
                                            -
                                        </button>
                                        <span class="w-8 text-center">{{
                                            item.quantite
                                        }}</span>
                                        <button
                                            class="rounded bg-gray-200 px-2 py-1 text-sm hover:bg-gray-300"
                                            @click="
                                                mettreAJourQuantite(
                                                    item.id,
                                                    item.quantite + 1,
                                                )
                                            "
                                            :disabled="
                                                item.quantite >=
                                                item.materiel.stock_disponible
                                            "
                                        >
                                            +
                                        </button>
                                    </div>
                                    <div class="mt-1 text-xs text-gray-500">
                                        Stock:
                                        {{ item.materiel.stock_disponible }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-semibold">
                                        {{
                                            Number(item.sous_total).toFixed(2)
                                        }}
                                        €
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <Button
                                        variant="destructive"
                                        size="sm"
                                        @click="openRemoveDialog(item.id)"
                                    >
                                        Retirer
                                    </Button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Résumé -->
                <div class="rounded-lg bg-gray-50 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold">Total</h2>
                            <p class="text-sm text-gray-600">
                                {{ panier.length }} article(s)
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-bold text-indigo-600">
                                {{ Number(montantTotal).toFixed(2) }} €
                            </p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <Button
                            class="w-full"
                            size="lg"
                            @click="$inertia.visit('/commandes/create')"
                        >
                            Finaliser la commande
                        </Button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dialog de confirmation de retrait -->
        <Dialog v-model:open="deleteDialog">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Retirer du panier</DialogTitle>
                    <DialogDescription>
                        Êtes-vous sûr de vouloir retirer ce matériel du panier ?
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter>
                    <Button
                        type="button"
                        variant="outline"
                        @click="deleteDialog = false"
                    >
                        Annuler
                    </Button>
                    <Button
                        type="button"
                        variant="destructive"
                        @click="retirerDuPanier"
                    >
                        Retirer
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>
