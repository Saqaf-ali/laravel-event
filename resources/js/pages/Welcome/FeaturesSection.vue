<script setup lang="ts">
import Icon from '@/components/Icon.vue';

const features = [
    {
        icon: 'TentTree',
        title: 'Diverse Events',
        description: 'We offer a wide array of events, from music concerts and art exhibitions to tech conferences and food festivals.',
    },
    {
        icon: 'Ticket',
        title: 'Tickets',
        description: 'Effortlessly purchase and manage your tickets within the app. Secure your spot at your favorite events with just a few taps.',
    },
    {
        icon: 'Users',
        title: 'Community',
        description: 'Connect with other event-goers, share your experiences, and discover new events through a vibrant community.',
    },
];
</script>
<template>
    <section class="container mx-auto px-4 py-16 text-center">
        <h2 class="mb-12">Our Features</h2>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div v-for="feature in features" :key="feature.title" class="flex flex-col items-center text-center">
                <Icon :name="feature.icon" size="48" class="mb-4 text-primary" />
                <h3>{{ feature.title }}</h3>
                <p class="text-sm text-muted-foreground">
                    {{ feature.description }}
                </p>
            </div>
        </div>
    </section>
</template>
