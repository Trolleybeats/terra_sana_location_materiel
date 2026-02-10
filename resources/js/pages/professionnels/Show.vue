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
const deleteContactProDialog = ref(false);
const contactProToDelete = ref<number | null>(null);

const openDeleteDialog = (professionnel: Professionnel) => {
    professionnelToDelete.value = professionnel;
    deleteDialog.value = true;
};

const openDeleteContactProDialog = (contactProId: number) => {
    contactProToDelete.value = contactProId;
    deleteContactProDialog.value = true;
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

const deleteContactPro = () => {
    if (contactProToDelete.value) {
        router.delete(`/contact_pro/${contactProToDelete.value}`, {
            onSuccess: () => {
                deleteContactProDialog.value = false;
                contactProToDelete.value = null;
            },
            onError: (errors) => {
                // Gérer les erreurs si nécessaire
                console.error(
                    'Erreur lors de la suppression du contact professionnel.',
                    errors,
                );
            },
        });
    }
};

defineProps<{
    professionnel: Professionnel;
    contact_pros: Array<{
        id: number;
        prenom: string;
        nom: string;
        email?: string;
        telephone?: string;
        fonction?: {
            fonction: string;
        } | null;
    }>;
}>();
</script>

<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Détails du Professionnel</h1>
            <div class="rounded-lg bg-white p-6 shadow-md">
                <h2 class="mb-4 text-2xl font-semibold text-gray-800">
                    {{ professionnel.nom_societe }}
                </h2>
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
                Modifier la société
            </button>
            <button
                class="mt-6 ml-4 rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700"
                @click="openDeleteDialog(professionnel)"
            >
                Supprimer la société
            </button>
            <div class="mt-6">
                <h2 class="mb-4 text-2xl font-semibold text-gray-800">
                    Contacts Professionnels
                </h2>
                <button
                    class="mb-4 rounded bg-green-500 px-4 py-2 font-bold text-white hover:bg-green-700"
                    @click="
                        $inertia.visit(
                            `/contact_pro/create?professionnel_id=${professionnel.id}`,
                        )
                    "
                >
                    Ajouter un contact professionnel
                </button>
                <div
                    v-if="contact_pros && contact_pros.length > 0"
                    class="space-y-4"
                >
                    <div
                        v-for="contact in contact_pros"
                        :key="contact.id"
                        class="rounded-lg bg-gray-50 p-4"
                    >
                        <p class="mb-2">
                            <strong>Nom:</strong> {{ contact.prenom }}
                            {{ contact.nom }}
                        </p>
                        <p v-if="contact.fonction" class="mb-2">
                            <strong>Fonction:</strong>
                            {{ contact.fonction.fonction }}
                        </p>
                        <p v-if="contact.email" class="mb-2">
                            <strong>Email:</strong>
                            <a
                                :href="`mailto:${contact.email}`"
                                class="text-blue-600 hover:underline"
                                >{{ contact.email }}</a
                            >
                        </p>
                        <p v-if="contact.telephone" class="mb-2">
                            <strong>Téléphone:</strong>
                            <a
                                :href="`tel:${contact.telephone}`"
                                class="text-blue-600 hover:underline"
                                >{{ contact.telephone }}</a
                            >
                        </p>
                        <div class="mt-4 flex gap-2">
                            <button
                                class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"
                                @click="
                                    $inertia.visit(
                                        `/contact_pro/${contact.id}/edit`,
                                    )
                                "
                            >
                                Modifier
                            </button>
                            <button
                                class="rounded bg-red-500 px-4 py-2 font-bold text-white hover:bg-red-700"
                                @click="openDeleteContactProDialog(contact.id)"
                            >
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
                <p v-else class="text-gray-500">
                    Aucun contact professionnel enregistré.
                </p>
            </div>
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

        <!-- Dialog de confirmation de suppression pour les contacts professionnels -->
        <Dialog v-model:open="deleteContactProDialog">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Confirmer la suppression</DialogTitle>
                    <DialogDescription>
                        Êtes-vous sûr de vouloir supprimer ce contact
                        professionnel ? Cette action est irréversible.
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter>
                    <Button
                        type="button"
                        variant="outline"
                        @click="deleteContactProDialog = false"
                    >
                        Annuler
                    </Button>
                    <Button
                        type="button"
                        variant="destructive"
                        @click="deleteContactPro"
                    >
                        Supprimer
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>
