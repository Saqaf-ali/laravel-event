<script setup lang="ts">
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import CallToActionSection from './Welcome/CallToActionSection.vue';
import FeaturesSection from './Welcome/FeaturesSection.vue';
import HeroSection from './Welcome/HeroSection.vue';
</script>

<template>
    <Head title="Welcome" />
    <AppLayout class>
        <HeroSection />
        <FeaturesSection class="py-20" />
        <CallToActionSection />
    </AppLayout>
</template>
