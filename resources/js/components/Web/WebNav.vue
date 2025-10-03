<script setup lang="ts">
import type { NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    items: NavItem[];
}>();
</script>

<template>
    <nav class="flex flex-col gap-2">
        <Link
            v-for="(item, index) in items"
            :key="index"
            :href="item.href"
            class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium hover:bg-muted"
        >

            {{ item.title }}
        </Link>
    </nav>
</template>
