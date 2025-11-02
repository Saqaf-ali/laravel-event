<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <section class="bg-primary-foreground py-16 text-center">
        <div class="container mx-auto px-4">
            <h2 class="mb-4">Ready to experience the next wave of events?</h2>
            <p class="mb-8 text-muted-foreground">Join Event Wave today and never miss out on the excitement!</p>
            <Link href="/register">
                <Button>Sign Up Now</Button>
            </Link>
        </div>
    </section>
</template>
