<script setup lang="ts">
import { defineProps } from 'vue';

interface HeroNormalPageProps {
    title: string;
    description: string;
}

const props = defineProps<HeroNormalPageProps>();
</script>
<template>
    <section class="relative bg-gradient-to-r from-primary to-accent py-20 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="mb-4 text-5xl font-bold text-primary-foreground">{{ title }}</h1>
            <p class="text-xl text-primary-foreground/90">{{ description }}</p>
        </div>
    </section>
</template>
