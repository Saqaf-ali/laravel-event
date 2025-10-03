<script setup lang="ts">
import { Carousel, CarouselContent, CarouselItem } from '@/components/ui/carousel';

interface CarouselImagesProps {
    images: { image_url: string }[];
}

const props = defineProps<CarouselImagesProps>();
</script>

<template>
    <Carousel class="h-full">
        <CarouselContent class="h-full">
            <CarouselItem v-for="(image, index) in props.images" :key="index" class="h-full">
                <div class="cursor-grab p-1 h-full">
                    <img :src="image.image_url" alt="Event Image" class="inset-0 h-full w-full rounded-lg object-cover shadow-md" />
                </div>
            </CarouselItem>
        </CarouselContent>
    </Carousel>
</template>
