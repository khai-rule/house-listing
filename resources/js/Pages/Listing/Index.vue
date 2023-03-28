<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Components/ListingAddress.vue";
import Box from "@/Components/UI/Box.vue"
import ListingSpace from "@/Components/UI/ListingSpace.vue";
import Price from "@/Components/UI/Price.vue";

defineProps({
    listings: Array,
});
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 ">
        <!-- think of v-for as like a map(). This will render all items in the array -->
        <Box v-for="listing in listings" :key="listing.id">
            <div>
                <Link :href="route('listing.show', {listing: listing.id})">
                    <ListingAddress :listing="listing" class="text-xl font-bold"/>
                    <ListingSpace :listing="listing" class="text-sm"/>
                    <Price :price="listing.price" class="text-md"/>
                </Link>
            </div>
            <div>
                <Link :href="route('listing.edit', {listing: listing.id})">Edit</Link>
            </div>
            <div>
                <!-- By default the method is GET. So we have to specify for this -->
                <Link :href="route('listing.destroy', {listing: listing.id})" method="DELETE" as="button">Delete</Link>
            </div>
        </Box>
    </div>
</template>
