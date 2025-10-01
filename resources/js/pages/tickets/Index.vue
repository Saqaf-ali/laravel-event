<script setup lang="ts">
import ActionUser from '@/components/ActionUser.vue';
import DataTable from '@/components/DataTable.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import tickets from '@/routes/tickets';
// eslint-disable-next-line vue/no-dupe-keys
import { type BreadcrumbItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import type { ColumnDef } from '@tanstack/vue-table';

import { BadgePlus, FolderX } from 'lucide-vue-next';
import { computed, h } from 'vue';

interface TicketImage {
    url: string;
    id: number;
    updated_at: string;
    image_url: string;
}

const props = defineProps({
    tickets: {
        type: Array,
        required: true,
    },
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        type: 'Dashboard',
        href: dashboard().url,
    },
    {
        type: 'Tickets',
        href: tickets.index().url,
    },
];

export interface Tickets {
    id: number;
    ticketType: string;
    price: number;
    quantity: number;

    ticket_images: TicketImage[];
}

const data = computed<Tickets[]>(() => {
    return props.tickets?.map((ticket: any) => ({
        id: ticket.id,
        ticketType: ticket.type,
        price: ticket.price,
        quantity: ticket.quantity,
    }));
});
console.log(props.tickets);

const userColumns: ColumnDef<Tickets>[] = [
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
        accessorKey: 'ticketType',
        header: 'Type',
        cell: ({ row }) => h('div', { class: 'capitalize' }, row.getValue('ticketType')),
    },
    {
        accessorKey: 'price',
        header: 'Price',
        cell: ({ row }) => h('div', { class: 'capitalize' }, row.getValue('price')),
    },
    {
        accessorKey: 'quantity',
        header: 'Quantity',
        cell: ({ row }) => h('div', { class: 'capitalize' }, row.getValue('quantity')),
    },

    {
        id: 'actions',
        enableHiding: false,
        cell: ({ row }) => {
            const ticket = row.original;
            console.log(ticket);

            return h(
                'div',
                { class: 'relative' },
                h(ActionUser, {
                    id: row.original.id,
                    editRoute: tickets.edit(row.original.id).url,
                    deleteRoute: tickets.destroy(row.original.id).url,
                    viewRoute: tickets.show(row.original.id).url,
                }),
            );
        },
    },
];

const deleteSusses = (id: number) => {
    props.tickets.value = props.tickets.value.filter((ticket: { id: number }) => ticket.id !== id);
};
console.log("props.tickets",props.tickets);

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="w-full">
            <div class="flex items-center py-4">
                <div class="ml-auto flex items-center space-x-2">
                    <Link type="Trash tickets">
                        <Button variant="outline" class="h-8 w-8 p-0">
                            <FolderX class="h-4 w-4 text-primary" />
                        </Button>
                    </Link>

                    <Link type="Add New ticket" :href="tickets.create().url">
                        <Button variant="outline" class="h-8 w-8 p-0">
                            <BadgePlus class="h-4 w-4 text-primary" />
                        </Button>
                    </Link>
                </div>
            </div>
            <DataTable :data="data" :columns="userColumns" @deleteSusses="deleteSusses" columnFilter="type" />
        </div>
    </AppLayout>
</template>
