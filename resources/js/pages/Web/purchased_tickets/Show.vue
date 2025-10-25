<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import HeadingSmaller from '@/components/HeadingSmaller.vue';
import Paragraph from '@/components/Paragraph.vue';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent } from '@/components/ui/card';
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

interface Event {
    title: string;
    location: string;
    start_date: string;
    end_date: string;
}

interface Ticket {
    type: string;
    price: number;
    event: Event;
}

interface OrderItem {
    id: number;
    ticket: Ticket;
}

interface PurchasedTicket {
    id: number;
    ticket_code: string;
    qr_code: string;
    order_item: OrderItem;
}

const props = defineProps<{
    purchasedTicket: {
        data: PurchasedTicket;
    };
}>();

const ticketData = computed(() => props.purchasedTicket.data);
const eventData = computed(() => ticketData.value.order_item.ticket.event);
</script>
<template>
    <Head title="purchased Tickets" />
    <AppLayout>
        <section class="py-16">
            <div class="container mx-auto p-4 md:max-w-xl">
                <div class="mb-8 text-center">
                    <Heading title="Purchased Ticket" />
                </div>

                <Card class="w-full max-w-xl p-6">
                    <div class="mb-6 text-center">
                        <HeadingSmaller title="Ticket Details" class="mb-4 text-primary" />
                        <Paragraph
                            text="Present this ticket at the event entrance. Each ticket is valid for one entry."
                            class="text-muted-foreground"
                        />
                    </div>

                    <CardContent class="flex items-start space-x-6 p-0">
                        <div class="flex-shrink-0 text-center">
                            <img :src="ticketData.qr_code" alt="QR Code" class="h-32 w-32 rounded-md object-cover" />
                            <Paragraph text="Scan for Entry" class="mt-2 text-xs" />
                        </div>

                        <div class="flex-grow space-y-3">
                            <div class="flex items-center justify-between border-b border-dashed border-border pb-2">
                                <HeadingSmaller :title="ticketData.ticket_code" />
                                <Badge :variant="ticketData.order_item.ticket.type === 'VIP' ? 'default' : 'secondary'" class="py-0.5 tracking-wide">
                                    {{ ticketData.order_item.ticket.type }}
                                </Badge>
                            </div>

                            <div class="grid grid-cols-[80px_1fr] gap-x-2 gap-y-2 text-sm">
                                <Paragraph text="Event:" as="span" />
                                <Paragraph :text="eventData.title" class="font-medium text-card-foreground" as="span" />
                                <Paragraph text="Location:" as="span" />
                                <Paragraph :text="eventData.location" class="font-medium text-card-foreground" as="span" />
                                <Paragraph text="Date:" as="span" />
                                <Paragraph
                                    :text="eventData.start_date + ' - ' + eventData.end_date"
                                    class="font-medium text-card-foreground"
                                    as="span"
                                />
                            </div>

                            <div class="flex items-center justify-between border-t border-dashed border-border pt-2">
                                <Paragraph text="Price" class="text-xl" />
                                <Paragraph :text="'$' + ticketData.order_item.ticket.price" class="text-primary" />
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </section>
    </AppLayout>
</template>
