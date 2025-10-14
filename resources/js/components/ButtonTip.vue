<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { Link } from '@inertiajs/vue3';
import Icon from './Icon.vue';

interface Props {
    tip: string;
    asChild?: boolean;
    class?: string;
    href?: any;
    icon?: string;
}

const props = defineProps<Props>();

</script>

<template>
    <TooltipProvider>
        <Tooltip>
            <TooltipTrigger as-child>
                <Link :href="props.href" as="button">
                    <Button size="icon" variant="ghost" :aria-label="props.tip">
                        <Icon v-if="props.icon" :name="props.icon" />
                        <slot name="icon" v-else> </slot></Button
                ></Link>
            </TooltipTrigger>

            <TooltipContent>
                <p>{{ props.tip }}</p>
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>
