<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Sheet, SheetContent, SheetTrigger } from '@/components/ui/sheet';
import { useCart } from '@/composables/useCart';
import { dashboard, login } from '@/routes';
import { shopping } from '@/routes/web';
import { index } from '@/routes/web/orders';
import type { NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { Menu } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import AppLogo from '../AppLogo.vue';
import Icon from '../Icon.vue';
import SmartAvatar from '../SmartAvatar.vue';
import TextLink from '../TextLink.vue';
import ThemeToggleButton from './ThemeToggleButton.vue';
import WebNav from './WebNav.vue';

const page = usePage();
const isOpen = ref(false);
const { totalItems } = useCart();
console.log('total itemssssssssss:', totalItems.value);

const user = computed(() => page.props.auth.user);
const hasOrders = computed(() => page.props.hasOrders === true);

const mainNavItems = computed<NavItem[]>(() => [
    { title: 'Home', href: '/' },
    { title: 'Events', href: '/web/events' },
    { title: 'About', href: '/about' },
    { title: 'Contact', href: '/contact' },
]);

const cartNavItem = computed<NavItem | null>(() =>
    totalItems.value > 0
        ? {
              title: 'Cart',
              href: shopping(),
              icon: 'ShoppingCart',
              badge: totalItems.value,
          }
        : null,
);
const orderNavItem = computed<NavItem | null>(() =>
    hasOrders.value
        ? {
              title: 'Orders',
              href: index(),
              icon: 'ClockArrowDown',
          }
        : null,
);

const iconNavItems = computed<NavItem[]>(
    () => [{ title: 'Search', href: '/search', icon: 'Search' }, cartNavItem.value, orderNavItem.value].filter(Boolean) as NavItem[],
);

const authNavItem = computed<NavItem>(() => ({
    title: user.value ? user.value.name : 'Login',
    href: user.value ? dashboard() : login(),
    icon: 'User',
    auth: true,
}));

const mobileNavItems = computed<NavItem[]>(
    () =>
        [
            ...mainNavItems.value,
            ...iconNavItems.value,
            ...(hasOrders.value ? [{ title: 'Orders', href: index, icon: 'ClockArrowDown' }] : []),
            authNavItem.value,
        ].filter(Boolean) as NavItem[],
);
</script>

<template>
    <header class="no-print sticky top-0 z-40 mx-auto flex h-16 w-full items-center justify-between border-b bg-background px-4">
        <!-- 1. Left Side -->
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
                        <WebNav :items="mobileNavItems" />
                    </div>
                </SheetContent>
            </Sheet>

            <Link class="flex items-center">
                <AppLogo />
            </Link>
        </div>

        <!-- 2. Center (Desktop Navigation) -->
        <nav class="hidden flex-shrink-0 items-center gap-6 lg:flex">
            <TextLink v-for="item in mainNavItems" :key="item.title" :href="item.href">
                {{ item.title }}
            </TextLink>
        </nav>

        <!-- 3. Right Side -->

        <div class="flex items-center justify-end gap-2">
            <ThemeToggleButton />
            <Button v-for="item in iconNavItems" :key="item.title" as-child variant="ghost" size="icon">
                <Link :href="item.href">
                    <span class="sr-only">{{ item.title }}</span>
                    <div v-if="item.badge && item.badge > 0" class="relative">
                        <Icon :name="item.icon!" size="20" />
                        <div class="absolute -top-2 -right-2 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-xs text-white">
                            {{ item.badge }}
                        </div>
                    </div>
                    <Icon v-else :name="item.icon!" size="20" />
                </Link>
            </Button>

            <Button as-child variant="ghost" size="icon">
                <Link :href="authNavItem.href">
                    <span class="sr-only">{{ authNavItem.title }}</span>
                    <SmartAvatar v-if="user" :src="user.image_url" :name="user.name" :alt="user.name" class="size-8" />
                    <Icon v-else :name="authNavItem.icon!" size="20" />
                </Link>
            </Button>
        </div>
    </header>
</template>
