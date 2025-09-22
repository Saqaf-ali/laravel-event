<script setup lang="ts">
import { Avatar, AvatarImage } from '@/components/ui/avatar';
import { computed } from 'vue';
import AvatarFallback from './ui/avatar/AvatarFallback.vue';
const props = defineProps({
    src: String,
    alt: String,
    name: {
        type: String,
        default: '',
    },
});
const letterName = computed(() => {
    if (!props.name) return '';
    const partName = props.name[0];
    return partName.toUpperCase();
});
</script>

<template>
    <Avatar>
        <AvatarImage :src="'storage/' + src" :alt="alt" />
        <AvatarFallback>{{ letterName }}</AvatarFallback>
    </Avatar>
</template>
