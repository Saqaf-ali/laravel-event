<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { test } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { DataTable } from 'primevue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Test',
        href: test().url,
    },
];

// const openDialog = ref(false);
</script>
<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <DataTable >
            <Column field="name" header="name"> </Column>
            <Column field="email" header="email"></Column>
            <Column field="phone" header="phone"></Column>
            <Column field="address" header="address"></Column>
            <Column field="city" header="city"></Column>
        </DataTable>
    </AppLayout>
</template>
