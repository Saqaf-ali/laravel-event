<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import Paragraph from '@/components/Paragraph.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Checkout" />
    <AppLayout>
        <section class="py-16">
            <div class="container mx-auto p-4">
                <div class="flex flex-col items-center justify-center space-y-6 text-center">
                    <Heading title="Checkout" description="Complete your ticket purchase" />
                    <Paragraph text="Your cart is currently empty. Please add tickets to proceed with checkout." />
                    <Button as-child>
                        <a href="/web/events">Browse Events</a>
                    </Button>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
