<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Calendar } from '@/components/ui/calendar';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { cn } from '@/lib/utils';
import type { DateValue } from '@internationalized/date';
import { DateFormatter, getLocalTimeZone } from '@internationalized/date';
import { CalendarIcon } from 'lucide-vue-next';

// 💡 1. استخدام defineModel لاستقبال v-model من vee-validate
const modelValue = defineModel<DateValue | undefined>();

const df = new DateFormatter('en-US', {
    dateStyle: 'long',
});
</script>

<template>
    <Popover>
        <PopoverTrigger as-child>
            <Button variant="outline" :class="cn('w-[280px] justify-start text-left font-normal', !modelValue && 'text-muted-foreground')">
                <CalendarIcon class="mr-2 h-4 w-4" />
                {{ modelValue ? df.format(modelValue.toDate(getLocalTimeZone())) : 'Pick a date' }}
            </Button>
        </PopoverTrigger>
        <PopoverContent class="w-auto p-0">
            <Calendar v-model="modelValue" initial-focus />
        </PopoverContent>
    </Popover>
</template>
