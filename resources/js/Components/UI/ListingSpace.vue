<script setup>
defineProps({
    listing: Object,
});
</script>

<template>
    <div>
        <span class="font-bold">
            {{ listing.beds }}
        </span>
        Beds
        <span class="text-gray-400">| </span>
        <span class="font-bold">
            {{ listing.baths }}
        </span>
        Baths
        <span class="text-gray-400">| </span>
        <span class="font-bold">
            {{ listing.area }}
        </span>
        m²
    </div>
</template>
