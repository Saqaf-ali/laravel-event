<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Sheet, SheetContent, SheetTrigger } from '@/components/ui/sheet';
import { useCart } from '@/composables/useCart';
import type { NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { Bell, ClockArrowDown, Home, Menu, TentTree, User } from 'lucide-vue-next';
import { computed, ref } from 'vue';
import AppLogo from '../AppLogo.vue';
import ButtonTip from '../ButtonTip.vue';
import Icon from '../Icon.vue';
import SmartAvatar from '../SmartAvatar.vue';
import TextLink from '../TextLink.vue';
import ThemeToggleButton from './ThemeToggleButton.vue';
import WebNav from './WebNav.vue';

const page = usePage();
const isOpen = ref(false);
const { totalItems } = useCart();

const mainNav: NavItem[] = [
    { title: 'Home', href: '/', icon: Home },
    { title: 'About', href: '/about', icon: User },
    { title: 'Contact', href: '/contact', icon: Bell },
    { title: 'Events', href: '/web/events', icon: TentTree },
];

const mobileOnlyNav: NavItem[] = [{ title: 'Orders', href: '/web/orders', icon: ClockArrowDown }];

const rightNavItems = computed<NavItem[]>(() => {
    const items: NavItem[] = [];

    if (totalItems.value > 0) {
        items.push({ title: 'Cart', href: '/web/shopping', icon: 'ShoppingCart', badge: totalItems.value });
    }

    if (page.props.hasOrders === true) {
        items.push({ title: 'Orders', href: '/web/orders', icon: 'ClockArrowDown' });
    }

    items.push({
        title: page.props.auth.user ? page.props.auth.user.name : 'Login',
        href: page.props.auth.user ? '/profile' : '/login',
        icon: 'User',
        auth: true,
    });

    return items;
});

const desktopRightNav = computed(() =>
    rightNavItems.value.filter((item) => (page.props.auth.user ? item.title !== 'Orders' : item.title !== 'Orders')),
);

const allNav = computed(() => [...mainNav, ...mobileOnlyNav, ...rightNavItems.value.filter((item) => item !== null)]);
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
                <ThemeToggleButton />

                <ButtonTip v-for="(item, index) in desktopRightNav" :key="index" :tip="item.title" :href="item.href">
                    <template #icon>
                        <SmartAvatar
                            v-if="item.auth && page.props.auth.user"
                            :src="page.props.auth.user.image_url"
                            :name="page.props.auth.user.name"
                            :alt="page.props.auth.user.name"
                            class="h-8 w-8"
                        />
                        <div v-else-if="item.title === 'Cart'" class="relative">
                            <Icon :name="item.icon!" :size="20" />
                            <div class="absolute -top-2 -right-2 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-xs text-white">
                                {{ totalItems }}
                            </div>
                        </div>
                        <Icon v-else :name="item.icon!" :size="20" />
                    </template>
                </ButtonTip>
            </div>
        </div>
    </header>
</template>
