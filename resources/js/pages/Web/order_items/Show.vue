<script setup lang="ts">
import ButtonTip from '@/components/ButtonTip.vue';
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import SmartAvatar from '@/components/SmartAvatar.vue';
import AppLayout from '@/layouts/web/AppLayout.vue';
import web from '@/routes/web';
import { Head } from '@inertiajs/vue3';
import { h } from 'vue';

const { purchasedTickets } = defineProps<{
    purchasedTickets: {
        data: {
            id: number;
            ticket_code: string;
            qr_code: string;
            order_item: {
                ticket: {
                    type: string;
                    price: number;
                };
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

const columns = [
    {
        accessorKey: 'id',
        header: 'ID',
    },
    // {
    //     accessorKey: 'ticket_code',
    //     header: 'Ticket Code',
    // },

    {
        accessorKey: 'qr_code',
        header: 'QR Code',
        cell: ({ row }: { row: any }) =>
            h(SmartAvatar, {
                src: row.getValue('qr_code'),
                alt: 'QR Code' + row.getValue('ticket_code'),
                name: row.getValue('ticket_code'),
            }),
    },

    {
        accessorKey: 'order_item.ticket.type',
        header: 'Ticket Type',
    },
    {
        accessorKey: 'order_item.ticket.price',
        header: 'Ticket Price',
    },
     {
        id: 'actions',
        header: 'Details',
        enableHiding: false,
        cell: ({ row }: { row: any }) =>
            h(ButtonTip, {
                tip: 'View Order items',
                href: web.orders.show(row.original.id).url,
                icon: 'Eye',
            }),
    },
];

console.log('purchasedTickets', purchasedTickets);
</script>
<template>
    <Head title="Checkout" />
    <AppLayout>
        <section class="py-16">
            <div class="container mx-auto p-4 md:max-w-1/2">
                <div class="mb-8 text-center">
                    <Heading title="Purchased Tickets" description="Review your purchased tickets and event details." />
                </div>
                <DataTable :data="purchasedTickets.data" :columns="columns" :pagination="purchasedTickets.meta" />
            </div>
        </section>
        <img src="" alt="" />
    </AppLayout>
</template>
