<script setup lang="ts">
import type { Event } from '@/types';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

// UI Components
import { Card, CardContent, CardHeader } from '@/components/ui/card';

// Local Components

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
const truncatedDescription = computed(() => props.event.description.slice(0, 100) + '...');
</script>

<template>
    <Link :href="`/web/events/${event.id}`" class="block h-full">
        <Card class="relative flex h-full flex-col overflow-hidden pb-0 shadow-lg transition-transform duration-300">
            <CarouselImages :images="event.event_images" class="h-44 w-full object-cover" />

            <Badge class="absolute top-2 right-2 z-10">New</Badge>

            <CardHeader class="flex-grow p-4 pb-0">
                <CardTitle>
                    <h3 class="line-clamp-2 text-xl leading-snug font-semibold text-foreground">
                        {{ event.title }}
                    </h3>
                </CardTitle>
            </CardHeader>

            <CardContent class="p-4 pt-2">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <Icon name="Calendar" size="16" class="text-accent" />
                        <span class="text-sm text-muted-foreground">{{ formattedDate }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <Icon name="MapPin" size="16" class="text-accent" />
                        <span class="line-clamp-1 text-sm text-muted-foreground">{{ truncatedLocation }}</span>
                    </div>
                </div>
            </CardContent>

            <CardFooter class="p-4 pt-0">
                <Button variant="outline" size="" class="w-full text-sm"> View Event </Button>
            </CardFooter>
        </Card>
    </Link>
</template>
