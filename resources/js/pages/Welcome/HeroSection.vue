<script setup lang="ts">
import CarouselImages from '@/components/Navigation/CarouselImages.vue';
import { Button } from '@/components/ui/button';

const images = [{ image_url: '/pexels-chi-n-ba-3626645-33765242.jpg' }];
</script>

<template>
    <section class="relative h-1/2">
        <CarouselImages :images="images" />

        <div class="absolute inset-0 z-10 flex flex-col items-center justify-center bg-black/50">
            <h1 class="text-white">Welcome to Event Wave</h1>
            <p class="text-x mt-4 text-muted">Your one-stop shop for the hottest events!</p>
            <div class="mt-8 flex gap-4">
                <Button size="lg">Get Started</Button>
                <Button variant="outline" size="lg">Lorn More</Button>
            </div>
        </div>
    </section>
</template>
