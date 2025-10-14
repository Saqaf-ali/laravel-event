<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';

const { orders } = defineProps<{
    orders: {
        data: {
            id: number;
            total_price: number;
            statusLabel: string;
            statusColor: string;
        }[];

        meta: {
            links: {
                label: string;
                url: string;
                active: boolean;
            }[];
        };
    };
}>();

console.log('orders1111111111111', orders);
</script>
<template>
    <div v-for="order in orders.data" :key="order.id">
        {{ order.id }}
    </div>

    <Link as="button" v-for="page in orders.meta.links" :key="page.label" :href="page.url" :disabled="!page.url">
        <Button v-html="page.label" :variant="page.active ? 'default' : 'outline'"></Button>
    </Link>
</template>
