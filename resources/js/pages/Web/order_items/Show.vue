<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const { purchasedTickets } = defineProps<{
    purchasedTickets: {
        data: {
            id: number;
            ticket_code: string;
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
    {
        accessorKey: 'ticket_code',
        header: 'Ticket Code',
    },
    {
        accessorKey: 'order_item.ticket.type',
        header: 'Ticket Type',
    },
    {
        accessorKey: 'order_item.ticket.price',
        header: 'Ticket Price',
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
    </AppLayout>
</template>
