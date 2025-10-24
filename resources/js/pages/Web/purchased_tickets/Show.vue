<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Item, ItemContent, ItemDescription, ItemTitle } from '@/components/ui/item';
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const { purchasedTicket } = defineProps<{
    purchasedTicket: {
        data: {
            id: number;
            ticket_code: string;
            qr_code: string;
            order_item: {
                id: number;
                ticket: {
                    type: string;
                    price: number;
                    event: {
                        title: string;
                        start_date: string;
                        end_date: string;
                    };
                };
            };
        };
    };
}>();
</script>
<template>
    <Head title="purchased Tickets" />
    <AppLayout>
        <section class="py-16">
            <div class="container mx-auto p-4 md:max-w-1/2">
                <div class="mb-8 text-center">
                    <Heading title="Purchased Ticket" />
                </div>
                <Item>
                    <ItemContent>
                        <ItemTitle>Ticket Code: {{ purchasedTicket.data.ticket_code }}</ItemTitle>
                        <ItemDescription>Event: {{ purchasedTicket.data.order_item.ticket.event.title }}</ItemDescription>
                        <ItemDescription>Ticket Type: {{ purchasedTicket.data.order_item.ticket.type }}</ItemDescription>
                        <ItemDescription>Price: ${{ purchasedTicket.data.order_item.ticket.price }}</ItemDescription>
                        <ItemDescription>
                            Event Date: {{ purchasedTicket.data.order_item.ticket.event.start_date }} -
                            {{ purchasedTicket.data.order_item.ticket.event.end_date }}
                        </ItemDescription>
                        <div class="mt-4">
                            <img :src="purchasedTicket.data.qr_code" alt="QR Code" class="mx-auto h-48 w-48" />
                        </div>
                    </ItemContent>
                    <!-- <ItemActions>
                        <Button @click="window.print()">Print Ticket</Button>
                    </ItemActions> -->
                </Item>
            </div>
        </section>
    </AppLayout>
</template>
