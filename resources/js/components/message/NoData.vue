<script setup lang="ts">
defineProps({
    msg: {
        type: String,
        default: 'No data available.',
    },
});
</script>

<template>
    <div class="flex items-center justify-center py-10">
        <p class="text-muted-foreground">{{ msg }}</p>
    </div>
</template>
