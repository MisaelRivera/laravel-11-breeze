<script setup>
    import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
    const props = defineProps({
        ordersProp: {
            type: Object,
            required: true,
        }
    });
    const orders = ref(props.ordersProp);
    console.log(orders.value.data);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <table>
                    <thead>
                        <tr>
                            <th>Folio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders.data">
                            <td>{{ order.folio }}</td>
                        </tr>
                    </tbody>
                </table>
                <h3>Hi</h3>
            </div>
        </div>
    </AuthenticatedLayout>
</template>