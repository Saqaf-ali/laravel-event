<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import Button from '@/components/ui/button/Button.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import event from '@/routes/event';

import events from '@/routes/events';
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const props = defineProps<{
    event: {
        id: number;
    };
}>();
const form = useForm({
    image: null as File | null,
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

const submit = () => {
    form.post(event.eventImages.store(props.event.id).url, {
        forceFormData: true,
    });
};
</script>

<template>
    <Head title="Create Event Image" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <AppContent>
            <div class="mx-auto max-w-2xl p-4">
                <Heading title="Add Event Image" description="Upload a new image for an event." />
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-2">
                        <Label for="image">Image</Label>
                        <Input
                            class="hover:border-primary focus:border-primary"
                            id="image"
                            type="file"
                            @input="form.image = ($event.target as HTMLInputElement).files?.[0]"
                            :tabindex="4"
                            name="image"
                            placeholder="Your image "
                        />
                        <InputError :message="form.errors.image" />
                    </div>
                    <Button
                        @click="submit"
                        type="submit"
                        class="mt-2 w-full"
                        :tabindex="5"
                        :disabled="form.processing"
                        data-test="update-image-button"
                    >
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        Update Image
                    </Button>
                </form>
            </div>
        </AppContent>
    </AppLayout>
</template>
