<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { AlertCircle, Rocket } from 'lucide-vue-next';
import { computed, watch } from 'vue';
import AlertTitle from './ui/alert/AlertTitle.vue';
import AlertDescription from './ui/alert/AlertDescription.vue';
import Alert from './ui/alert/Alert.vue';

const page = usePage();

const flash = computed(() => page.props.flash);
let timer: number | null | undefined = null;
watch(
    () => (flash.value as { success: string | null }).success,
    (newValue) => {
        if (newValue) {
            if (timer) {
                clearTimeout(timer);
            }
            timer = setTimeout(() => {
                (page.props.flash as { success: string | null }).success = null;
            }, 3000);
        }
    },
);
watch(
    () => (flash.value as { error: string | null }).error,
    (newValue) => {
        if (newValue) {
            if (timer) {
                clearTimeout(timer);
            }
            timer = setTimeout(() => {
                (page.props.flash as { error: string | null }).error = null;
            }, 3000);
        }
    },
);
</script>

<template>
    <Alert v-if="(flash as { success: string | null })?.success" class="mb-4 bg-blue-600 text-white">
        <Rocket class="h-4 w-4" />
        <AlertTitle>Success!</AlertTitle>

        <AlertDescription> {{ flash.success }} </AlertDescription>
    </Alert>
    <Alert variant="destructive" v-if="(flash as { error: string | null })?.error" class="mb-4">
        <AlertCircle class="h-4 w-4" />
        <AlertTitle>Error</AlertTitle>
        <AlertDescription> Your session has expired. Please log in again. </AlertDescription>
    </Alert>
</template>
