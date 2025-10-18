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
            ticket: {
                type: string;
                price: number;
            };
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

// data table
const columns = [
    {
        accessorKey: 'id',
        header: 'ID',
    },

    {
        accessorKey: 'ticket.type',
        header: 'Ticket Type',
    },

    {
        accessorKey: 'ticket.price',
        header: 'Ticket Price',
    },
    {
        accessorKey: 'quantity',
        header: 'Quantity',
    },
    {
        accessorKey: 'line_total',
        header: 'Line Total',
    },
    {
        id: 'actions',
        header: 'Details',
        enableHiding: false,
        cell: ({ row }) =>
            h(ButtonTip, {
                tip: 'View Tickets',
                href: web.,
                icon: 'Eye',
            }),
    },
];

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
                <DataTable :data="orderItems.data" :columns="columns" :pagination="orderItems.meta" />
            </div>
        </section>
    </AppLayout>
</template>
