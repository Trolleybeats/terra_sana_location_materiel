<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { User } from '@/types';

defineProps<{
    users: User[];
}>();
</script>

<template>
    <AppLayout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="mb-6 text-3xl font-bold">Utilisateurs</h1>

            <div class="overflow-hidden rounded-lg bg-white shadow-md">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                ID
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                Nom
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                Email
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                            >
                                Date de création
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr
                            v-for="user in users"
                            :key="user.id"
                            class="hover:bg-gray-50"
                        >
                            <td
                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-900"
                            >
                                {{ user.id }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm font-medium whitespace-nowrap text-gray-900"
                            >
                                {{ user.name }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500"
                            >
                                {{ user.email }}
                            </td>
                            <td
                                class="px-6 py-4 text-sm whitespace-nowrap text-gray-500"
                            >
                                {{
                                    new Date(
                                        user.created_at,
                                    ).toLocaleDateString('fr-FR')
                                }}
                            </td>
                        </tr>
                        <tr v-if="users.length === 0">
                            <td
                                colspan="4"
                                class="px-6 py-4 text-center text-sm text-gray-500"
                            >
                                Aucun utilisateur trouvé
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
