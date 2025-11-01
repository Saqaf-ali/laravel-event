<script setup lang="ts">
import { useCart } from '@/composables/useCart';
import { dashboard, login } from '@/routes';
import { shopping } from '@/routes/web';
import { index } from '@/routes/web/orders';
import type { NavItem } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { Menu } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import AppLogo from '../AppLogo.vue';
import ButtonTip from '../ButtonTip.vue';
import Icon from '../Icon.vue';
import SmartAvatar from '../SmartAvatar.vue';
import TextLink from '../TextLink.vue';
import { Button } from '../ui/button';
import { Sheet, SheetContent, SheetTrigger } from '../ui/sheet';
import WebNav from './WebNav.vue';

const page = usePage();
const isOpen = ref(false);
const { totalItems } = useCart();

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
    <header class="no-print justify-content-center sticky top-0 z-40 flex items-center justify-between border-b bg-background p-4">
        <!-- 1. Left Side -->
        <div class="flex items-center gap-2">
            <Sheet v-model:open="isOpen">
                <SheetTrigger as-child>
                    <Button class="lg:hidden" size="icon" variant="ghost">
                        <Menu class="size-5" />
                    </Button>
                </SheetTrigger>
                <SheetContent class="w-[300px] sm:w-[400px]" side="left">
                    <WebNav :items="mobileNavItems" @click="isOpen = false" />
                </SheetContent>
            </Sheet>

            <AppLogo />
        </div>

        <!-- 2. Center (Desktop Navigation) -->
        <nav class="justify-content-center hidden items-center gap-6 lg:flex">
            <TextLink v-for="item in mainNavItems" :key="item.title" :href="item.href">
                {{ item.title }}
            </TextLink>
        </nav>

        <!-- 3. Right Side -->

        <div class="justify-content-center flex items-center justify-center gap-2">
            <!-- <ThemeToggleButton /> -->
            <ButtonTip v-for="item in iconNavItems" :key="item.title" :tip="item.title" :href="item.href">
                <template #icon>
                    <div v-if="item.badge && item.badge > 0" class="relative">
                        <Icon :name="item.icon!" size="20" />
                        <div
                            class="justify-content-center absolute -top-2 -right-2 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-xs text-white"
                        >
                            {{ item.badge }}
                        </div>
                    </div>
                    <Icon v-else :name="item.icon!" size="20" />
                </template>
            </ButtonTip>

            <ButtonTip :tip="authNavItem.title" :href="authNavItem.href">
                <template #icon>
                    <SmartAvatar v-if="user" :src="user.image_url" :alt="user.name" :name="user.name" />
                    <Icon v-else :name="authNavItem.icon as string" />
                </template>
            </ButtonTip>
        </div>
    </header>
</template>
