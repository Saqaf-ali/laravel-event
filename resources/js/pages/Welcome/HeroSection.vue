<script setup lang="ts">
import CarouselImages from '@/components/Navigation/CarouselImages.vue';
import { Button } from '@/components/ui/button';

const images = [{ image_url: '/pexels-chi-n-ba-3626645-33765242.jpg' }];
</script>

<style scoped>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hero-title {
    animation: fadeInUp 1s ease-out 0.2s forwards;
}

.hero-subtitle {
    animation: fadeInUp 1s ease-out 0.4s forwards;
}

.hero-buttons {
    animation: fadeInUp 1s ease-out 0.6s forwards;
}
</style>

<template>
    <section class="relative h-screen max-h-[900px] min-h-[600px] overflow-hidden">
        <CarouselImages :images="images" class="h-screen" />

        <!-- Enhanced gradient overlay with depth -->
        <div class="absolute inset-0 z-10 bg-gradient-to-b from-black/60 via-black/50 to-black/70" />

        <!-- Content container with better spacing and animations -->
        <div class="absolute inset-0 z-20 flex flex-col items-center justify-center px-4 text-center">
            <!-- Main heading with enhanced typography -->
            <h1 class="hero-title mb-6 text-5xl font-bold tracking-tight text-white opacity-0 sm:text-6xl md:text-7xl lg:text-8xl">
                Welcome to
                <span class="block bg-gradient-to-r from-primary via-purple-400 to-pink-400 bg-clip-text text-transparent drop-shadow-lg">
                    Event Wave
                </span>
            </h1>

            <!-- Subtitle with better styling -->
            <p class="hero-subtitle mb-10 max-w-2xl text-lg font-light text-white/90 opacity-0 drop-shadow-md sm:text-xl md:text-2xl">
                Your one-stop shop for the hottest events! Discover, book, and experience unforgettable moments.
            </p>

            <!-- Enhanced button group -->
            <div class="hero-buttons flex flex-col gap-4 opacity-0 sm:flex-row">
                <Button size="lg" class="h-12 min-w-[180px] text-base font-semibold shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                    Get Started
                </Button>
                <Button
                    variant="outline"
                    size="lg"
                    class="h-12 min-w-[180px] border-2 border-white/30 bg-white/10 text-base font-semibold text-white backdrop-blur-sm transition-all hover:scale-105 hover:border-white/50 hover:bg-white/20"
                >
                    Learn More
                </Button>
            </div>

            <!-- Decorative elements for visual interest -->
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
                <svg class="h-6 w-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </div>
    </section>
</template>
