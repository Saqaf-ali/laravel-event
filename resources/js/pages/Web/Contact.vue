<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import Textarea from '@/components/ui/textarea/Textarea.vue';

import AppLayout from '@/layouts/web/AppLayout.vue';
import contacts from '@/routes/contacts';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    name: '',
    email: '',
    message: '',
});

const submit = () => {
    form.post(contacts.store().url, {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Contact Us" />
    <AppLayout>
        <section class="relative bg-gradient-to-r from-primary to-accent py-20 text-white">
            <div class="container mx-auto px-4 text-center">
                <h1 class="mb-4 text-5xl font-bold text-primary-foreground">Contact Us</h1>
                <p class="text-xl text-primary-foreground/90">We'd love to hear from you!</p>
            </div>
        </section>

        <section class="py-16">
            <div class="container mx-auto px-4">
                <Card class="mx-auto max-w-2xl">
                    <CardHeader>
                        <CardTitle class="text-2xl">Send us a message</CardTitle>
                        <CardDescription> Fill out the form below and we'll get back to you as soon as possible. </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <form @submit.prevent="submit" class="flex flex-col gap-6">
                            <div class="grid gap-2">
                                <Label for="name">Your Name</Label>
                                <Input id="name" type="text" v-model="form.name" required autofocus />
                                <InputError :message="form.errors.name" />
                            </div>

                            <div class="grid gap-2">
                                <Label for="email">Your Email</Label>
                                <Input id="email" type="email" v-model="form.email" required />
                                <InputError :message="form.errors.email" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="message">Message</Label>
                                <Textarea placeholder="Type your message here." id="message" v-model="form.message" required />
                                <InputError :message="form.errors.message" />
                            </div>

                            <Button type="submit" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Send Message</Button
                            >
                        </form>
                    </CardContent>
                </Card>
            </div>
        </section>
    </AppLayout>
</template>
