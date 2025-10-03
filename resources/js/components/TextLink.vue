<script setup lang="ts">
import { LinkComponentBaseProps, Method } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';

interface Props {
    href: LinkComponentBaseProps['href'];
    method?: Method;
    as?: string;
}

defineProps<Props>();
</script>

<template>
    <Link :href="href" :method="method" :as="as" class="text-sm font-medium transition-colors hover:text-accent">
        <slot />
    </Link>
</template>
