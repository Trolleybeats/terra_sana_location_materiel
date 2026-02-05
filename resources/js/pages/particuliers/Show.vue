<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import type { Particulier } from '@/types';

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
        </section>
    </AppLayout>
</template>
