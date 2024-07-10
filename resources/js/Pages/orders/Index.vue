<script setup>
    import { ref } from 'vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import { EyeOutlined } from '@ant-design/icons-vue';
    const props = defineProps({
        ordersProp: {
            type: Object,
            required: true,
        }
    });
    const orders = ref(props.ordersProp);
    console.log(orders.value);
    
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex">
                    <h2>
                        <a href="" class="text-green-700">Ordenes</a>
                    </h2>
                </div>
                <table class="border-[1px] border-slate-700">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 font-semibold">Folio</th>
                            <th class="py-2 px-4 font-semibold">No.</th>
                            <th class="py-2 px-4 font-semibold"></th>
                            <th class="py-2 px-4 font-semibold"></th>
                            <th class="py-2 px-4 font-semibold">Fecha de recepcion</th>
                            <th class="py-2 px-4 font-semibold">Hora de recepcion</th>
                            <th class="py-2 px-1 text-left font-semibold">Cliente</th>
                            <th class="py-2 px-4 text-left font-semibold">Cesavedac</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders">
                            <td class="py-1 px-4">
                                <Dropdown align="center" width="96">
                                    <template #trigger>
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">{{ order.folio }}</button>
                                    </template>
                                    <template #content>
                                        <div v-for="muestra in order.muestras">
                                            <p class="py-0 mt-2 font-bold text-sm">{{ `MFQ-${order.folio} - ${muestra.numero_muestra}` }}</p>
                                            <p class="py-0 my-0 text-sm">
                                                <span class="font-bold">Identificacion de la muestra: </span> 
                                                {{ muestra.identificacion_muestra }}
                                            </p>
                                            <p class="py-0 my-0 text-sm">
                                                <span class="font-bold">Caracteristicas: </span>
                                                {{ muestra.caracteristicas }}
                                            </p>
                                            <p class="py-0 my-0 text-sm">
                                                <span class="font-bold">Muestreador: </span>
                                                {{ muestra.muestreador }}
                                            </p>
                                            <p class="py-0 my-0 text-sm">
                                                <span class="font-bold">pH: </span>
                                                {{ muestra.pH }}
                                            </p>
                                            <p class="py-0 my-0 text-sm">
                                                <span class="font-bold">Parametros: </span>
                                                {{ muestra.parametros }}
                                            </p>
                                            <template v-if="order.aguas_alimentos === 'Aguas'">
                                                <p class="py-0 my-0 text-sm">
                                                    <span class="font-bold">Cloro: </span>
                                                    {{ muestra.cloro }}
                                                </p>
                                                <p class="py-0 my-0 text-sm">
                                                    <span class="font-bold">Valor cloro: </span>
                                                    {{ muestra.valor_cloro }}
                                                </p>
                                            </template>
                                        </div>
                                    </template>
                                </Dropdown>
                            </td>
                            <td class="text-center text-sm">
                                {{ order.numero_muestras }}
                            </td>
                            <td class="text-center py-1 px-4 text-sm">
                                <div class="w-6 h-6 rounded-full" :class="{
                                    'bg-blue-500': order.aguas_alimentos === 'Aguas',
                                    'bg-yellow-400': order.aguas_alimentos === 'Alimentos'
                                }"></div>
                            </td>
                            <td class="py-1 px-4">
                                <a :href="`/orders/show/${order.id}`">
                                    <EyeOutlined/>
                                </a>
                            </td>
                            <td class="py-1 px-4 text-center text-sm">
                                {{ order.fecha_recepcion }}
                            </td>
                            <td class="py-1 px-4 text-center text-sm">
                                {{ order.hora_recepcion }}
                            </td>
                            <td class="py-1 px-4 text-left text-sm">
                                {{ order.cliente }}
                            </td>
                            <td class="py-1 px-4 text-left text-sm">
                                <div 
                                    v-if="order.cesavedac"
                                    class="w-6 h-6 rounded-full" 
                                    :class="{
                                        'bg-green-500': order.cesavedac
                                }">
                                    {{ order.cesavedac }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h3>Hi</h3>
            </div>
        </div>
    </AuthenticatedLayout>
</template>