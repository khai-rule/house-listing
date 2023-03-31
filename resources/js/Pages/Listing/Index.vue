<script setup>
import Listing from "@/Pages/Listing/Index/Components/Listing.vue"

defineProps({
    listings: Array,
});
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 ">
        <!-- think of v-for as like a map(). This will render all items in the array -->
        <Listing v-for="listing in listings" :key="listing.id" :listing="listing" />
    </div>
</template>
