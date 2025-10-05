<script setup lang="ts">
import AppLogo from '@/components/AppLogo.vue';
import TextLink from '@/components/TextLink.vue';
import { dashboard } from '@/routes';
import type { NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Facebook, Instagram, Twitter } from 'lucide-vue-next';
import Icon from '../Icon.vue';

const mainNav: NavItem[] = [
    { title: 'Home', href: '/' },
    { title: 'About', href: '/about' },
    { title: 'Contact', href: '/contact' },
    { title: 'Events', href: '/events' },
];

const socialNav: NavItem[] = [
    { title: 'Facebook', href: '#', icon: Facebook },
    { title: 'Instagram', href: '#', icon: Instagram },
    { title: 'Twitter', href: '#', icon: Twitter },
];
</script>

<template>
    <footer class="border-t bg-background py-8">
        <div class="container mx-auto grid grid-cols-1 gap-8 px-4 md:grid-cols-3">
            <div class="flex flex-col items-start gap-4">
                <Link :href="dashboard()" class="flex items-center gap-x-2">
                    <AppLogo />
                </Link>
                <p class="text-sm text-muted-foreground">© 2024 Event Wave. All rights reserved.</p>
            </div>

            <div class="flex flex-col gap-2">
                <h3 class="text-lg font-semibold">Quick Links</h3>
                <TextLink v-for="(item, index) in mainNav" :key="index" :href="item.href">
                    {{ item.title }}
                </TextLink>
            </div>

            <div class="flex flex-col gap-2">
                <h3 class="text-lg font-semibold">Follow Us</h3>
                <div class="flex gap-4">
                    <a
                        v-for="(item, index) in socialNav"
                        :key="index"
                        :href="item.href"
                        class="text-muted-foreground transition-colors hover:text-primary"
                    >
                        <Icon :name="item.title" size="24" />
                        <span class="sr-only">{{ item.title }}</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</template>
