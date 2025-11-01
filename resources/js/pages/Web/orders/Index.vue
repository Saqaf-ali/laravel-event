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
        accessorKey: 'id',
        header: 'ID',
    },

    {
        accessorKey: 'total_price',
        header: 'Total Price',
    },
    {
        accessorKey: 'statusLabel',
        header: 'Status',
        cell: ({ row }: { row: any }) => h('div', { class: `capitalize ${row.original.statusColor}` }, row.getValue('statusLabel')),
    },
    {
        accessorKey: 'updated_at',
        header: 'create at',
    },
    {
        id: 'actions',
        header: 'Order Items',
        enableHiding: false,
        cell: ({ row }: { row: any }) =>
            h(ButtonTip, {
                tip: 'View Order items',
                href: web.orders.show(row.original.id).url,
                icon: 'Eye',
            }),
    },
];

// --- CLEAR CART LOGIC ---
import { useCart } from '@/composables/useCart';
const { clearCart } = useCart();
clearCart();
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
