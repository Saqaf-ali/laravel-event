<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import Icon from '@/components/Icon.vue';
import Paragraph from '@/components/Paragraph.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Separator } from '@/components/ui/separator';
import { useCart } from '@/composables/useCart';
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const { items: cartItems, removeItem, updateQuantity } = useCart(); // This line is causing the error

const subtotal = computed(() => {
    return cartItems.value.reduce((sum, item) => sum + item.price * item.quantity, 0);
});

const handleQuantityChange = (item: any, event: Event) => {
    const target = event.target as HTMLInputElement;
    const newQuantity = parseInt(target.value, 10);
    if (!isNaN(newQuantity) && newQuantity >= 1) {
        updateQuantity(item.id, newQuantity);
    }
};
</script>

<template>
    <Head title="Shopping Cart" />
    <AppLayout>
        <section class="py-16">
            <div class="container mx-auto p-4">
                <div class="mb-8 text-center">
                    <Heading title="Shopping Cart" description="Review your selected tickets before checkout" />
                </div>

                <div v-if="cartItems.length > 0" class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <!-- Cart Items List -->
                    <div class="md:col-span-2">
                        <div class="space-y-4">
                            <div v-for="item in cartItems" :key="item.id" class="flex items-center gap-4 rounded-lg border bg-card p-4 shadow-sm">
                                <img :src="item.image" alt="Event Image" class="h-20 w-20 rounded-md object-cover" />
                                <div class="flex-grow flex-col justify-center">
                                    <h3 class="text-lg font-semibold">{{ item.name }}</h3>
                                    <p class="text-sm text-muted-foreground">${{ item.price.toFixed(2) }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <Input
                                        type="number"
                                        :value="item.quantity"
                                        @change="handleQuantityChange(item, $event)"
                                        min="1"
                                        class="w-20 text-center"
                                    />
                                    <Button variant="ghost" size="icon" @click="removeItem(item.id)">
                                        <Icon name="TrashIcon" class="h-5 w-5 text-red-500" />
                                    </Button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="md:col-span-1">
                        <div class="rounded-lg border bg-card p-6 shadow-sm">
                            <h2 class="mb-4 text-xl font-semibold">Order Summary</h2>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <Paragraph text="Subtotal" />
                                    <Paragraph :text="'$' + subtotal.toFixed(2)" />
                                </div>
                                <div class="flex justify-between">
                                    <Paragraph text="Shipping" />
                                    <Paragraph text="Free" />
                                </div>
                                <Separator class="my-4" />
                                <div class="flex justify-between text-lg font-semibold">
                                    <Paragraph text="Total" />
                                    <Paragraph :text="'$' + subtotal.toFixed(2)" />
                                </div>
                            </div>
                            <Button class="mt-6 w-full">Proceed to Checkout</Button>
                        </div>
                    </div>
                </div>

                <div v-else class="flex flex-col items-center justify-center space-y-6 text-center">
                    <Paragraph text="Your cart is currently empty. Please add tickets to proceed with checkout." />
                    <Button as-child>
                        <a href="/web/events">Browse Events</a>
                    </Button>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
