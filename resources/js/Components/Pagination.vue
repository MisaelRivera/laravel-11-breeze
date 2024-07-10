<script setup>
    import { CaretLeftOutlined, CaretRightOutlined } from '@ant-design/icons-vue'; 
    const props = defineProps({
        page: {
            type: Number
        },

        pages: {
            type: Number,
        },

        items: {
            type: Number,
        },
    });
</script>
<template>
    <div class="flex">
        <a href="" v-if="page > pages">
            <CaretLeftOutlined/>
        </a>
        <div class="flex">
            <div 
                class="w-6 h-6 px-2 py-2 rounded-sm bg-blue-300 text-white"
                v-for="index in pages"
                :key="index">{{ index }}</div>
        </div>
    </div>
</template>