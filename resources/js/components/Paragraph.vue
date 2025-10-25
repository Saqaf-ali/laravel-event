<script setup lang="ts">
interface Props {
    text: any;
    class?: string;
    as?: string;
}

const props = withDefaults(defineProps<Props>(), {
    class: 'text-muted-foreground',
    as: 'p',
});
</script>

<template>
    <as class="text-xs" :class="props.class">
        {{ text }}
    </as>
</template>
