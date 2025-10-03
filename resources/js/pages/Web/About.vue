<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import SectionRight from '@/components/Web/SectionRight.vue';
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
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

        <section class="container mx-auto px-4 py-16">
            <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
                <div>
                    <Heading
                        title="Our Mission"
                        description="Our mission at Event Wave is to
                        revolutionize the way people discover, experience,
                         and participate in events. We strive to create a seamless and intuitive platform that
                         connects individuals with a diverse range of events, fostering vibrant communities and
                          unforgettable memories."
                    />
                    <p class="text-sm text-muted-foreground">
                        Whether you're looking for a local concert, a professional conference, a vibrant festival, or a niche workshop, Event Wave is
                        designed to help you find exactly what you're looking for and more.
                    </p>
                </div>
                <div>
                    <img
                        src="https://images.pexels.com/photos/33924795/pexels-photo-33924795.jpeg"
                        alt="Our Mission"
                        class="h-auto w-full rounded-lg shadow-lg"
                    />
                </div>
            </div>
        </section>
        <SectionRight
            title="Our Vision"
            description="Our vision is to become the leading global platform for event discovery and management,
                        empowering individuals and organizations to create, share, and experience
                        unforgettable moments. We envision a world where every event, big or small,
                        is easily accessible and seamlessly organized, fostering connection and joy across communities."
            descriptionSecondary="We believe in the power of shared experiences to bring people together, inspire creativity, and drive positive change. Event Wave is committed to continuously innovating and expanding our offerings to meet the evolving needs of our users, making event participation a delightful and enriching part of life."
            image="https://images.pexels.com/photos/33661252/pexels-photo-33661252.jpeg"
        />

        <section class="container mx-auto px-4 py-16">
            <div class="text-center">
                <h2 class="mb-6 text-3xl font-semibold">Meet the Team</h2>
                <p class="mb-12 text-lg leading-relaxed text-gray-700">
                    Behind Event Wave is a passionate team dedicated to making your event experience exceptional.
                </p>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div class="flex flex-col items-center">
                        <img src="/images/team-member-1.jpg" alt="Team Member 1" class="mb-4 h-32 w-32 rounded-full object-cover shadow-lg" />
                        <h3 class="text-xl font-semibold">Jane Doe</h3>
                        <p class="text-primary">CEO & Founder</p>
                        <p class="mt-2 text-center text-gray-600">Jane is a visionary leader with a passion for connecting people through events.</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="/images/team-member-2.jpg" alt="Team Member 2" class="mb-4 h-32 w-32 rounded-full object-cover shadow-lg" />
                        <h3 class="text-xl font-semibold">John Smith</h3>
                        <p class="text-primary">Chief Technology Officer</p>
                        <p class="mt-2 text-center text-gray-600">
                            John leads our tech team, ensuring Event Wave is always at the forefront of innovation.
                        </p>
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="/images/team-member-3.jpg" alt="Team Member 3" class="mb-4 h-32 w-32 rounded-full object-cover shadow-lg" />
                        <h3 class="text-xl font-semibold">Emily White</h3>
                        <p class="text-primary">Head of Marketing</p>
                        <p class="mt-2 text-center text-gray-600">
                            Emily is dedicated to spreading the word about Event Wave and engaging our community.
                        </p>
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
