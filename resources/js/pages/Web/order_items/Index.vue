<script setup lang="ts">
import ButtonTip from '@/components/ButtonTip.vue';
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/web/AppLayout.vue';
import web from '@/routes/web';
import { h } from 'vue';

const { orderItems } = defineProps<{
    orderItems: {
        data: {
            id: number;
            line_total: number;
            quantity: string;
            ticket: string;

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

console.log('order_items111', orderItems);
</script>
<template>
    <Head title="Checkout" />
    <AppLayout>
        <section class="py-16">
            <div class="container mx-auto p-4 md:max-w-1/2">
                <div class="mb-8 text-center">
                    <Heading title="Checkout" description="Complete your purchase" />
                </div>
            </div>
        </section>
    </AppLayout>
</template>
