<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { Link } from '@inertiajs/vue3';

interface Props {
    tip: string;
    asChild?: boolean;
    class?: string;
    href?: string;
}

const props = defineProps<Props>();
</script>

<template>
    <TooltipProvider>
        <Tooltip>
            <TooltipTrigger as-child>
                <Link :href="props.href">
                    <Button size="icon" variant="ghost" :aria-label="props.tip"> <slot name="icon"></slot> </Button
                ></Link>
            </TooltipTrigger>

            <TooltipContent>
                <p>{{ props.tip }}</p>
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>
