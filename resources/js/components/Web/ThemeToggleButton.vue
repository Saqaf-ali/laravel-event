<script setup lang="ts">
import { useAppearance } from '@/composables/useAppearance';
import { computed } from 'vue';
import ButtonTip from '../ButtonTip.vue';
import Icon from '../Icon.vue';

const { appearance, updateAppearance } = useAppearance();

// Computed property to determine the user's currently active theme mode (not just the saved preference)
const isCurrentlyDark = computed(() => {
    // If preference is explicitly 'dark', return true
    if (appearance.value === 'dark') return true;

    // If preference is explicitly 'light', return false
    if (appearance.value === 'light') return false;

    // If preference is 'system', check the user's operating system setting
    return window.matchMedia('(prefers-color-scheme: dark)').matches;
});

// Computed property to determine which icon to show (the mode the user will switch to)

// Function to handle the theme toggle action
const toggleAppearance = () => {
    // If the current mode is dark, switch to 'light'
    if (isCurrentlyDark.value) {
        updateAppearance('light');
    }
    // If the current mode is light or system, switch to 'dark'
    else {
        updateAppearance('dark');
    }
    // Note: The 'system' preference is kept out of the click cycle
    // and serves only as the initial default mode.
};
</script>

<template>
    <ButtonTip :tip="isCurrentlyDark ? 'Switch to Light Mode' : 'Switch to Dark Mode'" :click="toggleAppearance">
        <template #icon>
            <Icon :name="isCurrentlyDark ? 'SunMedium' : 'Moon'" size="20" />
        </template>
    </ButtonTip>
</template>
