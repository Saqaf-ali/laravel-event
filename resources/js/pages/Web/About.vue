<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import Paragraph from '@/components/Paragraph.vue';
import SmartAvatar from '@/components/SmartAvatar.vue';
import { Button } from '@/components/ui/button';
import SectionLeft from '@/components/Web/SectionLeft.vue';
import SectionRight from '@/components/Web/SectionRight.vue';
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
const users = [
    {
        name: 'Jane Doe',
        title: 'CEO & Founder',
        description: 'Jane is a visionary leader with a passion for connecting people through events.',
        image: 'https://images.pexels.com/photos/371160/pexels-photo-371160.jpeg',
    },
    {
        name: 'John Smith',
        title: 'Chief Technology Officer',
        description: 'John leads our tech team, ensuring Event Wave is always at the forefront of innovation.',
        image: 'https://images.pexels.com/photos/343717/pexels-photo-343717.jpeg',
    },
    {
        name: 'Emily White',
        title: 'Head of Marketing',
        description: 'Emily is dedicated to spreading the word about Event Wave and engaging our community.',
        image: 'https://images.pexels.com/photos/1370750/pexels-photo-1370750.jpeg',
    },
];
</script>

<template>
    <Head title="About Us" />
    <AppLayout>
        <section class="relative bg-gradient-to-r from-purple-600 to-blue-600 py-20 text-white">
            <div class="container mx-auto px-4 text-center">
                <h1 class="mb-4 text-5xl font-bold">About Event Wave</h1>
                <p class="text-xl">Your ultimate platform for discovering and managing events.</p>
            </div>
        </section>

        <SectionLeft
            class="bg-secondary"
            title="Our Mission"
            description="At Event Wave, our mission is to revolutionize the event industry by providing a seamless,
                        user-friendly platform that connects event organizers with enthusiastic attendees.
                        We strive to simplify every aspect of event management, from planning and promotion to ticketing and post-event analysis,
                        while offering users an unparalleled experience in discovering and engaging with events tailored to their interests."
            descriptionSecondary="We are committed to fostering a vibrant community where memorable experiences are created and shared,
                        making event participation accessible, enjoyable, and effortless for everyone.
                        Our dedication to innovation, user satisfaction, and community building drives us to continuously enhance our platform and services."
            image="https://images.pexels.com/photos/33924795/pexels-photo-33924795.jpeg"
        />

        <SectionRight
            title="Our Vision"
            description="Our vision is to become the leading global platform for event discovery and management,
                        empowering individuals and organizations to create, share, and experience
                        unforgettable moments. We envision a world where every event, big or small,
                        is easily accessible and seamlessly organized, fostering connection and joy across communities."
            descriptionSecondary="We believe in the power of shared experiences to bring people together, inspire creativity, and drive positive change. Event Wave is committed to continuously innovating and expanding our offerings to meet the evolving needs of our users, making event participation a delightful and enriching part of life."
            image="https://images.pexels.com/photos/33661252/pexels-photo-33661252.jpeg"
        />

        <section class="w-full bg-accent/10 py-16">
            <div class="container mx-auto px-4 text-center">
                <Heading title="Meet Our Team" description="Behind Event Wave is a passionate team" />

                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div v-for="user in users" :key="user.name" class="flex flex-col items-center">
                        <SmartAvatar :src="user.image" :alt="user.name" class="mb-4 h-32 w-32" />
                        <HeadingSmall :title="user.name" :description="user.title" class="text-accent" />
                        <Paragraph :text="user.description" />
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-gradient-to-r from-blue-600 to-purple-600 py-16 text-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="mb-6 text-3xl font-semibold">Join the Event Wave Community</h2>
                <p class="mb-8 text-lg leading-relaxed">
                    Ready to discover amazing events or plan your own? Join Event Wave today and be part of a growing community passionate about
                    experiences.
                </p>
                <Link>
                    <Button size="lg" class="bg-white text-blue-600 hover:bg-gray-100">Get Started Now</Button>
                </Link>
            </div>
        </section>
    </AppLayout>
</template>
