<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Column, DataTable } from 'primevue';

const props = defineProps(['organizers']);
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Organizers',
        href: 'organizers',
    },
];
console.log('organizers:');
console.log(props.organizers);
</script>
<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <DataTable :value="props.organizers">
            <Column field="id" header="ID"></Column>
            <Column field="name" header="Name"></Column>
        </DataTable>
    </AppLayout>
</template>
