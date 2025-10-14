<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/web/AppLayout.vue';

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

// data table
const columns = [
    {
        accessorKey: 'id',
        header: 'ID',
        cell: ({ row }) => row.index + 1,
    },
    {
        accessorKey: 'total_price',
        header: 'Total Price',
        cell: ({ row }) => row.getValue('total_price'),
    },
    {
        accessorKey: 'statusLabel',
        header: 'Status',
        cell: ({ row }) => row.getValue('statusLabel'),
    },
];

console.log('orders1111111111111', orders);
</script>
<template>
    <Head title="Checkout" />
    <AppLayout>
        <section class="py-16">
            <div class="container mx-auto p-4 md:max-w-1/2">
                <div class="mb-8 text-center">
                    <Heading title="Checkout" description="Complete your purchase" />
                </div>
                <DataTable :data="orders.data" :columns="columns" columnFilter="" :pagination="orders.meta" :laravelPagination="true" />
            </div>
        </section>
    </AppLayout>
</template>
