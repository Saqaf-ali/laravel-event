<script setup lang="ts">
import { Carousel, CarouselContent, CarouselItem } from '@/components/ui/carousel';

interface CarouselImagesProps {
    images: { url: string }[];
}

const props = defineProps<CarouselImagesProps>();
</script>

<template>
    <Carousel class="">
        <CarouselContent>
            <CarouselItem v-for="(image, index) in props.images" :key="index">
                <div class="aspect-video cursor-grab p-1">
                    <img :src="image.url" alt="Event Image" class="h-auto w-full rounded-lg shadow-md" />
                </div>
            </CarouselItem>
        </CarouselContent>
    </Carousel>
</template>
