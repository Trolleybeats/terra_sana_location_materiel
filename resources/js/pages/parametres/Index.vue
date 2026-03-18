<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold">Paramètres</h1>
            </div>

            <!-- Contenu des paramètres -->
            <div class="rounded-lg bg-white p-6 shadow">
                <p class="text-gray-600">
                    Ici, vous pouvez gérer les paramètres de votre application.
                </p>
                <!-- Ajoutez ici les différentes sections de paramètres (ex: gestion des utilisateurs, préférences, etc.) -->
            </div>
            <div class="mt-6 grid gap-4 rounded-lg bg-white p-6 shadow">
                <p class="text-gray-600">
                    <a
                        @click="$inertia.visit('types/create')"
                        class="text-blue-600 hover:underline"
                        >Type d'utilisateurs</a
                    >
                </p>
            </div>
            <div class="mt-6 grid gap-4 rounded-lg bg-white p-6 shadow">
                <p class="text-gray-600">
                    <a
                        @click="$inertia.visit('langues/create')"
                        class="text-blue-600 hover:underline"
                        >Langue</a
                    >
                </p>
            </div>
            <div class="mt-6 grid gap-4 rounded-lg bg-white p-6 shadow">
                <p class="text-gray-600">
                    <a
                        @click="$inertia.visit('communes/create')"
                        class="text-blue-600 hover:underline"
                        >Commune</a
                    >
                </p>
            </div>
            <div class="mt-6 grid gap-4 rounded-lg bg-white p-6 shadow">
                <p class="text-gray-600">
                    <a
                        @click="$inertia.visit('pays/create')"
                        class="text-blue-600 hover:underline"
                        >Pays</a
                    >
                </p>
            </div>
            <div class="mt-6 grid gap-4 rounded-lg bg-white p-6 shadow">
                <p class="text-gray-600">
                    <a
                        @click="$inertia.visit('categories_materiel/create')"
                        class="text-blue-600 hover:underline"
                        >Catégorie de matériel</a
                    >
                </p>
            </div>
            <div class="mt-6 grid gap-4 rounded-lg bg-white p-6 shadow">
                <p class="text-gray-600">
                    <a
                        @click="$inertia.visit('fonctions/create')"
                        class="text-blue-600 hover:underline"
                        >Fonction de l'utilisateur</a
                    >
                </p>
            </div>
            <div class="mt-6 grid gap-4 rounded-lg bg-white p-6 shadow">
                <p class="text-gray-600">
                    <a
                        @click="$inertia.visit('statuts_paiement/create')"
                        class="text-blue-600 hover:underline"
                        >Statut de paiement</a
                    >
                </p>
            </div>
        </section>
    </AppLayout>
</template>
