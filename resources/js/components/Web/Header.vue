<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Sheet, SheetContent, SheetTrigger } from '@/components/ui/sheet';
import { Link } from '@inertiajs/vue3';
import { Bell, Bookmark, History, Home, Search, ShoppingCart, User } from 'lucide-vue-next';
import { ref } from 'vue';
import AppLogo from '../AppLogo.vue';

const isOpen = ref(false);
</script>

<template>
    <header class="sticky top-0 z-40 w-full border-b bg-background">
        <div class="container flex h-16 items-center justify-between">
            <div class="flex items-center gap-4">
                <Sheet v-model:open="isOpen">
                    <SheetTrigger as-child>
                        <Button size="icon" variant="outline" class="lg:hidden">
                            <Search class="h-5 w-5" />
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="left">
                        <div class="flex flex-col gap-4">
                            <Link :href="'/'" class="mr-4 flex items-center justify-center">
                                <AppLogo />

                                <!-- <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" /> -->
                            </Link>
                            <div class="flex flex-col gap-2">
                                <Link :href="'/'" class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium hover:bg-muted">
                                    <Home class="h-5 w-5" />
                                    Home
                                </Link>
                                <Link :href="'/events'" class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium hover:bg-muted">
                                    <Bookmark class="h-5 w-5" />
                                    Events
                                </Link>
                                <Link :href="'/orders'" class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium hover:bg-muted">
                                    <History class="h-5 w-5" />
                                    Orders
                                </Link>
                                <Link :href="'/cart'" class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium hover:bg-muted">
                                    <ShoppingCart class="h-5 w-5" />
                                    Cart
                                </Link>
                                <Link
                                    :href="'/notifications'"
                                    class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium hover:bg-muted"
                                >
                                    <Bell class="h-5 w-5" />
                                    Notifications
                                </Link>
                                <Link :href="'/profile'" class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium hover:bg-muted">
                                    <User class="h-5 w-5" />
                                    Profile
                                </Link>
                            </div>
                        </div>
                    </SheetContent>
                </Sheet>
                <Link :href="'/'" class="hidden lg:flex lg:items-center">
                    <AppLogo class="block h-9 w-auto fill-current text-gray-800" />
                </Link>
                <nav class="hidden gap-6 lg:flex">
                    <Link :href="'/'" class="text-sm font-medium hover:text-primary"> Home </Link>
                    <Link :href="'/events'" class="text-sm font-medium hover:text-primary"> Events </Link>
                    <Link :href="'/orders'" class="text-sm font-medium hover:text-primary"> Orders </Link>
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <Button size="icon" variant="outline" class="hidden lg:flex">
                    <Search class="h-5 w-5" />
                </Button>
                <Button size="icon" variant="outline">
                    <ShoppingCart class="h-5 w-5" />
                </Button>
                <Button size="icon" variant="outline">
                    <Bell class="h-5 w-5" />
                </Button>
                <Button size="icon" variant="outline">
                    <User class="h-5 w-5" />
                </Button>
            </div>
        
        </div>
    </header>
</template>
