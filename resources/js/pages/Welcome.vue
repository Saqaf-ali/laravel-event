<script setup lang="ts">
import CarouselImages from '@/components/Navigation/CarouselImages.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const images = [{ image_url: '/pexels-chi-n-ba-3626645-33765242.jpg' }];
</script>

<template>
    <Head title="Welcome" />
    <AppLayout>
        <!-- hero -->
        <section class="relative">
            <CarouselImages :images="images" class=" " />

            <div class="absolute inset-0 z-10 flex flex-col items-center justify-center bg-black/50 text-white">
                <h1 class="text-5xl font-bold">Welcome to Event Wave</h1>
                <p class="text-x mt-4 text-muted">Your one-stop shop for the hottest events!</p>
                <div class="mt-8 flex gap-4">
                    <Button size="lg">Get Started</Button>
                    <Button variant="outline" size="lg">Lorn More</Button>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
