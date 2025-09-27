<script setup lang="ts">
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from '@/components/ui/alert-dialog';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Actions from './Actions.vue';
import DropdownMenuItem from './ui/dropdown-menu/DropdownMenuItem.vue';
const props = defineProps(['id', 'editRoute', 'deleteRoute']);
const emit = defineEmits(['deleteSusses']);
const isAlertOpen = ref(false);

const openAlert = () => {
    isAlertOpen.value = true;
};

const closeAlert = () => {
    isAlertOpen.value = false;
};

const form = useForm({});
const deleteItem = () => {
    form.delete(props.deleteRoute, {
        onSuccess: () => {
            emit('deleteSusses', props.id);
        },
    });

    closeAlert();
};
</script>

<template>
    <Actions>
        <DropdownMenuItem>
            <Link as="button" :href="editRoute"> Edit </Link>
        </DropdownMenuItem>

        <DropdownMenuItem variant="destructive" @select="openAlert"> Delete </DropdownMenuItem>
    </Actions>

    <AlertDialog :open="isAlertOpen" @update:open="isAlertOpen = $event">
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                <AlertDialogDescription> This action cannot be undone. </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel @click="closeAlert">Cancel</AlertDialogCancel>
                <AlertDialogAction @click="deleteItem">Delete</AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
