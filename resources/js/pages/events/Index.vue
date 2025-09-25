<script setup lang="ts">
import ActionUser from '@/components/ActionUser.vue';
import DataTable from '@/components/DataTable.vue';
import SmartAvatar from '@/components/SmartAvatar.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import events from '@/routes/events';
import users from '@/routes/users';
// eslint-disable-next-line vue/no-dupe-keys
import { type BreadcrumbItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import type { ColumnDef } from '@tanstack/vue-table';

import { FolderX, UserRoundPlus } from 'lucide-vue-next';
import { computed, h } from 'vue';

const props = defineProps({
    events: {
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
        title: 'Users',
        href: users.index().url,
    },
    {
        title: 'Events',
        href: events.index().url,
    },
];

export interface Events {

    id: number;
    title: string;
    url: string;

    // created_at: string;
    // userName: string;
}

const data = computed<Events[]>(() => {
    return props.events?.map((event: any) => ({
        id: event.id,
        title: event.title,
        url: event.event_images.map((item: any) => item.url),
    }));
});
console.log(props.events);

const userColumns: ColumnDef<Events>[] = [
    {
        id: 'select',
        header: ({ table }) =>
            h(Checkbox, {
                modelValue: table.getIsAllPageRowsSelected() || (table.getIsSomePageRowsSelected() && 'indeterminate'),
                'onUpdate:modelValue': (value: any) => table.toggleAllPageRowsSelected(!!value),
                ariaLabel: 'Select all',
            }),
        cell: ({ row }) =>
            h(Checkbox, {
                modelValue: row.getIsSelected(),
                'onUpdate:modelValue': (value: any) => row.toggleSelected(!!value),
                ariaLabel: 'Select row',
            }),
        enableSorting: false,
        enableHiding: false,
    },
    {
        accessorKey: 'id',
        header: 'ID',
        cell: ({ row }) => h('div', { class: 'capitalize' }, row.getValue('id')),
    },
    {
        accessorKey: 'title',
        header: 'Title',
        cell: ({ row }) => h('div', { class: 'capitalize' }, row.getValue('title')),
    },
    {
        accessorKey: 'url',
        header: 'Img',
        cell: ({ row }) =>
            h(
                'div',
                { class: 'flex items-center gap-2' },
                h(SmartAvatar, {
                    name: row.getValue('title'),
                    src: row.original.url[0]        }),
            ),
    },

    {
        id: 'actions',
        enableHiding: false,
        cell: ({ row }) => {
            const event = row.original;
            console.log(event);

            return h(
                'div',
                { class: 'relative' },
                h(ActionUser, {
                    event: event,
                }),
            );
        },
    },
];
console.log('ddddd',props.events)
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <DataTable :data="data" :columns="userColumns">
            <template #header>
                <Link :href="events.create().url">
                    <Button variant="default" size="sm" class="gap-2">
                        <UserRoundPlus />
                        Add New Event
                    </Button>
                </Link>
            </template>
            <template #empty>
                <div class="flex items-center justify-center gap-2 p-4">
                    <FolderX class="h-16 w-16 text-gray-400" />
                    <p class="text-xl text-gray-400">No events found.</p>
                </div>
            </template>
        </DataTable>
    </AppLayout>
</template>
<!-- <script lang="ts" setup>
const props = defineProps({
    events: {
        type: Array,
        required: true,
    },
});

console.log((props.events[0] as any).event_images[0].url);
</script> -->
