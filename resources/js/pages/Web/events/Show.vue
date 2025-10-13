<script setup lang="ts">
// Vue & Inertia
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

// Layouts
import AppLayout from '@/layouts/web/AppLayout.vue';

// Components
import Heading from '@/components/Heading.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import HeadingSmaller from '@/components/HeadingSmaller.vue';
import Icon from '@/components/Icon.vue';
import CarouselImages from '@/components/Navigation/CarouselImages.vue';
import Paragraph from '@/components/Paragraph.vue';
import { Button } from '@/components/ui/button';
import Input from '@/components/ui/input/Input.vue';
import Separator from '@/components/ui/separator/Separator.vue';

// Composables
import { useCart } from '@/composables/useCart';

// Types
import type { Event, Ticket } from '@/types';

const { event } = defineProps<{ event: Event }>();

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString(undefined, {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};

const formatTime = (dateString: string) => {
    return new Date(dateString).toLocaleTimeString(undefined, {
        hour: '2-digit',
        minute: '2-digit',
    });
};

// ---  CART LOGIC ---
const { addItem } = useCart();

const ticketQuantities = ref<{ [key: number]: number }>(
    event.tickets.reduce(
        (acc, ticket) => {
            acc[ticket.id] = 0;
            return acc;
        },
        {} as { [key: number]: number },
    ),
);

const addToCart = (ticket: Ticket) => {
    const quantity = ticketQuantities.value[ticket.id];
    if (quantity && quantity > 0) {
        addItem({
            id: ticket.id,
            name: ticket.type,
            price: ticket.price,
            quantity: quantity,
            image: event.event_images[0]?.image_url || '',
            event_id: event.id,
        });
    }
};
</script>

<template>
    <Head title="Event Details" />
    <AppLayout>
        <section class="py-16">
            <div class="container mx-auto p-4">
                <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
                    <!-- Event Details -->
                    <div class="space-y-6">
                        <Heading title="Event Details" :description="event.description" />
                        <ul class="space-y-3 pt-2">
                            <li class="flex items-center gap-3 text-sm text-muted-foreground">
                                <Icon name="CalendarIcon" />
                                <span>{{ formatDate(event.start_date) }} - {{ formatDate(event.end_date) }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-muted-foreground">
                                <Icon name="MapPinIcon" />
                                <span>{{ event.location }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-muted-foreground">
                                <Icon name="ClockIcon" />
                                <span>{{ formatTime(event.start_date) }}</span>
                            </li>
                        </ul>

                        <Separator class="my-6" />

                        <!-- Tickets Section -->
                        <div class="space-y-6">
                            <HeadingSmall title="Tickets" />

                            <div v-if="event.tickets && event.tickets.length > 0" class="space-y-4">
                                <div
                                    v-for="ticket in event.tickets"
                                    :key="ticket.id"
                                    class="flex flex-col items-start gap-4 rounded-lg border bg-card p-4 sm:flex-row sm:items-center sm:justify-between"
                                >
                                    <div class="flex-grow">
                                        <HeadingSmaller :title="ticket.type" :description="`Available: ${ticket.quantity}`" />
                                    </div>
                                    <div class="flex w-full items-center gap-4 sm:w-auto">
                                        <Paragraph :text="'$' + ticket.price" />

                                        <Input
                                            type="number"
                                            v-model.number="ticketQuantities[ticket.id]"
                                            min="0"
                                            :max="ticket.quantity"
                                            class="w-24"
                                        />
                                        <Button @click="addToCart(ticket)">Add to Cart</Button>
                                    </div>
                                </div>
                            </div>
                            <Paragraph text="No tickets available for this event." v-else />
                        </div>
                    </div>

                    <div>
                        <CarouselImages :images="event.event_images" class=" w-full object-cover" />
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
