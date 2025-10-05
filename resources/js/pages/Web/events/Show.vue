<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import HeadingSmaller from '@/components/HeadingSmaller.vue';
import Icon from '@/components/Icon.vue';
import CarouselImages from '@/components/Navigation/CarouselImages.vue';
import Paragraph from '@/components/Paragraph.vue';
import { Button } from '@/components/ui/button';
import Separator from '@/components/ui/separator/Separator.vue';
import AppLayout from '@/layouts/web/AppLayout.vue';
import type { Event } from '@/types';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
    event: Event;
}>();

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
</script>

<template>
    <Head title="Event Details" />
    <AppLayout>
        <section class="bg- py-16">
            <div class="container mx-auto p-4">
                <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
                    <!-- Event Details -->
                    <div class="space-y-4">
                        <Heading title="Event Details" :description="props.event.description" />
                        <ul class="space-y-3 pt-2">
                            <li class="flex items-center gap-3 text-sm text-muted-foreground">
                                <Icon name="CalendarIcon" />
                                <span>{{ formatDate(props.event.start_date) }} - {{ formatDate(props.event.end_date) }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-muted-foreground">
                                <Icon name="MapPinIcon" />
                                <span>{{ props.event.location }}</span>
                            </li>
                            <li class="flex items-center gap-3 text-sm text-muted-foreground">
                                <Icon name="ClockIcon" />
                                <span>{{ formatTime(props.event.start_date) }}</span>
                            </li>
                        </ul>

                        <Separator class="my-6" />

                        <!-- Tickets Section -->
                        <div class="space-y-4">
                            <HeadingSmall title="Tickets" />

                            <div v-if="props.event.tickets && props.event.tickets.length > 0" class="space-y-4">
                                <div
                                    v-for="ticket in props.event.tickets"
                                    :key="ticket.id"
                                    class="flex flex-col items-start gap-4 rounded-lg border bg-card p-4 sm:flex-row sm:items-center sm:justify-between"
                                >
                                    <div class="flex-grow">
                                        <HeadingSmaller :title="ticket.type" :description="'available' + ticket.quantity" />
                                    </div>
                                    <div class="flex w-full items-center gap-4 sm:w-auto">
                                        <Paragraph :text="'$' + ticket.price" />
                                        <Button>Select</Button>
                                    </div>
                                </div>
                            </div>
                            <Paragraph text="No tickets available for this event." v-else />
                        </div>
                    </div>

                    <div>
                        <CarouselImages :images="props.event.event_images" class="h-96 w-full object-cover" />
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
