<script setup lang="ts">
import type { User } from '@/types';
import SmartAvatar from './SmartAvatar.vue';

interface Props {
    user: User;
    showEmail?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    showEmail: false,
});

</script>

<template>
    <div class="flex items-center gap-3">
        <SmartAvatar :src="props.user.image_url" :name="props.user.name" :alt="props.user.name" />
        <div class="grid flex-1 text-left text-sm leading-tight">
            <span class="truncate font-medium">{{ user.name }}</span>
            <span v-if="showEmail" class="truncate text-xs text-muted-foreground">{{ user.email }}</span>
        </div>
    </div>
</template>
