<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Sheet, SheetContent, SheetTrigger } from '@/components/ui/sheet';
import { useCart } from '@/composables/useCart';
import type { NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { Bell, ClockArrowDown, Home, Menu, TentTree, User } from 'lucide-vue-next'; // Assuming TentTree is for Events
import { computed, ref } from 'vue';
import AppLogo from '../AppLogo.vue';
import ButtonTip from '../ButtonTip.vue';
import Icon from '../Icon.vue';
import SmartAvatar from '../SmartAvatar.vue';
import TextLink from '../TextLink.vue';

const page = usePage();

import WebNav from './WebNav.vue';

const isOpen = ref(false);
const { totalItems } = useCart();

const mainNav: NavItem[] = [
    // For desktop text links
    { title: 'Home', href: '/', icon: Home },
    { title: 'About', href: '/about', icon: User },
    { title: 'Contact', href: '/contact', icon: Bell },
    { title: 'Events', href: '/web/events', icon: TentTree },
];

const rightNavItems = computed<NavItem[]>(() => [
    { title: 'Search', href: '/search', icon: 'Search' },
    ...(totalItems.value > 0 ? [{ title: 'Cart', href: '/web/shopping', icon: 'ShoppingCart', badge: totalItems.value }] : []),
    { title: 'Notifications', href: '/web/notifications', icon: 'Bell' },
    {
        title: page.props.auth.user ? page.props.auth.user.name : 'Login',
        href: page.props.auth.user ? '/profile' : '/login',
        icon: 'User',
        auth: true,
    },
]);

const mobileOnlyNav: NavItem[] = [{ title: 'Orders', href: '/web/orders', icon: ClockArrowDown }];

const allNav = computed(() => [...mainNav, ...mobileOnlyNav, ...rightNavItems.value.filter((item) => item.title !== 'Search' && item !== null)]);
</script>

<template>
    <header class="no-print sticky top-0 z-40 w-full border-b bg-background">
        <div class="mx-4 flex h-16 items-center">
            <div class="flex flex-1 items-center justify-start gap-4">
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
                    <AppLogo />
                </Link>
            </div>

            <nav class="hidden items-center gap-6 lg:flex">
                <TextLink v-for="(item, index) in mainNav" :key="index" :href="item.href">
                    {{ item.title }}
                </TextLink>
            </nav>

            <div class="flex flex-1 items-center justify-end gap-4">
                <template v-for="(item, index) in rightNavItems" :key="index">
                    <ButtonTip v-if="item.auth && page.props.auth.user" :tip="item.title" :href="item.href">
                        <template #icon>
                            <SmartAvatar
                                :src="page.props.auth.user.image_url"
                                :name="page.props.auth.user.name"
                                :alt="page.props.auth.user.name"
                                class="h-8 w-8"
                            />
                        </template>
                    </ButtonTip>
                    <ButtonTip v-else :tip="item.title" :href="item.href">
                        <template #icon>
                            <div v-if="item.title === 'Cart' && totalItems > 0" class="relative">
                                <Icon :name="item.icon!" size="20" />
                                <div
                                    class="absolute -top-2 -right-2 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-xs text-white"
                                >
                                    {{ totalItems }}
                                </div>
                            </div>
                            <Icon v-else :name="item.icon!" size="20" />
                        </template>
                    </ButtonTip>
                </template>
            </div>
        </div>
    </header>
</template>
