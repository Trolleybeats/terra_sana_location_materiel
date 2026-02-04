<script setup>
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    type_id: '1',
});

const submit = () => {
    form.post('/utilisateurs', {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <p
                class="mb-4 inline-block rounded-lg border-2 bg-gray-100 px-3 py-1 hover:bg-gray-200"
            >
                <a href="/utilisateurs">← Retour à la liste des utilisateurs</a>
            </p>
            <h1 class="mb-6 text-3xl font-bold">Créer un utilisateur</h1>
            <!-- Formulaire de création d'utilisateur -->
            <form
                @submit.prevent="submit"
                class="space-y-4 rounded-lg bg-white p-6 shadow-md"
            >
                <div>
                    <label
                        for="email"
                        class="mb-2 block font-medium text-gray-700"
                        >Email</label
                    >
                    <input
                        type="email"
                        id="email"
                        name="email"
                        v-model="form.email"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                </div>
                <div>
                    <label
                        for="password"
                        class="mb-2 block font-medium text-gray-700"
                        >Mot de passe</label
                    >
                    <input
                        type="password"
                        id="password"
                        name="password"
                        v-model="form.password"
                        required
                        class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    />
                </div>
                <div>
                    <label
                        for="type_id"
                        class="mb-2 block font-medium text-gray-700"
                        >Type d'utilisateur</label
                    >
                    <select
                        id="type_id"
                        name="type_id"
                        v-model="form.type_id"
                        required
                        class="w-full cursor-pointer rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
                    >
                        <option value="1">Particulier</option>
                        <option value="2">Professionnel</option>
                        <option value="3">Administrateur</option>
                    </select>
                </div>
                <div>
                    <Button
                        type="submit"
                        class="cursor-pointer"
                        :disabled="form.processing"
                    >
                        Créer l'utilisateur
                    </Button>
                </div>
            </form>
        </section>
    </AppLayout>
</template>
