<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import type { Component } from 'vue';

interface Props {
    tip: string;
    asChild?: boolean;
    class?: string;
}

const props = defineProps<Props>();
</script>

<template>
    <TooltipProvider>
        <Tooltip>
            <TooltipTrigger as-child>
                <Button size="icon" variant="ghost" :aria-label="props.tip">
                    <slot name="icon"></slot>
                </Button>
            </TooltipTrigger>

            <TooltipContent>
                <p>{{ props.tip }}</p>
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>
