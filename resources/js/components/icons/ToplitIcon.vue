<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { FolderX, Link } from 'lucide-vue-next';

defineProps({
    title: {
        type: String,
        required: true,
    },
    href: {
        type: String,
        required: true,
    },
    icon: {
        type: Object,
        required: true,
    },
    iconClasses: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <TooltipProvider>
        <Tooltip>
            <TooltipTrigger >
                <Link title="Organizers" :href="href">
                    <Button variant="outline" class="h-8 w-8 p-0">
                        <FolderX :class="`h-4 w-4 ${iconClasses}`" />
                    </Button>
                </Link>
            </TooltipTrigger>
            <TooltipContent>
                <p>{{ title }}</p>
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>
