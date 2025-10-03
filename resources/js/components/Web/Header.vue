<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Sheet, SheetContent, SheetTrigger } from '@/components/ui/sheet';
import type { NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Bell, ClockArrowDown, Home, Menu, Search, ShoppingCart, TentTree, User } from 'lucide-vue-next';
import { ref } from 'vue';
import AppLogo from '../AppLogo.vue';
import TextLink from '../TextLink.vue';
import WebNav from './WebNav.vue';
import ButtonTip from '../ButtonTip.vue';

const isOpen = ref(false);

const mainNav: NavItem[] = [
    // For desktop text links
    { title: 'Home', href: '/', icon: Home },
    { title: 'About', href: '/about', icon: User },
    { title: 'Contact', href: '/contact', icon: Bell },
    { title: 'Events', href: '/events', icon: TentTree },
];

const mobileNav: NavItem[] = [
    // For mobile-only icon links
    { title: 'Orders', href: '/orders', icon: ClockArrowDown },
    { title: 'Cart', href: '/cart', icon: ShoppingCart },
    { title: 'Notifications', href: '/notifications', icon: Bell },
    { title: 'Profile', href: '/profile', icon: User },
];

const buttonTap = [
    { tip: 'Search', icon: Search, href: '/search' },
    // { tip: 'Orders', icon: ClockArrowDown, href: '/orders' },
    { tip: 'Cart', icon: ShoppingCart, href: '/cart' },
    { tip: 'Notifications', icon: Bell, href: '/notifications' },
    { tip: 'Profile', icon: User, href: '/profile' },
];
const allNav = [...mainNav, ...mobileNav];
</script>

<template>
    <header class="sticky top-0 z-40 w-full border-b bg-background">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center gap-4">
                <Sheet v-model:open="isOpen">
                    <SheetTrigger as-child>
                        <Button size="icon" variant="outline" class="lg:hidden">
                            <Menu class="h-5 w-5" />
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="left">
                        <div class="flex flex-col gap-4">

                                <AppLogo />

                            <WebNav :items="allNav" />
                        </div>
                    </SheetContent>
                </Sheet>

                <Link :href="'/'" class="hidden lg:flex lg:items-center">
                    <AppLogo class="block h-9 w-auto fill-current text-gray-800" />
                </Link>
            </div>

            <nav class="hidden items-center gap-6 lg:flex">
                <TextLink v-for="(item, index) in mainNav" :key="index" :href="item.href">
                    {{ item.title }}
                </TextLink>
            </nav>

            <div class="flex items-center gap-4">
                <ButtonTip v-for="(item, index) in buttonTap" :key="index" :tip="item.tip">
                    <template #icon>
                        <component :is="item.icon" class="h-5 w-5" />
                    </template>
                </ButtonTip>
            </div>
        </div>
    </header>
</template>
