<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import Heading from '@/components/Heading.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import CarouselImages from '@/components/Navigation/CarouselImages.vue';
import { CardContent, CardHeader } from '@/components/ui/card';
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
            <Card class="mx-auto max-w-4xl border-none bg-card p-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <CardHeader>
                        <Heading class="text-primary" :title="props.event.title" :description="props.event.description" />
                    </CardHeader>
                    <CardContent>
                        <div class="flex flex-wrap space-y-4">
                            <AppContent class="flex-2/2">
                                <HeadingSmall title="Location" :description="props.event.location" />
                            </AppContent>
                            <AppContent>
                                <HeadingSmall title="Start Date" :description="new Date(props.event.start_date).toLocaleDateString()" />
                            </AppContent>
                            <AppContent>
                                <HeadingSmall title="End Date" :description="new Date(props.event.end_date).toLocaleDateString()" />
                            </AppContent>
                            <AppContent>
                                <HeadingSmall title="Created At" :description="new Date(props.event.created_at).toLocaleDateString()" />
                            </AppContent>
                        </div>
                    </CardContent>

                    <div v-if="props.event.event_images && props.event.event_images.length > 0">
                        <CarouselImages :images="props.event.event_images" />
                    </div>

                    <CardContent>
                        <!-- <Heading title="Organizer Details" /> -->
                        <div class="flex flex-wrap gap-2 space-y-4">
                            <AppContent class="flex-2/2">
                                <HeadingSmall title="Name" :description="props.event.organizer.name" />
                            </AppContent>
                            <AppContent>
                                <HeadingSmall title="Email" :description="props.event.organizer.user.email" />
                            </AppContent>
                            <AppContent>
                                <HeadingSmall title="user" :description="props.event.organizer.user.name" />
                            </AppContent>
                            <AppContent>
                                <HeadingSmall title="Number Imgs" :description="props.event.event_images.length" />
                            </AppContent>
                        </div>
                    </CardContent>
                </div>
            </Card>
        </AppContent>
    </AppLayout>
</template>
