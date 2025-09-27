<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import CarouselImages from '@/components/Navigation/CarouselImages.vue';
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import events from '@/routes/events';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    event: {
        type: Object,
        required: true,
    },
});
console.log(props.event);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Events',
        href: events.index().url,
    },
    {
        title: 'Show',
        href: events.show(props.event.id).url,
    },
];
</script>
<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <AppContent>
            <Card class="mx-auto max-w-4xl p-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h2 class="mb-2 text-2xl font-bold">{{ props.event.title }}</h2>
                        <p class="mb-4 text-gray-600">{{ props.event.description }}</p>
                        <div class="mb-2"><span class="font-semibold">Location:</span> {{ props.event.location }}</div>
                        <div class="mb-2">
                            <span class="font-semibold">Start Date:</span> {{ new Date(props.event.start_date).toLocaleDateString() }}
                        </div>
                        <div class="mb-2"><span class="font-semibold">End Date:</span> {{ new Date(props.event.end_date).toLocaleDateString() }}</div>
                    </div>
                    <div v-if="props.event.event_images && props.event.event_images.length > 0">
                        <CarouselImages :images="props.event.event_images" />
                    </div>
                </div>
            </Card>
        </AppContent>
    </AppLayout>
</template>
