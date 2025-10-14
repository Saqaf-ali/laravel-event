<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { DropdownMenu, DropdownMenuCheckboxItem, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Input } from '@/components/ui/input';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import type { ColumnDef, ColumnFiltersState, SortingState, VisibilityState } from '@tanstack/vue-table';
import { FlexRender, getCoreRowModel, getFilteredRowModel, getPaginationRowModel, getSortedRowModel, useVueTable } from '@tanstack/vue-table';
import { ChevronDown } from 'lucide-vue-next';
import { ref } from 'vue';
import NoData from './message/NoData.vue';
import { valueUpdater } from './ui/table/utils';

// تعريف الواجهة (لحل مشكلة التجميع وتوفير النوع)
interface DataTableProps {
    data: any[];
    columns: ColumnDef<any>[];
    columnFilter?: number | string;
    pagination?: any;
}

// الخصائص التي يستقبلها المكون
const props = withDefaults(defineProps<DataTableProps>(), {
    columnFilter: 'name',
});

// حالة الجدول
const sorting = ref<SortingState>([]);
const columnFilters = ref<ColumnFiltersState>([]);
const columnVisibility = ref<VisibilityState>({});
const rowSelection = ref({});

// الحالة الجديدة: تعريف الفلتر الشامل (Global Filter)
const globalFilter = ref('');

// إعداد محرك TanStack Table
const table = useVueTable({
    get data() {
        return props.data;
    },
    columns: props.columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFilteredRowModel: getFilteredRowModel(),

    // ربط الفلتر الشامل بإعدادات الجدول
    onSortingChange: (updaterOrValue) => valueUpdater(updaterOrValue, sorting),
    onColumnFiltersChange: (updaterOrValue) => valueUpdater(updaterOrValue, columnFilters),
    onColumnVisibilityChange: (updaterOrValue) => valueUpdater(updaterOrValue, columnVisibility),
    onRowSelectionChange: (updaterOrValue) => valueUpdater(updaterOrValue, rowSelection),
    onGlobalFilterChange: (updaterOrValue) => valueUpdater(updaterOrValue, globalFilter), // 👈 الربط بالفلتر الشامل

    initialState: {
        pagination: {
            pageSize: props.pagination?.per_page || 6,
        },
    },

    state: {
        get sorting() {
            return sorting.value;
        },
        get columnFilters() {
            return columnFilters.value;
        },
        get columnVisibility() {
            return columnVisibility.value;
        },
        get rowSelection() {
            return rowSelection.value;
        },
        // إضافة حالة الفلتر الشامل إلى حالة الجدول
        get globalFilter() {
            return globalFilter.value;
        },
    },
});
</script>

<template>
    <div class="w-full" v-if="props.data.length">
        <div class="flex items-center py-4">
            <Input
                class="max-w-sm"
                placeholder="Search here..."
                :model-value="globalFilter"
                @update:model-value="globalFilter = $event"
                aria-label="search"
            />
            <div class="ml-auto flex items-center space-x-2">
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button variant="outline" class="">
                            Columns
                            <ChevronDown class="ml-2 h-4 w-4 text-primary" />
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuCheckboxItem
                            v-for="column in table.getAllColumns().filter((column) => column.getCanHide())"
                            :key="column.id"
                            class="capitalize"
                            :model-value="column.getIsVisible()"
                            @update:model-value="(value) => column.toggleVisibility(!!value)"
                        >
                            {{ column.id === 'name' ? 'Name' : column.id === 'email' ? 'Email' : column.id }}
                        </DropdownMenuCheckboxItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </div>
        </div>

        <div class="rounded-md border">
            <Table>
                <TableHeader>
                    <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                        <TableHead v-for="header in headerGroup.headers" :key="header.id">
                            <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header" :props="header.getContext()" />
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <template v-if="table.getRowModel().rows?.length">
                        <TableRow v-for="row in table.getRowModel().rows" :key="row.id" :data-state="row.getIsSelected() && 'selected'">
                            <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
                                <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                            </TableCell>
                        </TableRow>
                    </template>
                    <TableRow v-else>
                        <TableCell :colspan="columns.length" class="h-24 text-center"> No data found. </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>

        <div class="flex items-center justify-end space-x-2 py-4">
            <div class="flex-1 text-sm text-muted-foreground">
                {{ table.getFilteredSelectedRowModel().rows.length }} of {{ table.getFilteredRowModel().rows.length }} row(s) selected.
            </div>
            <div class="space-x-2" v-if="pagination?.links?.length && data.length > pagination.per_page">
                <Button
                    v-for="link in pagination.links"
                    :key="link.url"
                    :disabled="link.url === null"
                    @click="$inertia.visit(link.url)"
                    :variant="link.active ? 'default' : 'outline'"
                    size="sm"
                >
                    <span v-if="link.label.includes('Previous')">Previous</span>
                    <span v-else-if="link.label.includes('Next')">Next</span>
                    <span v-else>{{ link.label }}</span>
                </Button>
            </div>
            <div class="space-x-2" v-else>
                <Button variant="outline" size="sm" :disabled="!table.getCanPreviousPage()" @click="table.previousPage()"> Previous </Button>
                <Button variant="outline" size="sm" :disabled="!table.getCanNextPage()" @click="table.nextPage()"> Next </Button>
            </div>
        </div>
    </div>
    <div class="w-full" v-else>
        <NoData />
    </div>
</template>
