<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { test } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Test',
        href: test().url,
    },
];
</script>

<template>
    <Head title="Test" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <form action="">
            <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">


            </div>
        </form>
    </AppLayout>
</template>
