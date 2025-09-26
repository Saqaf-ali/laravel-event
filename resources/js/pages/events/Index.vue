<script setup lang="ts">
import ActionUser from '@/components/ActionUser.vue';
import DataTable from '@/components/DataTable.vue';
import SmartAvatar from '@/components/SmartAvatar.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import events from '@/routes/events';
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
                    src: row.original.url[0],
                }),
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
                    id: row.original.id,
                    editRoute: events.edit(row.original.id).url,
                    deleteRoute: events.destroy(row.original.id).url,
                }),
            );
        },
    },
];
console.log('ddddd', props.events);
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="w-full">
            <div class="flex items-center py-4">
                <div class="ml-auto flex items-center space-x-2">
                    <Link title="Trash organizers">
                        <Button variant="outline" class="h-8 w-8 p-0">
                            <FolderX class="h-4 w-4 text-primary" />
                        </Button>
                    </Link>

                    <Link title="Add New organizer" :href="events.create().url">
                        <Button variant="outline" class="h-8 w-8 p-0">
                            <UserRoundPlus class="h-4 w-4 text-primary" />
                        </Button>
                    </Link>
                </div>
            </div>
            <DataTable :data="data" :columns="userColumns" @deleteSusses="deleteSusses" />
        </div>
    </AppLayout>
</template>
