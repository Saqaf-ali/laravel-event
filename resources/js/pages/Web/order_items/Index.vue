<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/web/AppLayout.vue';

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
        cell: ({ row }) => row.getValue('id'),
    },

    {
        accessorKey: 'ticket.type',
        header: 'Ticket Type',
        cell: ({ row }) => row.original.ticket.type,
    },

    {
        accessorKey: 'ticket.price',
        header: 'Ticket Price',
        cell: ({ row }) => row.original.ticket.price,
    },
    {
        accessorKey: 'quantity',
        header: 'Quantity',
        cell: ({ row }) => row.getValue('quantity'),
    },
    {
        accessorKey: 'line_total',
        header: 'Line Total',
        cell: ({ row }) => row.getValue('line_total'),
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
