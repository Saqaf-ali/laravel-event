<script setup lang="ts">
import ButtonTip from '@/components/ButtonTip.vue';
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/web/AppLayout.vue';
import web from '@/routes/web';
import { h } from 'vue';

const { orders } = defineProps<{
    orders: {
        data: {
            id: number;
            total_price: number;
            statusLabel: string;
            statusColor: string;
            updated_at: string;
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
        accessorKey: 'index_number', // مفتاح وهمي، لا يحتاج لبيانات من Laravel
        header: '#', // رأس عمود بسيط
        cell: ({ row }) => row.index + 1, // يعرض: 1, 2, 3, ...
        size: 50, // عمود صغير ومرتب
    },
    {
        accessorKey: 'id',
        header: 'ID',
        cell: ({ row }) => row.getValue('id'),
    },

    {
        accessorKey: 'total_price',
        header: 'Total Price',
        cell: ({ row }) => row.getValue('total_price'),
    },
    {
        accessorKey: 'statusLabel',
        header: 'Status',
        cell: ({ row }) => h('div', { class: `capitalize ${row.original.statusColor}` }, row.getValue('statusLabel')),
    },
    {
        accessorKey: 'updated_at',
        header: 'create at',
        cell: ({ row }) => row.getValue('updated_at'),
    },
    {
        id: 'actions',
        header: 'Details',
        enableHiding: false,
        cell: ({ row }) =>
            h(ButtonTip, {
                tip: 'View Order items',
                href: web.orders.show(row.original.id).url,
                icon: 'Eye',
            }),
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
                <DataTable :data="orders.data" :columns="columns" :pagination="orders.meta" />
            </div>
        </section>
    </AppLayout>
</template>
