<script setup lang="ts">
import web from '@/routes/web';

import ButtonTip from '../ButtonTip.vue';
import Icon from '../Icon.vue';
import { Button } from '../ui/button';
import { id } from 'zod/v4/locales';
const props = defineProps<{
    id: number;
    tip: string;
    href: string;
    icon: string;
}>();

</script>

<template>
    <ButtonTip
        tip="View Order"
        :href="

        "
    >
        <template #icon>
            <Button size="icon" variant="ghost">
                <Icon name="Eye" size="20" />
            </Button>
        </template>
    </ButtonTip>
</template>
