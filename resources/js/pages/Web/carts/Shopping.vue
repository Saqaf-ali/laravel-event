<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import HeadingSmaller from '@/components/HeadingSmaller.vue';
import Icon from '@/components/Icon.vue';
import Paragraph from '@/components/Paragraph.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Separator } from '@/components/ui/separator';
import { useCart } from '@/composables/useCart';
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const { items, updateItemQuantity, removeItem, totalPrice, totalItems } = useCart();

const hasItems = computed(() => items.value.length > 0);
</script>

<template>
    <Head title="Shopping Cart" />
    <AppLayout>
        <section class="py-16">
            <div class="container mx-auto p-4 md:max-w-1/2">
                <div class="mb-8 text-center">
                    <Heading title="Shopping Cart" description="Review your selected tickets before checkout" />
                </div>

                <div v-if="hasItems" class="space-y-4 md:flex md:flex-col">
                    <!-- Cart Items List -->

                    <div v-for="item in items" :key="item.id" class="flex items-center gap-4 rounded-lg border bg-card p-4 shadow-sm">
                        <img :src="item.image" alt="Event Image" class="h-20 w-20 rounded-md object-cover" />
                        <div class="flex-grow flex-col justify-center">
                            <HeadingSmall :title="item.name" :description="'$' + item.price" />
                        </div>

                        <div class="flex items-center gap-2">
                            <Input
                                type="number"
                                :model-value="item.quantity"
                                class="w-16 text-center"
                                @input="updateItemQuantity(item.id, $event.target.value)"
                            />
                            <Button @click="removeItem(item.id)" variant="ghost" size="icon">
                                <Icon name="TrashIcon" class="text-destructive" />
                            </Button>
                        </div>
                    </div>

                    <!-- Order Summary -->

                    <div class="rounded-lg border bg-card p-6 shadow-sm">
                        <HeadingSmaller title="Order Summary" class="mb-4" />

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <Paragraph :text="`Subtotal (${totalItems}) items`" />
                                <Paragraph :text="'$' + totalPrice" />
                            </div>
                            <div class="flex justify-between">
                                <Paragraph text="Shipping" />
                                <Paragraph text="Free" />
                            </div>
                            <div class="flex justify-between">
                                <Paragraph text="Tax" />
                                <Paragraph text="$0.00" />
                            </div>
                            <Separator class="my-4" />
                            <div class="flex justify-between text-lg font-bold">
                                <HeadingSmaller title="Total" />
                                <Paragraph :text="'$' + totalPrice" />
                            </div>
                        </div>
                        <Link href="/web/checkout"> <Button class="mt-6 w-full"> Go to Checkout </Button></Link>
                    </div>
                </div>

                <div v-else class="flex flex-col items-center justify-center space-y-6 text-center">
                    <Paragraph text="Your cart is currently empty. Please add tickets to proceed with checkout." />
                    <Link href="/web/events"> <Button> Browse Events </Button></Link>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
