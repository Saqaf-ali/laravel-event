<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import CarouselImages from '@/components/Navigation/CarouselImages.vue';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const images = [{ image_url: '/pexels-chi-n-ba-3626645-33765242.jpg' }];
</script>

<template>
    <Head title="Welcome" />
    <AppLayout>
        <!-- hero -->
        <section class="relative">
            <CarouselImages :images="images" class=" " />

            <div class="absolute inset-0 z-10 flex flex-col items-center justify-center bg-black/50">
                <h1 class="text-white">Welcome to Event Wave</h1>
                <p class="text-x mt-4 text-muted">Your one-stop shop for the hottest events!</p>
                <div class="mt-8 flex gap-4">
                    <Button size="lg">Get Started</Button>
                    <Button variant="outline" size="lg">Lorn More</Button>
                </div>
            </div>
        </section>
        <!-- Features -->
        <section class="container mx-auto px-4 py-16 text-center">
            <h2 class="mb-12">Our Features</h2>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="flex flex-col items-center text-center">
                    <Icon name="TentTree" size="48" class="mb-4 text-primary" />
                    <h3>Diverse Events</h3>
                    <p class="text-sm text-muted-foreground">
                        We offer a wide array of events, from music concerts and art exhibitions to tech conferences and food festivals.
                    </p>
                </div>
                <div class="flex flex-col items-center text-center">
                    <Icon name="Ticket" size="48" class="mb-4 text-primary" />
                    <h3>Tickets</h3>
                    <p class="text-sm text-muted-foreground">
                        Effortlessly purchase and manage your tickets within the app. Secure your spot at your favorite events with just a few taps.
                    </p>
                </div>
                <div class="flex flex-col items-center text-center">
                    <Icon name="Users" size="48" class="mb-4 text-primary" />
                    <h3>Community</h3>
                    <p class="text-sm text-muted-foreground">
                        Connect with other event-goers, share your experiences, and discover new events through a vibrant community.
                    </p>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="bg-primary-foreground py-16 text-center">
            <div class="container mx-auto px-4">
                <h2 class="mb-4">Ready to experience the next wave of events?</h2>
                <p class="mb-8 text-muted-foreground">Join Event Wave today and never miss out on the excitement!</p>
                <Link href="/register">
                    <Button>Sign Up Now</Button>
                </Link>
            </div>
        </section>
    </AppLayout>
</template>
