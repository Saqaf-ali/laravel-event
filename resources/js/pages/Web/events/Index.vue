<script setup lang="ts">
import SliderCard from '@/components/Web/SliderCard.vue';
import AppLayout from '@/layouts/web/AppLayout.vue';
import type { Event } from '@/types';

const props = defineProps({
    events: Array<Event>(),
});
console.log(props.events);
</script>

<template>
    <AppLayout>
        <section class="bg-accent/10">
            <div class="container mx-auto grid grid-cols-1 gap-8 py-10 md:grid-cols-2 lg:grid-cols-3">
                <SliderCard v-for="event in events" :key="event.id" :event="event" class="h-120" />
            </div>
        </section>
    </AppLayout>
</template>
