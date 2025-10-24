<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import AppLayout from '@/layouts/web/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

const { purchasedTickets } = defineProps<{
    purchasedTickets: {
        data: {
            id: number;
            ticket_code: string;
            qr_code: string;
            order_item: {
                ticket: {
                    type: string;
                    price: number;
                };
            };
        }[];
        meta: {
            links: {
                label: string;
                url: string;
                active: boolean;
            }[];
        };
    };
}>();

// console.log('pu22222222',);

console.log('purchasedTickets', purchasedTickets.data);
</script>
<template>
    <Head title="Checkout" />
    <AppLayout>
        <section class="py-16">
            <div class="container mx-auto p-4 md:max-w-1/2">
                <div class="mb-8 text-center">
                    <Heading title="Purchased Tickets" description="Review your purchased tickets and event details." />
                </div>
            </div>
        </section>
    </AppLayout>
</template>
