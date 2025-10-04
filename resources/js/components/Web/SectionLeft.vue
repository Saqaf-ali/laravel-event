<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { defineProps } from 'vue';

defineProps({
    title: String,
    description: String,
    descriptionSecondary: String,
    image: String,
});
</script>
<template>
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
                <div>
                    <Heading :title="title" :description="description" />

                    <p v-show="descriptionSecondary" class="text-sm text-muted-foreground">{{ descriptionSecondary }}</p>
                </div>
                <div>
                    <img :src="image" :alt="title" class="h-auto w-full rounded-lg shadow-lg" />
                </div>
            </div>
        </div>
    </section>
</template>
