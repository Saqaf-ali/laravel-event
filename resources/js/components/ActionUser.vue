<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Actions from './Actions.vue';
import DropdownMenuItem from './ui/dropdown-menu/DropdownMenuItem.vue';

defineProps(['id', 'editRoute', 'deleteRoute']);
</script>
<template>
    <Actions>
        <DropdownMenuItem>
            <Link :href="editRoute"> Edit</Link>
        </DropdownMenuItem>
        <DropdownMenuItem><Link :href="deleteRoute" as="button" method="delete"> Delete</Link> </DropdownMenuItem>
    </Actions>
</template>
