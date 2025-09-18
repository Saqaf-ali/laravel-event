<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import AppLayout from '@/layouts/AppLayout.vue';
import { test } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Test',
        href: test().url,
    },
];

const openDialog = ref(false);
</script>
<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Dialog v-model:open="openDialog">
            <DialogTrigger>
                <Button>افتح مربع الحوار</Button>
            </DialogTrigger>

            <DialogContent>
                <DialogHeader>
                    <DialogTitle>عنوان مربع الحوار</DialogTitle>
                    <DialogDescription> هذا وصف قصير لمحتوى مربع الحوار. </DialogDescription>
                </DialogHeader>

                <div>
                    <p>هنا يذهب المحتوى الفعلي لمربع الحوار.</p>
                    <p>يمكن أن يكون هذا نموذجًا أو معلومات إضافية.</p>
                </div>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>
