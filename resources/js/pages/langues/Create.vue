<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    langues: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    langue: '',
});

const submitForm = () => {
    form.post('/langues', {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
<template>
    <AppLayout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Ajouter une Langue</h1>

            <form @submit.prevent="submitForm" class="max-w-md">
                <div class="mb-4">
                    <label
                        for="langue"
                        class="block text-sm font-medium text-gray-700"
                        >Langue</label
                    >
                    <input
                        v-model="form.langue"
                        type="text"
                        id="langue"
                        name="langue"
                        class="focus:ring-opacity-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                        required
                    />
                </div>

                <button
                    type="submit"
                    class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase hover:bg-blue-700"
                >
                    Ajouter
                </button>
            </form>
        </div>
    </AppLayout>
</template>
