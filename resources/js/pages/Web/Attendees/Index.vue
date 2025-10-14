<script setup lang="ts">
import type { Order } from '@/types';

const { orders } = defineProps<{
    orders: Order[];
}>();

const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString(undefined, {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};
console.log('orders', orders);
</script>
