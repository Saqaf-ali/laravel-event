<script setup lang="ts">
const props = defineProps<{
    eventImage: {
        id: number;
        url: string;
        event_id: number;
    };
}>();
console.log(props.eventImage);
</script>
    <template>
        hi
    </template>
