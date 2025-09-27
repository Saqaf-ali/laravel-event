<script setup lang="ts">
import { toTypedSchema } from '@vee-validate/zod';
import { useForm } from 'vee-validate';
import { computed, ref } from 'vue';

import { Button } from '@/components/ui/button';
import { FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage } from '@/components/ui/form';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import events from '@/routes/events';

import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import { EventSchema } from '@/Schemas/EventSchema';
import { BreadcrumbItem } from '@/types';
import { Head, Link, useForm as useInertiaForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Events',
        href: events.index().url,
    },
    {
        title: 'Edit',
        href: '#', // Will be set dynamically
    },
];

const props = defineProps({
    event: {
        type: Object,
        required: true,
    },
});

// Dynamically set the href for the edit breadcrumb
breadcrumbs[2].href = events.edit(props.event.id).url;

const inertiaForm = useInertiaForm({
    title: props.event.title,
    description: props.event.description,
    location: props.event.location,
    end_date: props.event.end_date,
    start_date: props.event.start_date,
    image: undefined,
    _method: 'put',
});

const eventSchemas = toTypedSchema(EventSchema);

const { isFieldDirty, handleSubmit, setErrors } = useForm({
    initialValues: {
        ...inertiaForm.data(),
        image: undefined, // vee-validate handles file inputs better with undefined
    },
    validationSchema: eventSchemas,
});

const imagePreview = ref<string | null>(null);

const currentImageUrl = computed(() => {
    return props.event.event_images && props.event.event_images.length > 0 ? props.event.event_images[0].url : null;
});

const onSubmit = handleSubmit((values) => {
    // Assign validated values to the inertia form
    Object.assign(inertiaForm, values);

    inertiaForm.post(events.update(props.event.id).url, {
        onError: (errors) => {
            setErrors(errors);
        },
    });
});
</script>

<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto max-w-2xl p-4">
            <Card class="bg-primary-subtle border-none">
                <CardHeader>
                    <CardTitle class="text-primary">Edit Event</CardTitle>
                    <CardDescription>Edit the details of an existing event.</CardDescription>
                </CardHeader>
                <CardContent>
                    <form class="space-y-8" @submit="onSubmit">
                        <!-- start -->
                        <FormField v-slot="{ componentField }" name="title">
                            <FormItem>
                                <FormLabel>Title</FormLabel>
                                <FormControl>
                                    <Input type="text" placeholder="title" v-bind="componentField" />
                                </FormControl>
                                <FormDescription>Must be min 3 characters. </FormDescription>
                                <FormMessage />
                            </FormItem>
                        </FormField>

                        <!--    end -->
                        <FormField v-slot="{ componentField }" name="description">
                            <FormItem>
                                <FormLabel for="description">Description</FormLabel>
                                <FormControl>
                                    <Input type="text" id="description" placeholder="description" v-bind="componentField" />
                                </FormControl>
                                <FormDescription>This is optional.</FormDescription>
                                <FormMessage />
                            </FormItem>
                        </FormField>
                        <!-- start -->

                        <FormField v-slot="{ componentField }" name="location">
                            <FormItem>
                                <FormLabel for="location">Location</FormLabel>
                                <FormControl>
                                    <Input type="text" id="location" placeholder="location" v-bind="componentField" />
                                </FormControl>
                                <FormDescription>This is optional.</FormDescription>
                                <FormMessage />
                            </FormItem>
                        </FormField>
                        <!-- end -->

                        <!-- start -->
                        <FormField v-slot="{ componentField }" name="start_date">
                            <FormItem>
                                <FormLabel for="start_date">Start Date </FormLabel>
                                <FormControl>
                                    <Input type="date" id="start_date" v-bind="componentField" />
                                </FormControl>
                                <FormMessage />
                            </FormItem>
                        </FormField>

                        <!-- start -->
                        <FormField v-slot="{ componentField }" name="end_date">
                            <FormItem>
                                <FormLabel for="end_date">end_date </FormLabel>
                                <FormControl>
                                    <Input type="date" id="end_date" v-bind="componentField" />
                                </FormControl>
                                <FormMessage />
                            </FormItem>
                        </FormField>

                        <FormField v-slot="{ componentField }" name="image">
                            <FormItem>
                                <FormLabel for="image">Image</FormLabel>
                                <FormControl>
                                    <Input
                                        id="image"
                                        type="file"
                                        @change="
                                            (e) => {
                                                const target = e.target as HTMLInputElement;
                                                const file = target.files?.[0];
                                                componentField.onChange(e);
                                                inertiaForm.image = file;
                                                if (file) {
                                                    imagePreview = URL.createObjectURL(file);
                                                } else {
                                                    imagePreview = null;
                                                }
                                            }
                                        "
                                    />
                                </FormControl>
                                <FormMessage />
                            </FormItem>
                        </FormField>
                        <!-- end -->
                        <div class="flex gap-2">
                            <Button type="submit" :disabled="inertiaForm.processing">Submit</Button>
                            <Link :href="events.index().url" as="button">
                                <Button type="button" variant="outline"> Back </Button>
                            </Link>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
