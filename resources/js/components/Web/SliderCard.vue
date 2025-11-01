<script setup lang="ts">
import type { Event } from '@/types';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

// UI Components
import { Card, CardContent, CardHeader } from '@/components/ui/card';

// Local Components

import HeadingSmaller from '../HeadingSmaller.vue';
import Icon from '../Icon.vue';
import CarouselImages from '../Navigation/CarouselImages.vue';
import Badge from '../ui/badge/Badge.vue';
import { Button } from '../ui/button';
import CardFooter from '../ui/card/CardFooter.vue';
import CardTitle from '../ui/card/CardTitle.vue';

interface SliderCardProps {
    event: Event;
}

const props = defineProps<SliderCardProps>();

const formattedDate = computed(() => props.event.start_date.slice(0, 10));
const truncatedLocation = computed(() => props.event.location.slice(0, 10));
</script>

<template>
    <Link :href="`/web/events/${event.id}`" class="block h-full">
        <Card class="relative flex h-full flex-col overflow-hidden pb-0 shadow-lg transition-transform duration-300 hover:scale-[1.02]">
            <CarouselImages :images="event.event_images" class="h-44 w-full object-cover" />

            <Badge class="absolute top-2 right-2 z-10">{{ event.badgeText || 'New' }}</Badge>

            <CardHeader class="flex-grow p-4 pb-2">
                <CardTitle>
                    <HeadingSmaller :title="event.title" />
                </CardTitle>
            </CardHeader>

            <CardContent class="p-4 pt-2">
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm text-muted-foreground">
                        <div class="flex items-center gap-1">
                            <Icon name="CalendarIcon" size="16" />

                            <span>{{ formattedDate }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <Icon name="MapPinIcon" size="16" />
                            <span>{{ truncatedLocation }}</span>
                        </div>
                    </div>
                </div>
            </CardContent>

            <CardFooter class="p-4 pt-0">
                <Button class="w-full bg-accent hover:bg-accent/80"> View Event </Button>
            </CardFooter>
        </Card>
    </Link>
</template>
