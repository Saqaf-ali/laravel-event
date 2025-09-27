<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import { Undo2 } from 'lucide-vue-next';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link :href="href" as="button" class="ml-2" title="back">
        <Button type="button" variant="outline"> <Undo2 class="mr-2 h-4 w-4" />Back </Button>
    </Link>
</template>
