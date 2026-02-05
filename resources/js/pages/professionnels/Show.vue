<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { Professionnel } from '@/types';

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
        </section>
    </AppLayout>
</template>
