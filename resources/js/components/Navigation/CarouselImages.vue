<script setup lang="ts">
import { Carousel, CarouselContent, CarouselItem } from '@/components/ui/carousel';

interface CarouselImagesProps {
    images: { image_url: string }[];
    class?: string;
}

const props = withDefaults(defineProps<CarouselImagesProps>(), {
    class: 'h-full',
});
</script>

<template>
    <Carousel>
        <CarouselContent>
            <CarouselItem v-for="(image, index) in props.images" :key="index">
                <div class="h-full cursor-grab p-1">
                    <img :src="image.image_url" alt="Event Image" :class="`inset-0 w-full rounded-lg object-cover shadow-md ${props.class}`" />
                </div>
            </CarouselItem>
        </CarouselContent>
    </Carousel>
</template>
