<script setup>
defineProps({
    listing: Object,
});
</script>

<template>
    <span class="text-lg">
        {{ listing.street }} {{ listing.street_nr }}, {{ listing.city }}
    </span>
</template>
