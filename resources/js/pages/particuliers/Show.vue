<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { Particulier } from '@/types';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Button } from '@/components/ui/button';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const deleteDialog = ref(false);
const particulierToDelete = ref<Particulier | null>(null);

const openDeleteDialog = (particulier: Particulier) => {
    particulierToDelete.value = particulier;
    deleteDialog.value = true;
};

const deleteParticulier = () => {
    if (particulierToDelete.value) {
        router.delete(`/particuliers/${particulierToDelete.value.id}`, {
            onSuccess: () => {
                deleteDialog.value = false;
                particulierToDelete.value = null;
            },
            onError: (errors) => {
                // Gérer les erreurs si nécessaire
                console.error(
                    'Erreur lors de la suppression du particulier.',
                    errors,
                );
            },
        });
    }
};

defineProps<{
    particulier: Particulier;
}>();
</script>

<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Détails du Particulier</h1>
            <div class="rounded-lg bg-white p-6 shadow-md">
                <p class="mb-4"><strong>ID:</strong> {{ particulier.id }}</p>
                <p class="mb-4">
                    <strong>Nom:</strong>
                    {{ particulier.nom }}
                </p>
                <p class="mb-4">
                    <strong>Prénom:</strong>
                    {{ particulier.prenom }}
                </p>
                <p class="mb-4">
                    <strong>Adresse:</strong>
                    {{ particulier.numero_rue }}
                    {{ particulier.nom_rue }},
                    {{ particulier.commune_numero?.numero_commune }}
                    {{ particulier.commune_nom?.nom_commune }}
                </p>
                <p class="mb-4">
                    <strong>Pays:</strong> {{ particulier.pays?.nom_pays }}
                </p>
                <p class="mb-4">
                    <strong>Langue:</strong> {{ particulier.langue?.langue }}
                </p>
            </div>
            <button
                class="mt-6 rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                @click="$inertia.visit(`/particuliers/${particulier.id}/edit`)"
            >
                Modifier le Particulier
            </button>
            <button
                class="mt-6 ml-4 rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700"
                @click="openDeleteDialog(particulier)"
            >
                Supprimer le Particulier
            </button>
        </section>
        <!-- Dialog de confirmation de suppression -->
        <Dialog v-model:open="deleteDialog">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Confirmer la suppression</DialogTitle>
                    <DialogDescription>
                        Êtes-vous sûr de vouloir supprimer "{{
                            particulierToDelete?.nom
                        }}
                        {{ particulierToDelete?.prenom }}" ? Cette action est
                        irréversible.
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
                        @click="deleteParticulier"
                    >
                        Supprimer
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>
