<script setup lang="ts">
import type { Event } from '@/types';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

// UI Components
import { Card, CardContent } from '@/components/ui/card';

// Local Components

import HeadingSmaller from '../HeadingSmaller.vue';
import Icon from '../Icon.vue';
import CarouselImages from '../Navigation/CarouselImages.vue';
import Badge from '../ui/badge/Badge.vue';

interface SliderCardProps {
    event: Event;
}

const props = defineProps<SliderCardProps>();

const formattedDate = computed(() => props.event.start_date.slice(0, 10));
const truncatedLocation = computed(() => props.event.location.slice(0, 10));
</script>

<template>
    <Link :href="`/web/events/${event.id}`" class="block h-80">
        <Card class="relative flex h-full flex-col overflow-hidden p-0 pb-0 shadow-lg transition-transform duration-300 hover:scale-[1.02]">
            <CarouselImages :images="event.event_images" class="inset-0 h-100 w-full rounded-lg object-cover shadow-md" />

            <Badge class="absolute top-2 right-2 z-10">{{ event.badgeText || 'New' }}</Badge>

            <CardContent class="absolute bottom-0 w-full bg-black/50 p-4">
                <div class="space-y-2">
                    <HeadingSmaller :title="event.title" />
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

            <!-- <CardFooter class="p-4 pt-0">
                <Button class="w-full bg-accent hover:bg-accent/80"> View Event </Button>
            </CardFooter> -->
        </Card>
    </Link>
</template>
