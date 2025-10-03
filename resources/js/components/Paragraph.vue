<script setup lang="ts">
interface Props {
    text: string;
}

defineProps<Props>();
</script>

<template>
    <p class="leading-7 [&:not(:first-child)]:mt-6">
        {{ text }}
    </p>
</template>
