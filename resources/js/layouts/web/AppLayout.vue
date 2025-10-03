<script setup lang="ts">
import WebFooter from '@/components/Web/Footer.vue';
import WebHeader from '@/components/Web/Header.vue';
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <WebHeader />
        <main class="flex-1">
            <slot />
        </main>
        <WebFooter />
    </div>
</template>
