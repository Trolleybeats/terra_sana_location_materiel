<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { Professionnel } from '@/types';
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
const professionnelToDelete = ref<Professionnel | null>(null);

const openDeleteDialog = (professionnel: Professionnel) => {
    professionnelToDelete.value = professionnel;
    deleteDialog.value = true;
};

const deleteProfessionnel = () => {
    if (professionnelToDelete.value) {
        router.delete(`/professionnels/${professionnelToDelete.value.id}`, {
            onSuccess: () => {
                deleteDialog.value = false;
                professionnelToDelete.value = null;
            },
            onError: (errors) => {
                // Gérer les erreurs si nécessaire
                console.error(
                    'Erreur lors de la suppression du professionnel.',
                    errors,
                );
            },
        });
    }
};

defineProps<{
    professionnel: Professionnel;
}>();
</script>

<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Détails du Professionnel</h1>
            <div class="rounded-lg bg-white p-6 shadow-md">
                <p class="mb-4"><strong>ID:</strong> {{ professionnel.id }}</p>
                <p class="mb-4">
                    <strong>Nom de la Société:</strong>
                    {{ professionnel.nom_societe }}
                </p>
                <p class="mb-4">
                    <strong>Adresse Siège:</strong>
                    {{ professionnel.numero_rue_siege }}
                    {{ professionnel.nom_rue_siege }},
                    {{ professionnel.commune_siege_numero?.numero_commune }}
                    {{ professionnel.commune_siege_nom?.nom_commune }}
                </p>
                <p class="mb-4">
                    <strong>Adresse Livraison:</strong>
                    {{ professionnel.numero_rue_livraison }}
                    {{ professionnel.nom_rue_livraison }},
                    {{ professionnel.commune_livraison_numero?.numero_commune }}
                    {{ professionnel.commune_livraison_nom?.nom_commune }}
                </p>
                <p class="mb-4">
                    <strong>Pays:</strong> {{ professionnel.pays?.nom_pays }}
                </p>
                <p class="mb-4">
                    <strong>Horaires:</strong>
                    {{ professionnel.heure_ouverture }}:{{
                        String(professionnel.minute_ouverture).padStart(2, '0')
                    }}
                    - {{ professionnel.heure_fermeture }}:{{
                        String(professionnel.minute_fermeture).padStart(2, '0')
                    }}
                </p>
                <p class="mb-4">
                    <strong>Langue:</strong> {{ professionnel.langue?.langue }}
                </p>
            </div>
            <button
                class="mt-6 rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                @click="
                    $inertia.visit(`/professionnels/${professionnel.id}/edit`)
                "
            >
                Modifier le Professionnel
            </button>
            <button
                class="mt-6 ml-4 rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700"
                @click="openDeleteDialog(professionnel)"
            >
                Supprimer le Professionnel
            </button>
        </section>
        <!-- Dialog de confirmation de suppression -->
        <Dialog v-model:open="deleteDialog">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Confirmer la suppression</DialogTitle>
                    <DialogDescription>
                        Êtes-vous sûr de vouloir supprimer "{{
                            professionnelToDelete?.nom_societe
                        }}" ? Cette action est irréversible.
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
                        @click="deleteProfessionnel"
                    >
                        Supprimer
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>
