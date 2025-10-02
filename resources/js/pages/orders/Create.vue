<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import orders from '@/routes/orders';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    total_price: 0,
    status: 'pending',
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Orders',
        href: orders.index().url,
    },
    {
        title: 'Create',
        href: orders.create().url,
    },
];

const submit = () => {
    form.post(orders.store().url);
};
</script>

<template>
    <Head title="Create Order" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <AppContent>
            <div class="mx-auto max-w-2xl p-4">
                <Heading title="Create New Order" description="Fill in the details to create a new order." />
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-2">
                        <Label for="total_price">Total Price</Label>
                        <Input
                            class="hover:border-primary focus:border-primary"
                            id="total_price"
                            type="number"
                            v-model="form.total_price"
                            :tabindex="1"
                            name="total_price"
                            placeholder="Total Price"
                        />
                        <InputError :message="form.errors.total_price" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="status">Status</Label>
                        <Select v-model="form.status">
                            <SelectTrigger class="w-[180px]">
                                <SelectValue placeholder="Select a status" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="pending">Pending</SelectItem>
                                <SelectItem value="completed">Completed</SelectItem>
                                <SelectItem value="cancelled">Cancelled</SelectItem>
                            </SelectContent>
                        </Select>

                        <InputError :message="form.errors.status" />
                    </div>

                    <Button
                        @click="submit"
                        type="submit"
                        class="mt-2 w-full"
                        :tabindex="5"
                        :disabled="form.processing"
                        data-test="create-order-button"
                    >
                        <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                        Create Order
                    </Button>
                </form>
            </div>
        </AppContent>
    </AppLayout>
</template>
