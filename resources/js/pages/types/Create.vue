<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    types: {
        type: Array,
    },
});

const form = useForm({
    type: '',
});

function submit() {
    form.post('/types', {
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>
<template>
    <AppLayout>
        <section class="container mx-auto px-4 py-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold">Créer un type d'utilisateur</h1>
            </div>

            <div class="rounded-lg bg-white p-6 shadow">
                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <label
                            for="type"
                            class="block text-sm font-medium text-gray-700"
                            >Type d'utilisateur</label
                        >
                        <input
                            v-model="form.type"
                            type="text"
                            id="type"
                            name="type"
                            required
                            class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        />
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase hover:bg-blue-700"
                        >
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
