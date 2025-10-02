<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';

// eslint-disable-next-line vue/no-dupe-keys
import orders from '@/routes/orders';
import { type BreadcrumbItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BadgePlus, FolderX } from 'lucide-vue-next';

const props = defineProps({
    orders: {
        type: Array,
        required: true,
    },
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Orders',
        href: orders.index().url,
    },
];

console.log('orders', props.orders);
</script>

<template>
    <!-- <img :src="props.orders[0].event.event_images[0].image_url" alt=""> -->
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="w-full">
            <div class="flex items-center py-4">
                <div class="ml-auto flex items-center space-x-2">
                    <Link as="button" :href="orders.trashed().url" type="Trash orders">
                        <Button variant="outline" class="h-8 w-8 p-0">
                            <FolderX class="h-4 w-4 text-primary" />
                        </Button>
                    </Link>

                    <Link type="Add New ticket" :href="orders.create().url">
                        <Button variant="outline" class="h-8 w-8 p-0">
                            <BadgePlus class="h-4 w-4 text-primary" />
                        </Button>
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
