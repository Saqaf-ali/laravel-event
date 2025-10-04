<script setup lang="ts">
interface Props {
    title: string;
    description?: string;
    class?: string;
}

const props = defineProps<Props>();
</script>

<template>
    <header :class="props.class">
        <h4 class="mb-0.5 text-base font-medium">{{ title }}</h4>
        <p v-if="description" class="text-sm text-muted-foreground">
            {{ description }}
        </p>
    </header>
</template>
